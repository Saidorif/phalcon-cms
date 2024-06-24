<?php


namespace Portfolio\Controller;

use Application\Mvc\Controller;
use Portfolio\Form\CategoryForm;
use Portfolio\Model\Category;

class CategoryController extends Controller
{

    public function initialize()
    {
        $this->setAdminEnvironment();
    }

    public function indexAction()
    {
        $parameters['order'] = "sort ASC";
        $this->view->entries = Category::find($parameters);

        $this->helper->title($this->helper->at('Manage Categories of Portfolio'), true);
    }

    public function addAction()
    {
        $this->view->pick(array('category/edit'));

        $form = new CategoryForm();
        $model = new Category();

        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->bind($post, $model);

            if ($form->isValid()) {
                if ($model->create()) {
                    $form->bind($post, $model);
                    if ($model->update()) {
                        $this->flash->success('Category created');
                        return $this->redirect($this->url->get() . 'portfolio/category/edit/' . $model->getId() . '?lang=' . LANG);
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

        $this->view->model = $model;
        $this->view->form = $form;
        $this->helper->title($this->helper->at('Adding Category of Portfolio'));
    }

    public function editAction($id)
    {
        $form = new CategoryForm();
        $model = Category::findFirst($id);

        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->bind($post, $model);

            if ($form->isValid()) {
                if ($model->update()) {
                    $this->flash->success('Category created');
                    return $this->redirect($this->url->get() . 'portfolio/category/edit/' . $model->getId() . '?lang=' . LANG);
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
        $this->helper->title($this->helper->at('Manage Category of Portfolio'));
    }

    public function deleteAction($id)
    {
        $model = Category::findFirst($id);
        $count = Category::count();
        if ($count == 1) {
            $this->flash->error($this->helper->at('Can not Delete the last Portfolio category'));
            return;
        }

        if ($this->request->isPost()) {
            $model->delete();
            $this->redirect($this->url->get() . 'portfolio/category');
        }

        $this->view->model = $model;
        $this->helper->title($this->helper->at('Delete Category'));
    }

} 