<?php

namespace Services\Controller;

use Application\Mvc\Controller;
use Services\Model\Helper\ServicesHelper;
use Services\Model\Services;
use Services\Model\Category;
use Phalcon\Exception;
use Cms\Model\Settings;

class IndexController extends Controller
{

    public function legalAction()
    {
        
        $category = Category::findFirst("slug = 'legal-entities'");
        $legals = Services::find("category_id = '". $category->getId()."'");

        $array = array();
        $groupData = array();
        foreach ( $legals as $value ) {            
            $array['id'] = $value->getId();
            $array['title'] = $value->getTitle();
            $array['text'] = $value->getText();
            $groupData[$value->getType()][] = $array;
        }

        $settings = Settings::findFirst(1);
        $curLang = $this->helper->currentUrl(LANG);
        $meta_url = $this->helper->base_url().$curLang.'services';
        $meta_image = $this->helper->base_url().'/'.$settings->getLogo();

        $this->helper->title()->append($this->helper->translate('Legal entities'));
        $this->helper->meta()->set('title', $this->helper->translate('Legal entities'));
        $this->helper->meta()->set('description', $this->helper->translate('Legal entities'));
        $this->helper->meta()->set('type', 'article');
        $this->helper->meta()->set('site_name', $settings->getSiteName());
        $this->helper->meta()->set('url', $meta_url);
        $this->helper->meta()->set('image', $meta_image);       
        $this->view->title = $this->helper->translate('Legal entities');
        $this->view->category = $category->getSlug();
        $this->view->legals = $groupData;
    }

    public function individualsAction()
    {
        
        $category = Category::findFirst("slug = 'individuals'");
        $individualsResult = Services::find("category_id = '". $category->getId()."'");

        $settings = Settings::findFirst(1);
        $curLang = $this->helper->currentUrl(LANG);
        $meta_url = $this->helper->base_url().$curLang.'services';
        $meta_image = $this->helper->base_url().'/'.$settings->getLogo();

        $this->helper->title()->append($this->helper->translate('Individuals'));
        $this->helper->meta()->set('title', $this->helper->translate('Individuals'));
        $this->helper->meta()->set('description', $this->helper->translate('Individuals'));
        $this->helper->meta()->set('type', 'article');
        $this->helper->meta()->set('site_name', $settings->getSiteName());
        $this->helper->meta()->set('url', $meta_url);
        $this->helper->meta()->set('image', $meta_image);       
        $this->view->title = $this->helper->translate('Individuals');       
        $this->view->category = $category->getSlug();
        $this->view->individualsResult = $individualsResult;
    }

    public function structuralAction()
    {
        
        $category = Category::findFirst("slug = 'structural-units'");
        $structuralResult = Services::find("category_id = '". $category->getId()."'");

        $settings = Settings::findFirst(1);
        $curLang = $this->helper->currentUrl(LANG);
        $meta_url = $this->helper->base_url().$curLang.'services';
        $meta_image = $this->helper->base_url().'/'.$settings->getLogo();

        $this->helper->title()->append($this->helper->translate('Structural'));
        $this->helper->meta()->set('title', $this->helper->translate('Structural'));
        $this->helper->meta()->set('description', $this->helper->translate('Structural'));
        $this->helper->meta()->set('type', 'article');
        $this->helper->meta()->set('site_name', $settings->getSiteName());
        $this->helper->meta()->set('url', $meta_url);
        $this->helper->meta()->set('image', $meta_image);       
        $this->view->title = $this->helper->translate('Structural');
        $this->view->structuralResult = $structuralResult;
    }

    public function viewAction()
    {
        $slug = $this->dispatcher->getParam('slug', 'string');
        $category = Category::findFirst("slug = '" .$slug."'");
        $servicesResult = Services::find("category_id = '". $category->getId()."'");

        $settings = Settings::findFirst(1);
        $curLang = $this->helper->currentUrl(LANG);
        $meta_url = $this->helper->base_url().$curLang.'services/'.$slug;
        $meta_image = $this->helper->base_url().'/'.$settings->getLogo();

        $this->helper->title()->append($category->getTitle());
        $this->helper->meta()->set('title', $category->getTitle());
        $this->helper->meta()->set('description', $category->getTitle());
        $this->helper->meta()->set('type', 'article');
        $this->helper->meta()->set('site_name', $settings->getSiteName());
        $this->helper->meta()->set('url', $meta_url);
        $this->helper->meta()->set('image', $meta_image);

        $this->view->title = $category->getTitle();
        $this->view->servicesResult = $servicesResult;
    }

}
