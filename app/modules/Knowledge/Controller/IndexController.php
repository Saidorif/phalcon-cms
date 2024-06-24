<?php

namespace Knowledge\Controller;

use Application\Mvc\Controller;
use Knowledge\Model\Knowledge;

class IndexController extends Controller
{

    public function indexAction()
    {
        $this->view->entries = Knowledge::find([
            'conditions' => 'parent_id = ?1',
            'bind' => [1 => 0]
        ]);
        $this->helper->title($this->helper->translate('Knowledge'), true);
        $this->helper->meta()->set('description', $this->helper->translate('Knowledge'));
    }

    public function parentsAction($slug)
    {
        $slug = htmlspecialchars($slug);
        $entries = Knowledge::findFirst([
            'conditions' => 'slug = ?1',
            'bind' => [1 => $slug]
        ]);
        $this->view->entries = $entries;
        $this->view->parents = Knowledge::find([
            'conditions' => 'parent_id = ?1',
            'bind' => [1 => 0]
        ]);
        if($entries){
            $this->helper->title($this->helper->translate($entries->getTitle()), true);
        }
        $this->helper->meta()->set('description', $this->helper->translate('Knowledge'));
    }

    public function viewAction($parent,$slug)
    {
        $slug = htmlspecialchars($slug);
        $entries = Knowledge::findFirst([
            'conditions' => 'slug = ?1',
            'bind' => [1 => $slug]
        ]);
        $parent = Knowledge::findFirst([
            'conditions' => 'slug = ?1',
            'bind' => [1 => $parent]
        ]);
        if(!$entries){
            return $this->redirect($this->url->get().'knowledges');
        }
        if(!$parent){
            return $this->redirect($this->url->get().'knowledges');
        }
        $this->view->parents = Knowledge::find([
            'conditions' => 'parent_id = ?1',
            'bind' => [1 => 0]
        ]);
        $this->view->entries = $entries;
        $this->view->parent = $parent;
        $this->helper->title($this->helper->translate($entries->getTitle()), true);
        $this->helper->meta()->set('description', $this->helper->translate('Knowledge'));
    }

    public function showAction($parent,$slug,$link)
    {
        $slug = htmlspecialchars($slug);
        $entries = Knowledge::findFirst([
            'conditions' => 'slug = ?1',
            'bind' => [1 => $slug]
        ]);
        $parent = Knowledge::findFirst([
            'conditions' => 'slug = ?1',
            'bind' => [1 => $parent]
        ]);
        $item = Knowledge::findFirst([
            'conditions' => 'slug = ?1',
            'bind' => [1 => $link]
        ]);
        if(!$entries){
            return $this->redirect($this->url->get().'knowledges');
        }
        if(!$parent){
            return $this->redirect($this->url->get().'knowledges');
        }
        if(!$item){
            return $this->redirect($this->url->get().'knowledges');
        }
        $this->view->parents = Knowledge::find([
            'conditions' => 'parent_id = ?1',
            'bind' => [1 => 0]
        ]);
        $this->view->entries = $entries;
        $this->view->parent = $parent;
        $this->view->the_item = $item;
        $this->helper->title($this->helper->translate($entries->getTitle()), true);
        $this->helper->meta()->set('description', $this->helper->translate('Knowledge'));
    }

}
