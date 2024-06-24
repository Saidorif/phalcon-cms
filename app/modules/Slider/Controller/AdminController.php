<?php

namespace Slider\Controller;

use Application\Mvc\Controller;
use Slider\Model\Slider;
use Slider\Form\SliderForm;

class AdminController extends Controller
{

    public function initialize()
    {
        $this->setAdminEnvironment();
        $this->helper->activeMenu()->setActive('admin-slider');
    }

    public function indexAction()
    {
        $this->view->entries = Slider::find();
        $this->helper->title($this->helper->at('Manage Slider'), true);
    }

    public function addAction()
    {
        $this->view->pick('admin/edit');
        $model = new Slider();
        $form = new SliderForm();  
        
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
                
            $form->bind($post, $model);
            if ($form->isValid()) {
                if ($model->create()) {
                    $form->bind($post, $model);
                    $model->updateFields($post);
                    if ($model->update()) {
                        $this->uploadImage($model);
                        $this->flash->success($this->helper->at('Created has been successful'));
                        $this->redirect($this->url->get() . 'slider/admin/edit/' . $model->getId() . '?lang=' . LANG);
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

        $this->view->title = $this->helper->at('Adding slider');
        $this->helper->title($this->view->title);

    }

    public function editAction($id)
    {
        $id = (int) $id;
        $form = new SliderForm();
        $model = Slider::findFirst($id); 

        if (!$model) {
            $this->redirect($this->url->get() . 'slider/admin/add');
        }        
       
        if ($this->request->isPost()) {
            $post = $this->request->getPost();            
            $form->bind($post, $model);
            if ($form->isValid()) {
                $model->updateFields($post);
                if ($model->save()) {                    
                    $this->uploadImage($model);
                    $this->flash->success($this->helper->at('Updated has been successful'));
                    $this->redirect($this->url->get() . 'slider/admin/edit/' . $model->getId() . '?lang=' . LANG);
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
        $this->view->setVar('slider', $model);

        $this->helper->title($this->helper->at('Editing slider'), true);

    }

    public function deleteAction($id)
    {
        $id = (int) $id;
        $model = Slider::findFirst($id);
        if ($model) {

            if ($this->request->isPost()) {
                $imageFilter = new \Image\Storage([
                    'id'   => $model->getId(),
                    'type' => 'banner',
                ]);
                $imageFilter->remove();
                $model->delete();
                $this->redirect($this->url->get() . 'slider/admin/index');
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
                        'image/png',
                        'image/bmp',
                        'image/jpeg',
                    ])
                    ) {
                        return $this->flash->error($this->helper->at('Only allow image formats png, jpg, jpeg, bmp'));
                    }

                    $hash = $model->getId().'.'.$file->getExtension();
                    $currentPath = ROOT.'/uploads/slider/'.$hash;
                    $img = substr($currentPath, strpos($currentPath, 'uploads'));
                    $file->moveTo($currentPath);

                    $model->setBanner($img);
                    $model->update();

                    $this->flash->success($this->helper->at('Photo added'));
                }
            }
        }
    }

}