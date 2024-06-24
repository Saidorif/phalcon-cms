<?php

namespace Page\Controller;

use Application\Mvc\Controller;
use Page\Model\Page;
use Page\Form\PageForm;
use Menu\Model\Menus;

class AdminController extends Controller
{

    public function initialize()
    {
        $this->setAdminEnvironment();
        $this->helper->activeMenu()->setActive('admin-page');
        Page::setTranslateCache(false);
    }

    public function indexAction()
    {
        $this->view->entries = Page::find();

        $this->helper->title($this->helper->at('Manage Pages'), true);
    }

    public function addAction()
    {
        $this->view->pick(['admin/edit']);
        $form = new PageForm();
        $model = new Page();

        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->bind($post, $model);
            if ($form->isValid()) {
                if ($model->create()) {
                    $form->bind($post, $model);
                    $model->updateFields($post);
                    if ($model->update()) {
                        $this->uploadImage($model);
                        $this->menuCheck($model->getId());
                        $this->flash->success($this->helper->at('Page created'));
                        return $this->redirect($this->url->get() . 'page/admin/edit/' . $model->getId() . '?lang=' . LANG);
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

        $this->helper->title($this->helper->at('Manage Pages'), true);

        $this->view->model = $model;
        $this->view->form = $form;
    }

    public function editAction($id)
    {
        $id = (int) $id;
        $form = new PageForm();
        $model = Page::findFirst($id);

        if ($model->getSlug() == 'index') {
            $form->get('slug')->setAttribute('disabled', 'disabled');
        }

        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->bind($post, $model);
           
            if ($form->isValid()) {                
                $model->updateFields($post);
                if ($model->save()) {
                    $this->uploadImage($model);
                    $this->menuCheck($model->getId());
                    $this->flash->success($this->helper->at('Updated has been successful'));

                    // Очищаем кеш страницы
                    $query = "slug = '{$model->getSlug()}'";
                    $key = md5("Page::findFirst($query)");
                    $this->cache->delete($key);                    
                    return $this->redirect($this->url->get() . 'page/admin/edit/' . $model->getId() . '?lang=' . LANG);
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
        $this->helper->title($this->helper->at('Edit Page'), true);
    }

    public function deleteAction($id)
    {
        $model = Page::findFirst($id);
        $menus = Menus::findFirst("slug = '".$model->getSlug()."'");

        if ($model->getSlug() == 'index') {
            $this->flash->error($this->helper->at('Index page can not be removed'));
            return $this->redirect($this->url->get() . 'page/admin');
        }

        if ($this->request->isPost()) {
            if($menus)
              $menus->delete();
          
            $model->delete();
            $this->redirect($this->url->get() . 'page/admin');
        }

        $this->view->model = $model;
        $this->helper->title($this->helper->at('Delete Page'), true);
    }

    private function menuCheck($id)
    {
      $model = Page::findFirst($id);  
      
      if($model->getMenuCheck() == 1){
        $menus = Menus::findFirst("slug = '".$model->getSlug()."'");          
        if($menus){
          if(!$menus->getTitle()){
            $menus->setTitle($model->getTitle());
            $menus->setStatus(1);
            $menus->save();
          } else {
            $menus->setStatus(1);
            $menus->save();
          }
        } else {
            $menus = new Menus;
            $menus->setRoot('main');
            $menus->setSlug($model->getSlug());
            $menus->setDepth(1);
            if ($menus->create()) {
              $menus->setTitle($model->getTitle());
              $menus->setStatus(1);
              $menus->save();
            }
        }          
      }
      if($model->getMenuCheck() == 0){
        $menus = Menus::findFirst("slug = '".$model->getSlug()."'");          
        if($menus){           
          $menus->setStatus(0);
          $menus->save();           
        }         
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
                        'image/gif',
                        'image/jpeg',
                        'image/jpg',
                        'image/svg+xml',
                    ])
                    ) {                        
                        return $this->flash->error('Only allow image formats gif, jpeg, svg, png');
                    }
                    
                    if($model->getAnons()){
                        $path = '/uploads/pages/'.$model->getAnons();
                        unlink($path);
                    }

                    $hash = time().'_file.'.$file->getExtension();
                    $currentPath = ROOT.'/uploads/pages/'.$hash;                    
                    $file->moveTo($currentPath);

                    $model->setAnons('uploads/pages/'.$hash);
                    $model->update();

                    $this->flash->success($this->helper->at('Photo added'));
                }
            }
        }
    }

} 