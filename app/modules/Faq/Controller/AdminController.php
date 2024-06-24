<?php

namespace Faq\Controller;

use Application\Mvc\Controller;
use Faq\Model\Faq;
use Faq\Form\FaqForm;

class AdminController extends Controller
{

    public function initialize()
    {
        $this->setAdminEnvironment();
        $this->helper->activeMenu()->setActive('admin-faq');
    }

    public function indexAction()
    {
        $this->view->entries = Faq::find();
        $this->helper->title($this->helper->at('Faq'), true);
    }

    public function addAction()
    {
        $this->view->pick('admin/edit');
        $model = new Faq();
        $form = new FaqForm();  
        
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
                
            $form->bind($post, $model);
            if ($form->isValid()) {
                if ($model->create()) {
                    $form->bind($post, $model);                    
                    if ($model->update()) {                        
                        $this->flash->success($this->helper->at('Created has been successful'));
                        $this->redirect($this->url->get() . 'faq/admin/edit/' . $model->getId() . '?lang=' . LANG);
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

        $this->view->title = $this->helper->at('Adding faq');
        $this->helper->title($this->view->title);

    }

    public function editAction($id)
    {
        $id = (int) $id;
        $form = new FaqForm();
        $model = Faq::findFirst($id); 

        if (!$model) {
            $this->redirect($this->url->get() . 'faq/admin/add');
        }        
       
        if ($this->request->isPost()) {
            $post = $this->request->getPost();            
            $form->bind($post, $model);
            if ($form->isValid()) {
                if ($model->save()) {
                    $this->flash->success($this->helper->at('Updated has been successful'));
                    $this->redirect($this->url->get() . 'faq/admin/edit/' . $model->getId() . '?lang=' . LANG);
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
        $this->view->setVar('faq', $model);

        $this->helper->title($this->helper->at('Editing faq'), true);

    }

    public function deleteAction($id)
    {
        $id = (int) $id;
        $model = Faq::findFirst($id);
        if ($model) {

            if ($this->request->isPost()) {
              
                $model->delete();
                $this->redirect($this->url->get() . 'faq/admin/index');
            }

            $this->view->model = $model;
        }

    }


}