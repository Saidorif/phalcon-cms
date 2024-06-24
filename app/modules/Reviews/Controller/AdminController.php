<?php

namespace Reviews\Controller;

use Application\Mvc\Controller;
use Reviews\Model\Reviews;
use Reviews\Form\ReviewsForm;

class AdminController extends Controller
{

    public function initialize()
    {
        $this->setAdminEnvironment();
        $this->helper->activeMenu()->setActive('admin-reviews');
    }

    public function indexAction()
    {
        $this->view->entries = Reviews::find();
        $this->helper->title($this->helper->at('Reviews'), true);
    }

    public function addAction()
    {
        $this->view->pick('admin/edit');
        $model = new Reviews();
        $form = new ReviewsForm();  
        
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
                
            $form->bind($post, $model);
            if ($form->isValid()) {
                if ($model->create()) {
                    $form->bind($post, $model);                    
                    if ($model->update()) {
                        $this->uploadImage($model);
                        $this->flash->success($this->helper->at('Created has been successful'));
                        $this->redirect($this->url->get() . 'reviews/admin/edit/' . $model->getId() . '?lang=' . LANG);
                    } else {
                        $this->flashErrors($model);
                    }
                    
                } else {
                    $this->flashErrors($model);
                }
            } else {
                $this->flashErrors($form);
            }
        } else {
            $form->setEntity($model);
        }

        
        $this->view->setVar('form', $form);

        $this->view->title = $this->helper->at('Adding reviews');
        $this->helper->title($this->view->title);

    }

    public function editAction($id)
    {
        $id = (int) $id;
        $form = new ReviewsForm();
        $model = Reviews::findFirst($id); 

        if (!$model) {
            $this->redirect($this->url->get() . 'reviews/admin/add');
        }        
       
        if ($this->request->isPost()) {
            $post = $this->request->getPost();            
            $form->bind($post, $model);
            if ($form->isValid()) {
                if ($model->save()) {                    
                    $this->uploadImage($model);
                    $this->flash->success($this->helper->at('Updated has been successful'));
                    $this->redirect($this->url->get() . 'reviews/admin/edit/' . $model->getId() . '?lang=' . LANG);
                } else {
                    $this->flashErrors($model);
                }
            } else {
                $this->flashErrors($form);
            }
        } else {
            $form->setEntity($model);
        }

        $this->view->setVar('form', $form);
        $this->view->setVar('reviews', $model);

        $this->helper->title($this->helper->at('Editing reviews'), true);

    }

    public function deleteAction($id)
    {
        $id = (int) $id;
        $model = Reviews::findFirst($id);
        if ($model) {

            if ($this->request->isPost()) {
                $imageFilter = new \Image\Storage([
                    'id'   => $model->getId(),
                    'type' => 'reviews',
                ]);
                $imageFilter->remove();
                $model->delete();
                $this->redirect($this->url->get() . 'reviews/admin/index');
            }

            $this->view->model = $model;
        }

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
                        'image/bmp',
                        'image/jpeg',
                        'image/png',
                    ])
                    ) {
                        return $this->flash->error($this->helper->at('Only allow image formats jpg, jpeg, png, bmp'));
                    }

                    $imageFilter = new \Image\Storage([
                        'id'   => $model->getId(),
                        'type' => 'reviews',
                    ]);
                    $imageFilter->remove();

                    
                    $image = new \Phalcon\Image\Adapter\GD($file->getTempName());  
                    
                    $image->save($imageFilter->originalAbsPath());

                    $model->setFoto($imageFilter->originalRelPath());
                    $model->update();

                    $this->flash->success($this->helper->at('Photo added'));
                }
            }
        }
    }

}