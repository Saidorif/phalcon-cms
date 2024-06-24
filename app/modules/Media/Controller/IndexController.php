<?php

namespace Media\Controller;

use Application\Mvc\Controller;
use Media\Model\Helper\MediaHelper;
use Media\Model\Media;
use Media\Model\Category;
use Phalcon\Exception;
use Cms\Model\Settings;

class IndexController extends Controller
{
    
	public function indexAction()
    {
    	$parameters['order'] = "sort ASC";
        $foto = Media::find('category_id = "1"');
        $video = Media::find('category_id = "2"');
        $category = Category::find($parameters);

        $settings = Settings::findFirst(1);
        $curLang = $this->helper->currentUrl(LANG);
        $meta_url = $this->helper->base_url().$curLang.'media';
        $meta_image = $this->helper->base_url().'/'.$settings->getLogo();

        $this->helper->title()->append($this->helper->translate('Media'));
        $this->helper->meta()->set('title', $this->helper->translate('Media'));
        $this->helper->meta()->set('description', $mediaResult->meta_description);  
        $this->helper->meta()->set('type', 'article');
        $this->helper->meta()->set('site_name', $settings->getSiteName());
        $this->helper->meta()->set('url', $meta_url);
        $this->helper->meta()->set('image', $meta_image);      

        $this->view->title = $this->helper->translate('Media');
        $this->view->videogallery = $video;
        $this->view->fotogallery = $foto;
        $this->view->category = $category;
    }

    public function viewAction()
    {
    	$slug = $this->dispatcher->getParam('slug', 'string');
    	$mediaResult = Media::findFirstBySlug($slug); 

        $settings = Settings::findFirst(1);
        $curLang = $this->helper->currentUrl(LANG);
        $meta_url = $this->helper->base_url().$curLang.'media/'.$slug;        
        $meta_image = $this->helper->base_url().'/'.$mediaResult->getAnons();

        $this->helper->title()->append($mediaResult->title);
        $this->helper->meta()->set('title', $mediaResult->title);
        $this->helper->meta()->set('description', $mediaResult->meta_description); 
        $this->helper->meta()->set('type', 'article');
        $this->helper->meta()->set('site_name', $settings->getSiteName());
        $this->helper->meta()->set('url', $meta_url);
        $this->helper->meta()->set('image', $meta_image);        

        $this->view->mediaResult = $mediaResult;
    }

}
