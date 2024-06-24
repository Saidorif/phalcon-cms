<?php

namespace Index\Controller;

use Application\Mvc\Controller;
use Page\Model\Helper\PageHelper;
use Page\Model\Page;
use Phalcon\Exception;
use Cms\Model\Settings;

class IndexController extends Controller
{

    public function indexAction()
    {
        $this->view->bodyClass = 'home';
        
        $pageHelper = new PageHelper();
        $pageResult = $pageHelper->pageBySlug('index');

        $settings = Settings::findFirst(1);        
        $meta_url = $this->helper->base_url();        
        $meta_image = $this->helper->base_url().'/'.$settings->getLogo();

        if (!$pageResult) {
           throw new Exception("Page 'index' not found");
        }
        
        $this->helper->title()->append($pageResult->title);
        $this->helper->meta()->set('title', $pageResult->title);
        $this->helper->meta()->set('description', $pageResult->meta_description);
        $this->helper->meta()->set('type', 'website');
        $this->helper->meta()->set('site_name', $settings->getSiteName());
        $this->helper->meta()->set('url', $meta_url);
        $this->helper->meta()->set('image', $meta_image);
        
        $this->helper->menu->setActive('index');
    }
}
