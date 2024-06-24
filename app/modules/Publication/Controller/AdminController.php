<?php

namespace Publication\Controller;

use Application\Mvc\Controller;
use Publication\Model\Publication;
use Publication\Form\PublicationForm;
use Publication\Model\Type;

class AdminController extends Controller
{

    public function initialize()
    {
        $this->setAdminEnvironment();
        $this->helper->activeMenu()->setActive('admin-publication');
    }

    public function indexAction()
    {
        $page = $this->request->getQuery('page', 'int', 1);
        $type = $this->dispatcher->getParam('type');
        $type_id = null;

        $types = Type::find();

        $cond_array = [];
        if ($type) {
            $typeEntity = Type::getCachedBySlug($type);
            $type_id = $typeEntity->getId();
            $cond_array[] = "type_id = $type_id";
        }

        $conditions = implode(' AND ', $cond_array);

        $publications = Publication::find([
            "conditions" => $conditions,
            "order"      => "date DESC, id DESC"
        ]);

        $paginator = new \Phalcon\Paginator\Adapter\Model([
            "data"  => $publications,
            "limit" => 20,
            "page"  => $page
        ]);
        $this->view->paginate = $paginator->getPaginate();

        $this->view->types = $types;
        $this->view->type = $type;
        $this->view->type_id = $type_id;

        $this->helper->title($this->helper->at('Manage Publications'), true);
    }

    public function addAction()
    {
        $this->view->pick(['admin/edit']);
        $form = new PublicationForm();
        $model = new Publication();

        $type = $this->dispatcher->getParam('type');
        if ($type) {
            $typeEntity = Type::getCachedBySlug($type);
            $form->get('type_id')->setDefault($typeEntity->getId());
        }

        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->bind($post, $model);

            if ($form->isValid()) {
                if ($model->create()) {
                    $form->bind($post, $model);
                    $model->updateFields($post);
                    if ($model->update()) {
                        $this->uploadImage($model);
                        $this->flash->success($this->helper->at('Publication created'));
                        return $this->redirect($this->url->get() . 'publication/admin/edit/' . $model->getId() . '?lang=' . LANG);
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

        $this->view->type = $type;
        $this->view->model = $model;
        $this->view->form = $form;

        $this->helper->title($this->helper->at('Create a publication'), true);

    }

    public function editAction($id)
    {
        $id = (int) $id;
        $form = new PublicationForm();
        $model = Publication::findFirst($id);

        if ($model->getTypeId()) {
            $this->view->type = $model->getType()->getSlug();
        }

        if ($this->request->isPost()) {
            $post = $this->request->getPost();            
            $form->bind($post, $model);
            if ($form->isValid()) {
                $model->updateFields($post);
                if ($model->save()) {
                    $this->uploadImage($model);
                    $this->flash->success($this->helper->at('Publication edited'));

                    return $this->redirect($this->url->get() . 'publication/admin/edit/' . $model->getId() . '?lang=' . LANG);
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
        $this->helper->title($this->helper->at('Edit publication'), true);
    }

    public function deleteAction($id)
    {
        $model = Publication::findFirst($id);

        if ($this->request->isPost()) {
            $imageFilter = new \Image\Storage([
                'id'   => $model->getId(),
                'type' => 'publication',
            ]);
            $imageFilter->remove();
            $model->delete();
            if ($model->getTypeId()) {
                $this->redirect($this->url->get() . 'publication/admin/' . $model->getType()->getSlug());
            } else {
                $this->redirect($this->url->get() . 'publication/admin');
            }
        }

        $this->view->model = $model;
        $this->helper->title($this->helper->at('Unpublishing'), true);
    }

    private function uploadImage($model)
    {
        if ($this->request->isPost()) {
            if ($this->request->hasFiles() == true) {
                foreach ($this->request->getUploadedFiles() as $file) {
                    if (!$file->getTempName()) {
                        return;
                    }
                    if (!in_array($file->getType(), [
                        'image/png',
                        'image/gif',
                        'image/jpeg',
                        'image/jpg',
                        'image/svg+xml',
                    ])
                    ) {                        
                        return $this->flash->error('Only allow image formats gif, jpeg, svg, png');
                    }
                    
                    if($model->getPreviewSrc()){
                        $path = '/uploads/publication/'.$model->getPreviewSrc();
                        unlink($path);
                    }

                    $hash = time().'_file.'.$file->getExtension();
                    $currentPath = ROOT.'/uploads/publication/'.$hash;                    
                    $file->moveTo($currentPath);

                    $model->setPreviewSrc('uploads/publication/'.$hash);
                    $model->update();

                    $this->flash->success($this->helper->at('Photo added'));
                }
            }
        }
    }

}
