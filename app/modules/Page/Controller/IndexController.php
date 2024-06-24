<?php

namespace Page\Controller;

use Application\Mvc\Controller;
use Page\Model\Helper\PageHelper;
use Page\Model\Page;
use Phalcon\Mvc\Dispatcher\Exception;
use Cms\Model\Settings;

class IndexController extends Controller
{

    public function indexAction()
    {
        $slug = $this->dispatcher->getParam('slug', 'string');
        $settings = Settings::findFirst(1);
        $curLang = $this->helper->currentUrl(LANG);
        $meta_url = $this->helper->base_url().$curLang.$slug;        
        $meta_image = $this->helper->base_url().'/'.$settings->getLogo();        
        
        $pageHelper = new PageHelper();
        $pageResult = $pageHelper->pageBySlug($slug);
        if (!$pageResult) {
            throw new Exception("Page '$slug.html' not found");
        }

        if(!$pageResult->meta_title){
            $this->helper->title()->append($pageResult->title);
            $this->helper->meta()->set('title', $pageResult->title);
        }
        if($pageResult->meta_title){
            $this->helper->title()->append($pageResult->meta_title);
            $this->helper->meta()->set('title', $pageResult->meta_title);
        }

        $this->helper->meta()->set('description', $pageResult->meta_description);
        $this->helper->meta()->set('type', 'article');
        $this->helper->meta()->set('site_name', $settings->getSiteName());
        $this->helper->meta()->set('url', $meta_url);
        $this->helper->meta()->set('image', $meta_image);

        if($pageResult->p->index_page == 1)        
            $this->helper->meta()->set('robots', 'noindex, nofollow');        

        $this->view->title  = $pageResult->title;
        $this->view->text = $pageResult->text;
    }

    public function contactsAction()
    {
        $pageHelper = new PageHelper();
        $pageResult = $pageHelper->pageBySlug('contacts');
        if (!$pageResult) {
            throw new Exception("Page 'contacts' not found");
        }

        $settings = Settings::findFirst(1);
        $curLang = $this->helper->currentUrl(LANG);
        $meta_url = $this->helper->base_url().$curLang.$slug;        
        $meta_image = $this->helper->base_url().'/'.$settings->getLogo();

        if(!$pageResult->meta_title){
            $this->helper->title()->append($pageResult->title);
            $this->helper->meta()->set('title', $pageResult->title);
        }
        if($pageResult->meta_title){
            $this->helper->title()->append($pageResult->meta_title);
            $this->helper->meta()->set('title', $pageResult->meta_title);
        }

        $this->helper->meta()->set('description', $pageResult->meta_description);
        $this->helper->meta()->set('type', 'article');
        $this->helper->meta()->set('site_name', $settings->getSiteName());
        $this->helper->meta()->set('url', $meta_url);
        $this->helper->meta()->set('image', $meta_image);

        if($pageResult->p->index_page == 1)        
            $this->helper->meta()->set('robots', 'noindex, nofollow');        

        $this->helper->menu->setActive('contacts');

        $this->view->title  = $pageResult->title;
        $this->view->text = $pageResult->text; 
        
    }

    public function adminAction()
    {  
        return $this->redirect($this->url->get() . 'admin/index');
    }
    

}
