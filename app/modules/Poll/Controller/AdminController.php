<?php

namespace Poll\Controller;

use Application\Mvc\Controller;
use Poll\Model\Poll;
use Poll\Form\PollForm;
use Poll\Model\Options;

class AdminController extends Controller
{

    public function initialize()
    {
        $this->setAdminEnvironment();
        $this->helper->activeMenu()->setActive('admin-poll');
    }

    public function indexAction()
    {
        $this->view->entries = Poll::find();
        $this->helper->title($this->helper->at('Poll'), true);
    }

    public function addAction()
    {
        $this->view->pick('admin/edit');
        $model = new Poll();
        $form = new PollForm();  
        
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
                
            $form->bind($post, $model);
            if ($form->isValid()) {
                if ($model->create()) {
                    $model->updateFields($post);
                    $form->bind($post, $model);                    
                    if ($model->update()) { 
                        $this->options($model);                       
                        $this->flash->success($this->helper->at('Created has been successful'));
                        $this->redirect($this->url->get() . 'poll/admin/edit/' . $model->getId() . '?lang=' . LANG);
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

        
        $this->view->title = $this->helper->at('Adding poll');
        $this->helper->title($this->view->title);
        $this->view->form = $form;
        $this->view->fields = $model->options;

    }

    public function editAction($id)
    {
        $id = (int) $id;
        $form = new PollForm();
        $model = Poll::findFirst($id); 

        if (!$model) {
            $this->redirect($this->url->get() . 'poll/admin/add');
        }        
       
        if ($this->request->isPost()) {
            $post = $this->request->getPost();            
            $form->bind($post, $model);
            if ($form->isValid()) {
                 $model->updateFields($post);
                if ($model->save()) {
                    $this->options($model);
                    $this->flash->success($this->helper->at('Updated has been successful'));
                    $this->redirect($this->url->get() . 'poll/admin/edit/' . $model->getId() . '?lang=' . LANG);
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
        $this->view->fields = $model->options;

        $this->helper->title($this->helper->at('Editing poll'), true);

    }

    public function deleteAction($id)
    {
        $id = (int) $id;
        $model = Poll::findFirst($id);
        if ($model) {

            if ($this->request->isPost()) {
              
                $model->delete();
                $this->redirect($this->url->get() . 'poll/admin/index');
            }

            $this->view->model = $model;
        }

    }

    private function options($model)
    {
        if ($this->request->isPost()) { 

            $title_array = $this->request->getPost('title_add');   
            $vote_array = $this->request->getPost('value_add');   
            $id_array = $this->request->getPost('id_add'); 
            

            foreach ($title_array as $key => $title) {
                $vote = $vote_array[$key];             
                $id = $id_array[$key];             
                if($id == 0){                    
                    $addModel = new Options();
                    $addModel->setPollId($model->getId());
                    $addModel->setTitle($title);              
                    $addModel->setVote($vote);              
                    $addModel->setLanguage(LANG);                
                    $addModel->save();
                } else {
                    $addModel = Options::findFirst($id);
                    $addModel->setTitle($title);              
                    $addModel->setVote($vote);             
                    $addModel->update();
                }
            }                     
        }
    }

    public function removefieldAction($id)
    {        
        $addModel = Options::findFirst($id);
        if ($addModel->getId()) { 
            $addModel->delete();                  
        }        
    }


}