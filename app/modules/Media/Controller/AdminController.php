<?php

namespace Media\Controller;

use Application\Mvc\Controller;
use Media\Model\Media;
use Media\Form\MediaForm;
use Media\Model\Category;
use Media\Model\Gallery;

class AdminController extends Controller
{

    public function initialize()
    {
        $this->setAdminEnvironment();
        $this->helper->activeMenu()->setActive('admin-media');
    }

    public function indexAction()
    {
        $page = $this->request->getQuery('page', 'int', 1);
        $category = $this->dispatcher->getParam('category');
        $category_id = null;

        $categorys = Category::find();

        $this->view->media = Media::find();     
        $this->view->category_id = $category_id;

        $this->helper->title($this->helper->at('Manage Media'), true);
    }

    public function addAction()
    {
        $this->view->pick(['admin/edit']);
        $form = new MediaForm();
        $model = new Media();   

        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->bind($post, $model);

            if ($form->isValid()) {
                if ($model->create()) {
                    $form->bind($post, $model);
                    if ($model->update()) {
                        $this->uploadVideo($model);
                        $this->uploadImage($model);
                        $this->flash->success($this->helper->at('Media created'));
                        return $this->redirect($this->url->get() . 'media/admin/edit/' . $model->getId() . '?lang=' . LANG);
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

        $this->helper->title($this->helper->at('Create a media'), true);

    }

    public function editAction($id)
    {
        $id = (int) $id;
        $form = new MediaForm();
        $model = Media::findFirst($id); 

        if ($this->request->isPost()) {
            $post = $this->request->getPost();            
            $form->bind($post, $model);
            if ($form->isValid()) {
                if ($model->save()) {
                    $this->uploadVideo($model);                    
                    $this->uploadImage($model);                    
                    $this->flash->success($this->helper->at('Media edited'));

                    return $this->redirect($this->url->get() . 'media/admin/edit/' . $model->getId() . '?lang=' . LANG);
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
        $this->helper->title($this->helper->at('Edit media'), true);
    }

    public function deleteAction($id)
    {
        $model = Media::findFirst($id);

        if ($this->request->isPost()) {

            $imageFilter = new \Image\Storage([
                'id'   => $model->getId(),
                'type' => 'media',
            ]);
            $imageFilter->remove();

            if($model->getVideo()){
                $path = ROOT.'/'.$model->getVideo();
                unlink($path);
            }

            $gallery = Gallery::find('media_id='.$model->getId());              
              
            foreach ($gallery as $g) {                
                if($g){
                    $imageFilter = new \Image\Storage([
                        'id'   => $g->getFileId(),
                        'type' => 'media_gallery',
                    ]);
                    $imageFilter->remove();
                    $g->delete();
                }               
            }

            $model->delete();
            $this->redirect($this->url->get() . 'media/admin');
        }

        $this->view->model = $model;
        $this->helper->title($this->helper->at('Unpublishing'), true);
    }

    private function uploadVideo($model)
    {
        if ($this->request->isPost()) {
            if ($this->request->hasFiles() == true) {
                foreach ($this->request->getUploadedFiles() as $file) {
                    if (!$file->getTempName()) {
                        return;
                    }
                    if (!in_array($file->getType(), [
                        'video/mp4',
                    ])
                    ) {
                        return $this->flash->error($this->helper->at('Only allow formats .mp4'));
                    }
                    
                    $hash = $model->getId().'.'.$file->getExtension();
                    $currentPath = ROOT.'/uploads/video-gallery/'.$hash;
                    $video = substr($currentPath, strpos($currentPath, 'uploads'));
                    $file->moveTo($currentPath);

                    $model->setVideo($video);
                    $model->update();

                    $this->flash->success($this->helper->at('Video added'));
                }
            }
        }
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
                            'type' => 'media',
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
                            'type' => 'media_gallery',
                        ]);
                        $photoFilter->remove();
                        
                        $img = new \Phalcon\Image\Adapter\GD($file->getTempName());  
                        $img->save($photoFilter->originalAbsPath());
                        $photo->setMediaId($model->getId());
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
                'type' => 'media_gallery',
            ]);
            $imageFilter->remove();
            $gallery->delete();                  
        }        
    }

}
