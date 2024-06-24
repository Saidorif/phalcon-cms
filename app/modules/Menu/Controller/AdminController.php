<?php

namespace Menu\Controller;

use Application\Localization\Transliterator;
use Application\Mvc\Controller;
use Menu\Form\MenuForm;
use Menu\Model\Menus;
use Menu\Model\Translate\MenusTranslate;


class AdminController extends Controller
{

    public function initialize()
    {
        $this->helper->activeMenu()->setActive('menu');
    }

    public function indexAction()
    {
        $this->setAdminEnvironment();
        $this->view->roots = Menus::$roots;
        $this->helper->title($this->helper->at('Menu'), true);
    }

    public function addAction()
    {
        if (!$this->request->getPost() || !$this->request->isAjax()) {
            return $this->flash->error('post ajax required');
        }

        $root = $this->request->getPost('root');
        $title = $this->request->getPost('title', 'string');
        $slug = $this->request->getPost('slug', 'string');

        $model = new Menus();
        $model->setRoot($root);
        if ($model->create()) {
            $model->setTitle($title);
            $model->setSlug($slug);
            $model->setStatus(1);
            if ($model->update()) {
                $this->returnJSON([
                    'success' => true,
                    'id' => $model->getId(),
                    'slug' => $model->getSlug(),
                    'title' => $title,
                ]);
            } else {
                $this->returnJSON(['error' => implode(' | ', $model->getMessages())]);
            }
        } else {
            $this->returnJSON(['error' => implode(' | ', $model->getMessages())]);
        }
    }

    public function editAction($id)
    {
        $this->setAdminEnvironment();

        $form = new MenuForm();
        $model = Menus::findFirst($id);
        if (!$model) {
            $this->redirect($this->url->get() . 'menu/admin?lang=' . LANG);
        }

        if ($this->request->isPost()) {
            $form->bind($this->request->getPost(), $model);
            if ($form->isValid()) {                             
                if ($model->save()) {
                    $this->flash->success($this->helper->at('Updated has been successful'));
                    $this->redirect($this->url->get() . 'menu/admin?lang=' . LANG);
                } else {
                    $this->flashErrors($model);
                }
            } else {
                $this->flashErrors($form);
            }
        } else {
            $form->setEntity($model);
        }

        $this->helper->title($this->helper->at('Edit menu'), true);

        $this->view->form = $form;
        $this->view->model = $model;
    }

    public function deleteAction()
    {
        if (!$this->request->getPost() || !$this->request->isAjax()) {
            return $this->flash->error('post ajax required');
        }

        $category_id = $this->request->getPost('category_id');

        $model = Menus::findFirst($category_id);
        if ($model) {
            if ($model->delete()) {
                $this->returnJSON([
                    'success' => true,
                    'root' => $model->getRoot(),
                ]);
            }
        }
    }

    public function statusAction($id)
    {
        if (!$this->request->getPost() || !$this->request->isAjax()) {
            return $this->flash->error('post ajax required');
        }

        $model = Menus::findFirst($id);
        $status = $this->request->getPost('status');
              
        if ($model) {
          $model->setStatus($status);
          if ($model->save()) {
            $this->returnJSON([
              'success' => true,
              'root' => $model->getRoot(),
            ]);
          }
        }
    }

    public function saveMenuAction()
    {
        if (!$this->request->getPost() || !$this->request->isAjax()) {
            return $this->flash->error('post ajax required');
        }

        $data = $this->request->getPost('data');

        foreach ($data as $el) {
            if ($el['item_id']) {
                $model = Menus::findFirst($el['item_id']);
                if ($model) {
                    if ($el['parent_id']) {
                        $model->setParentId($el['parent_id']);
                    } else {
                        $model->setParentId(null);
                    }
                    $model->setDepth($el['depth']);
                    $model->setLeftKey($el['left']);
                    $model->setRightKey($el['right']);
                    $model->update();
                }
            }
        }

        $this->returnJSON(['success' => true]);

    }

}