<?php

namespace Cms\Controller;

use Application\Mvc\Controller;
use Cms\Model\Settings;
use Cms\Form\SettingsForm;

class SettingsController extends Controller
{

    public function initialize()
    {
        $this->setAdminEnvironment();
        $this->helper->activeMenu()->setActive('admin-settings');
        $this->view->languages_disabled = true;
    }

    public function indexAction()
    {
        $id = 1;
        $model = Settings::findFirst($id);

        $form = new SettingsForm();

        if ($this->request->isPost()) {        

          $post = $this->request->getPost();            
          $form->bind($post, $model);
          if ($form->isValid()) {                
            if ($model->save()) { 
              $this->flash->success($this->helper->at('Updated has been successful'));
              $this->redirect($this->url->get() . 'cms/settings');
            } else {
              $this->flashErrors($model);
            }
          } else {
              $this->flashErrors($form);
          }
        } else {
          $form->setEntity($model);
        }
        
        $this->view->form = $form;
        $this->helper->title($this->helper->at('Settings site'), true);
    } 

    public function fileAction($type) {   
      $model = Settings::findFirst(1);   
      if ($this->request->hasFiles() == true) {
        foreach ($this->request->getUploadedFiles() as $file) {                         
          if (!$file->getTempName()) {
              return;
          }
          
          if($type == 'logo'){
             
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
            
            if($model->getLogo()){
                $path = ROOT.'/'.$model->getLogo();
                unlink($path);
            }

            $hash = 'logo.'.$file->getExtension();
            $currentPath = ROOT.'/'.$hash;                    
            $file->moveTo($currentPath);

            $model->setLogo($hash);
            $model->update();

            $this->flash->success($this->helper->at('Logo updated'));

          } 

          if($type == 'favicon'){
                 
            if (!in_array($file->getType(), [
                'image/png',
                'image/x-icon',
            ])
            ) {                        
                return $this->flash->error('Only allow image formats ico, png');
            }

            if($model->getFavicon()){
                $path = ROOT.'/'.$model->getFavicon();
                unlink($path);
            }
            
            $hash = 'favicon.'.$file->getExtension();
            $currentPath = ROOT.'/'.$hash;                    
            $file->moveTo($currentPath);


            $image = new \Phalcon\Image\Adapter\GD($currentPath);
            if ($image->getWidth() > 128) {
              $image->resize(128,128)->crop(130,130);                    
            }
            $image->save($currentPath);

            $model->setFavicon($hash);
            $model->update();

            $this->flash->success($this->helper->at('Favicon updated'));

          }  
        }
      }
    }

}