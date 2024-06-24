<?php

namespace Services\Controller;

use Application\Mvc\Controller;
use Services\Model\Services;
use Services\Form\ServicesForm;
use Services\Model\Category;
use Services\Model\Gallery;

class AdminController extends Controller
{

    public function initialize()
    {
        $this->setAdminEnvironment();
        $this->helper->activeMenu()->setActive('admin-services');
    }

    public function indexAction()
    {
        $page = $this->request->getQuery('page', 'int', 1);
        $category = $this->dispatcher->getParam('category');
        $category_id = null;

        $categorys = Category::find();

        $this->view->services = Services::find();     
        $this->view->category_id = $category_id;

        $this->helper->title($this->helper->at('Manage Services'), true);
    }

    public function addAction()
    {
        $this->view->pick(['admin/edit']);
        $form = new ServicesForm();
        $model = new Services();   

        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->bind($post, $model);

            if ($form->isValid()) {
                if ($model->create()) {
                    $form->bind($post, $model);
                    if ($model->update()) {
                        $this->flash->success($this->helper->at('Services created'));
                        return $this->redirect($this->url->get() . 'services/admin/edit/' . $model->getId() . '?lang=' . LANG);
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

        $this->helper->title($this->helper->at('Create a service'), true);

    }

    public function editAction($id)
    {
        $id = (int) $id;
        $form = new ServicesForm();
        $model = Services::findFirst($id); 

        if ($this->request->isPost()) {
            $post = $this->request->getPost();            
            $form->bind($post, $model);
            if ($form->isValid()) {
                if ($model->save()) {                   
                    $this->flash->success($this->helper->at('Services edited'));

                    return $this->redirect($this->url->get() . 'services/admin/edit/' . $model->getId() . '?lang=' . LANG);
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
        $this->helper->title($this->helper->at('Edit services'), true);
    }

    public function deleteAction($id)
    {
        $model = Services::findFirst($id);

        if ($this->request->isPost()) {

            $model->delete();
            $this->redirect($this->url->get() . 'services/admin');
        }

        $this->view->model = $model;
        $this->helper->title($this->helper->at('Unpublishing'), true);
    }

}
