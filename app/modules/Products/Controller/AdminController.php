<?php

namespace Products\Controller;

use Application\Mvc\Controller;
use Products\Model\Products;
use Products\Form\ProductsForm;
use Products\Model\Category;
use Products\Model\Gallery;
use Products\Model\Additional;

class AdminController extends Controller
{

    public function initialize()
    {
        $this->setAdminEnvironment();
        $this->helper->activeMenu()->setActive('admin-products');
    }

    public function indexAction()
    {
        $page = $this->request->getQuery('page', 'int', 1);
        $category = $this->dispatcher->getParam('category');
        $category_id = null;

        $categories = Category::find();

        $cond_array = [];
        if ($category) {
            $categoryEntity = Category::getCachedBySlug($category);
            $category_id = $categoryEntity->getId();
            $cond_array[] = "category_id = $category_id";
        }

        $conditions = implode(' AND ', $cond_array);

        $products = Products::find([
            "conditions" => $conditions,
            "order"      => "created_at DESC, id DESC"
        ]);

        $paginator = new \Phalcon\Paginator\Adapter\Model([
            "data"  => $products,
            "limit" => 20,
            "page"  => $page
        ]);
        $this->view->paginate = $paginator->getPaginate();

        $this->view->categories = $categories;
        $this->view->category = $category;
        $this->view->category_id = $category_id;

        $this->helper->title($this->helper->at('Manage Publications'), true);
    }

    public function addAction()
    {
        $this->view->pick(['admin/edit']);
        $form = new ProductsForm();
        $model = new Products();

        $category = $this->dispatcher->getParam('category');
        if ($category) {
            $categoryEntity = Category::getCachedBySlug($category);
            $form->get('category_id')->setDefault($categoryEntity->getId());
        }

        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->bind($post, $model);

            if ($form->isValid()) {
                if ($model->create()) {
                    $form->bind($post, $model);
                    $model->updateFields($post);
                    if ($model->update()) {
                        $this->additional($model);
                        $this->uploadImage($model);
                        $this->flash->success($this->helper->at('Product created'));
                        return $this->redirect($this->url->get() . 'products/admin/edit/' . $model->getId() . '?lang=' . LANG);
                    } else {
                        $this->flashErrors($model);
                    }
                } else {
                    $this->flashErrors($model);
                }
            } else {
                $this->flashErrors($form);
            }
        }

        $this->view->category = $category;
        $this->view->model = $model;
        $this->view->form = $form;
        $this->view->fields = $model->additional;
        $this->helper->title($this->helper->at('Create a publication'), true);

    }

    public function editAction($id)
    {
        $id = (int) $id;
        $form = new ProductsForm();
        $model = Products::findFirst($id);

        if ($model->getCategoryId()) {
            $this->view->type = $model->getCategory()->getSlug();
        }

        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->bind($post, $model);
            if ($form->isValid()) {
                $model->updateFields($post);
                if ($model->save()) {
                    $this->additional($model);
                    $this->uploadImage($model);
                    $this->flash->success($this->helper->at('Product edited'));
                    return $this->redirect($this->url->get() . 'products/admin/edit/' . $model->getId() . '?lang=' . LANG);
                } else {
                    $this->flashErrors($model);
                }
            } else {
                $this->flashErrors($form);
            }
        } else {
            $form->setEntity($model);
        }

        $this->view->model = $model;
        $this->view->form = $form;
        $this->view->photos = $model->photos;
        $this->view->fields = $model->additional;
        $this->helper->title($this->helper->at('Edit publication'), true);
    }

    public function deleteAction($id)
    {
        $model = Products::findFirst($id);

        if ($this->request->isPost()) {

            $imageFilter = new \Image\Storage([
                'id'   => $model->getId(),
                'type' => 'products',
            ]);
            $imageFilter->remove();

            $gallery = Gallery::find('product_id='.$model->getId());

            foreach ($gallery as $g) {
                if($g){
                    $imageFilter = new \Image\Storage([
                        'id'   => $g->getFileId(),
                        'type' => 'products_gallery',
                    ]);
                    $imageFilter->remove();
                    $g->delete();
                }
            }

            $model->delete();
            $this->redirect($this->url->get() . 'products/admin');
        }


        $this->view->model = $model;
        $this->helper->title($this->helper->at('Unpublishing'), true);
    }

    private function uploadImage($model)
    {
        if ($this->request->isPost()) {

            if ($this->request->hasFiles() == true) {
              $files = $this->request->getUploadedFiles();

              foreach ($files as $file) {
                $key = explode('.', $file->getKey());

                if($key[0] == 'anons'){
                    if($file->getTempName()){
                        $imageFilter = new \Image\Storage([
                            'id'   => $model->getId(),
                            'type' => 'products',
                        ]);
                        $imageFilter->remove();

                        $image = new \Phalcon\Image\Adapter\GD($file->getTempName());

                        $image->save($imageFilter->originalAbsPath());

                        $model->setAnons($imageFilter->originalRelPath());
                        $model->update();

                        $this->flash->success($this->helper->at('Image added'));
                    }
                }

                if($key[0] == 'photos'){
                    if($file->getTempName()){
                        $photo = new Gallery();
                        $fid = md5(microtime());
                        $photoFilter = new \Image\Storage([
                            'id'   => $fid,
                            'type' => 'products_gallery',
                        ]);
                        $photoFilter->remove();

                        $img = new \Phalcon\Image\Adapter\GD($file->getTempName());
                        $img->save($photoFilter->originalAbsPath());
                        $photo->setProductId($model->getId());
                        $photo->setFile($photoFilter->originalRelPath());
                        $photo->setFileId($fid);
                        $photo->save();

                        $this->flash->success($this->helper->at('Photo added'));
                    }
                }
              }

            }
        }
    }

    public function removefileAction($id)
    {
        $gallery = Gallery::findFirst($id);

        if ($gallery->getId()) {
            $imageFilter = new \Image\Storage([
                'id'   => $gallery->getFileId(),
                'type' => 'products_gallery',
            ]);
            $imageFilter->remove();
            $gallery->delete();
        }
    }


    private function additional($model)
    {
        if ($this->request->isPost()) {

            $title_array = $this->request->getPost('title_add');
            $text_array = $this->request->getPost('value_add');
            $id_array = $this->request->getPost('id_add');

            foreach ($title_array as $key => $title) {
                $text = $text_array[$key];
                $id = $id_array[$key];
                if($id != 0){
                    $addModel = Additional::findFirst($id);
                    $addModel->setTitle($title);
                    $addModel->setText($text);
                    $addModel->update();
                } else {
                    $addModel = new Additional();
                    $addModel->setProductId($model->getId());
                    $addModel->setTitle($title);
                    $addModel->setText($text);
                    $addModel->setLanguage(LANG);
                    $addModel->save();
                }
            }
        }
    }

    public function removefieldAction($id)
    {
        $addModel = Additional::findFirst($id);
        if ($addModel->getId()) {
            $addModel->delete();
        }
    }

}
