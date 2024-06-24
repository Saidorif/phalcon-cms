<?php

namespace Documentation\Controller;

use Application\Mvc\Controller;
use Documentation\Model\Category;
use Documentation\Form\CategoryForm;

class CategoryController extends Controller
{

    public function initialize()
    {
        $this->setAdminEnvironment();
        $this->helper->activeMenu()->setActive('admin-documentation');
    }

    public function indexAction()
    {
        $this->view->entries = Category::find();
        $this->helper->title($this->helper->at('Category'), true);
    }

    public function addAction()
    {
        $this->view->pick('category/edit');
        $model = new Category();
        $form = new CategoryForm();  
        
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
                
            $form->bind($post, $model);
            if ($form->isValid()) {
                if ($model->create()) {
                    $form->bind($post, $model);                    
                    if ($model->update()) {
                        $this->flash->success($this->helper->at('Created has been successful'));
                        $this->redirect($this->url->get() . 'documentation/category/edit/' . $model->getId() . '?lang=' . LANG);
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

        $this->view->title = $this->helper->at('Adding category');
        $this->helper->title($this->view->title);

    }

    public function editAction($id)
    {
        $id = (int) $id;
        $form = new CategoryForm();
        $model = Category::findFirst($id); 

        if (!$model) {
            $this->redirect($this->url->get() . 'documentation/category/add');
        }        
       
        if ($this->request->isPost()) {
            $post = $this->request->getPost();            
            $form->bind($post, $model);
            if ($form->isValid()) {
                if ($model->save()) {
                    $this->flash->success($this->helper->at('Updated has been successful'));
                    $this->redirect($this->url->get() . 'documentation/category/edit/' . $model->getId() . '?lang=' . LANG);
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
        $model = Category::findFirst($id);
        if ($model) {

            if ($this->request->isPost()) {
                $model->delete();
                $this->redirect($this->url->get() . 'documentation/category/index');
            }

            $this->view->model = $model;
        }

    }



}