<?php

namespace Knowledge\Controller;

use Application\Mvc\Controller;
use Knowledge\Model\Knowledge;
use Knowledge\Form\KnowledgeForm;
use Knowledge\Model\KnowledgePivot;

class AdminController extends Controller
{

    public function initialize()
    {
        $this->setAdminEnvironment();
        $this->helper->activeMenu()->setActive('admin-knowledge');
    }

    public function indexAction()
    {
        $this->view->entries = Knowledge::find(['conditions' => 'parent_id = "0"']);
        $this->helper->title($this->helper->at('Knowledge'), true);
    }

    public function addAction()
    {
        $this->view->pick('admin/edit');
        $model = new Knowledge();
        $items = Knowledge::find();
        $form = new KnowledgeForm();
        
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->bind($post, $model);
            if ($form->isValid()) {
                if ($model->create()) {
                    $form->bind($post, $model);                    
                    if ($model->update()) {
                        $this->uploadImage($model);
                        //create categories
                        if(!empty($post['items'])){
                            foreach ($post['items'] as $item) {
                                $cat = new KnowledgePivot();
                                $cat->setParentId($model->id);
                                $cat->setKnowledgeId($item);
                                $cat->save();
                            }
                        }
                        $this->flash->success($this->helper->at('Created has been successful'));
                        $this->redirect($this->url->get() . 'knowledge/admin/edit/' . $model->getId() . '?lang=' . LANG);
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

        $this->view->title = $this->helper->at('Adding knowledge');
        $this->view->items = $items;
        $this->helper->title($this->view->title);

    }

    public function editAction($id)
    {
        $id = (int) $id;
        $form = new KnowledgeForm();
        $model = Knowledge::findFirst($id);
        $items = Knowledge::find();
        //print_r($items->toArray());die();

        if (!$model) {
            $this->redirect($this->url->get() . 'knowledge/admin/add');
        }

        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->bind($post, $model);
            if ($form->isValid()) {
                if ($model->save()) {
                    //create categories
                    if(!empty($post['items'])){
                        //delete old categories
                        $old_items = KnowledgePivot::find([
                            'conditions' => 'parent_id = ?1',
                            'bind' => [1 => $model->getId()]
                        ]);
                        if($old_items){
                            foreach ($old_items as $old_item) {
                                $old_item->delete();
                            }
                        }
                        foreach ($post['items'] as $item) {
                            $cat = new KnowledgePivot();
                            $cat->setParentId($model->id);
                            $cat->setKnowledgeId($item);
                            $cat->save();
                        }
                    }
                    $this->uploadImage($model);
                    $this->flash->success($this->helper->at('Updated has been successful'));
                    $this->redirect($this->url->get() . 'knowledge/admin/edit/' . $model->getId() . '?lang=' . LANG);
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
        $this->view->setVar('knowledge', $model);
        $this->view->setVar('items', $items);
        $this->view->setVar('cats', $model->getItemsArray());
        $this->helper->title($this->helper->at('Editing knowledge'), true);

    }

    public function deleteAction($id)
    {
        $id = (int) $id;
        $model = Knowledge::findFirst($id);
        if ($model) {

            if ($this->request->isPost()) {
                if($model->getImage()){
                    $path = ROOT.'/'.$model->getImage();
                    unlink($path);
                }
                $model->delete();
                $this->redirect($this->url->get() . 'knowledge/admin/index');
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
                    
                    $hash = time().'.'.$file->getExtension();
                    $currentPath = ROOT.'/uploads/knowledge/'.$hash;
                    $img = substr($currentPath, strpos($currentPath, 'uploads'));
                    $file->moveTo($currentPath);

                    $model->setImage($img);
                    $model->update();

                    $this->flash->success($this->helper->at('Photo added'));
                }
            }
        }
    }

}