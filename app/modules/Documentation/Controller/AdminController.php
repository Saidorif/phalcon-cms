<?php

namespace Documentation\Controller;

use Application\Mvc\Controller;
use Documentation\Model\Documentation;
use Documentation\Form\DocumentationForm;

class AdminController extends Controller
{

    public function initialize()
    {
        $this->setAdminEnvironment();
        $this->helper->activeMenu()->setActive('admin-documentation');
    }

    public function indexAction()
    {
        $this->view->entries = Documentation::find();
        $this->helper->title($this->helper->at('Documentation'), true);
    }

    public function addAction()
    {
        $this->view->pick('admin/edit');
        $model = new Documentation();
        $form = new DocumentationForm();  
        
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
                
            $form->bind($post, $model);
            if ($form->isValid()) {
                if ($model->create()) {
                    $form->bind($post, $model);                    
                    if ($model->update()) {
                        $this->uploadImage($model);
                        $this->uploadPhoto($model);
                        $this->flash->success($this->helper->at('Created has been successful'));
                        $this->redirect($this->url->get() . 'documentation/admin/edit/' . $model->getId() . '?lang=' . LANG);
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

        $this->view->title = $this->helper->at('Adding documentation');
        $this->helper->title($this->view->title);

    }

    public function editAction($id)
    {
        $id = (int) $id;
        $form = new DocumentationForm();
        $model = Documentation::findFirst($id); 

        if (!$model) {
            $this->redirect($this->url->get() . 'documentation/admin/add');
        }        
       
        if ($this->request->isPost()) {
            $post = $this->request->getPost();            
            $form->bind($post, $model);
            if ($form->isValid()) {
                if ($model->save()) {                    
                    $this->uploadImage($model);
                    $this->uploadPhoto($model);
                    $this->flash->success($this->helper->at('Updated has been successful'));
                    $this->redirect($this->url->get() . 'documentation/admin/edit/' . $model->getId() . '?lang=' . LANG);
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
        $this->view->setVar('documentation', $model);

        $this->helper->title($this->helper->at('Editing documentation'), true);

    }

    public function deleteAction($id)
    {
        $id = (int) $id;
        $model = Documentation::findFirst($id);
        if ($model) {

            if ($this->request->isPost()) {
                if($model->getFile()){
                    $path = ROOT.'/'.$model->getFile();
                    unlink($path);
                }
                $model->delete();
                $this->redirect($this->url->get() . 'documentation/admin/index');
            }

            $this->view->model = $model;
        }

    }

    private function uploadImage($model)
    {
        if ($this->request->isPost()) {
            if ($this->request->hasFiles() == true) {
                foreach ($this->request->getUploadedFiles() as $file) {
                    $key = explode('.', $file->getKey());
                    if($key[0] == 'file'){
                        if (!$file->getTempName()) {
                            return;
                        }
                       
                        $fileSize = number_format($file->getSize() / 1024, 2);
                        $hash = $model->getId().'.'.$file->getExtension();
                        $currentPath = ROOT.'/uploads/documentation/'.$hash;
                        $img = substr($currentPath, strpos($currentPath, 'uploads'));
                        $file->moveTo($currentPath);
    
                        $model->setFile($img);
                        $model->setFormat($file->getExtension());
                        $model->setSize($fileSize);
                        if($model->update()){
                            $this->flash->success($this->helper->at('Photo added'));
                        }
                    }
                }
            }
        }
    }

    private function uploadPhoto($model)
    {
        if ($this->request->isPost()) {
            if ($this->request->hasFiles() == true) {
                foreach ($this->request->getUploadedFiles() as $file) {
                    $key = explode('.', $file->getKey());
                    if($key[0] == 'image'){
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
                            'type' => 'documentation',
                        ]);
                        $imageFilter->remove();
    
                        
                        $image = new \Phalcon\Image\Adapter\GD($file->getTempName());  
                        
                        $image->save($imageFilter->originalAbsPath());
    
                        $model->setImage($imageFilter->originalRelPath());
                        $model->update();
    
                        $this->flash->success($this->helper->at('Image added'));
                    }
                }
            }
        }
    }

}