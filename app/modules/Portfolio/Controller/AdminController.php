<?php

namespace Portfolio\Controller;

use Application\Mvc\Controller;
use Portfolio\Model\Portfolio;
use Portfolio\Form\PortfolioForm;
use Portfolio\Model\Category;
use Portfolio\Model\Gallery;

class AdminController extends Controller
{

    public function initialize()
    {
        $this->setAdminEnvironment();
        $this->helper->activeMenu()->setActive('admin-portfolio');
    }

    public function indexAction()
    {
        $page = $this->request->getQuery('page', 'int', 1);
        $category = $this->dispatcher->getParam('category');
        $category_id = null;

        $categorys = Category::find();

        $this->view->portfolio = Portfolio::find();     
        $this->view->category_id = $category_id;

        $this->helper->title($this->helper->at('Manage Portfolio'), true);
    }

    public function addAction()
    {
        $this->view->pick(['admin/edit']);
        $form = new PortfolioForm();
        $model = new Portfolio();   

        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->bind($post, $model);

            if ($form->isValid()) {
                if ($model->create()) {
                    $form->bind($post, $model);
                    if ($model->update()) {
                        $this->uploadImage($model);
                        $this->flash->success($this->helper->at('Portfolio created'));
                        return $this->redirect($this->url->get() . 'portfolio/admin/edit/' . $model->getId() . '?lang=' . LANG);
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

        $this->helper->title($this->helper->at('Create a portfolio'), true);

    }

    public function editAction($id)
    {
        $id = (int) $id;
        $form = new PortfolioForm();
        $model = Portfolio::findFirst($id); 

        if ($this->request->isPost()) {
            $post = $this->request->getPost();            
            $form->bind($post, $model);
            if ($form->isValid()) {
                if ($model->save()) {
                    $this->uploadImage($model);                    
                    $this->flash->success($this->helper->at('Portfolio edited'));

                    return $this->redirect($this->url->get() . 'portfolio/admin/edit/' . $model->getId() . '?lang=' . LANG);
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
        $this->view->photos = $model->gallery;
        $this->helper->title($this->helper->at('Edit portfolio'), true);
    }

    public function deleteAction($id)
    {
        $model = Portfolio::findFirst($id);

        if ($this->request->isPost()) {

            $imageFilter = new \Image\Storage([
                'id'   => $model->getId(),
                'type' => 'portfolio',
            ]);
            $imageFilter->remove();

            $gallery = Gallery::find('portfolio_id='.$model->getId());              
              
            foreach ($gallery as $g) {                
                if($g){
                    $imageFilter = new \Image\Storage([
                        'id'   => $g->getFileId(),
                        'type' => 'portfolio_gallery',
                    ]);
                    $imageFilter->remove();
                    $g->delete();
                }               
            }

            $model->delete();
            $this->redirect($this->url->get() . 'portfolio/admin');
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
                            'type' => 'portfolio',
                        ]);
                        $imageFilter->remove();
                        
                        $image = new \Phalcon\Image\Adapter\GD($file->getTempName());  
                        
                        $image->save($imageFilter->originalAbsPath());

                        $model->setAnons($imageFilter->originalRelPath());
                        $model->update();

                        $this->flash->success($this->helper->at('Photo added'));  
                    }                   
                }

                if($key[0] == 'gallery'){
                    if($file->getTempName()){
                        $photo = new Gallery();
                        $fid = md5(microtime());    
                        $photoFilter = new \Image\Storage([
                            'id'   => $fid,
                            'type' => 'portfolio_gallery',
                        ]);
                        $photoFilter->remove();
                        
                        $img = new \Phalcon\Image\Adapter\GD($file->getTempName());  
                        $img->save($photoFilter->originalAbsPath());
                        $photo->setPortfolioId($model->getId());
                        $photo->setFile($photoFilter->originalRelPath());
                        $photo->setFileId($fid);
                        $photo->save();                        
                        
                        $this->flash->success($this->helper->at('Gallery added'));
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
                'type' => 'portfolio_gallery',
            ]);
            $imageFilter->remove();
            $gallery->delete();                  
        }        
    }

}
