<?php

namespace Portfolio\Controller;

use Application\Mvc\Controller;
use Portfolio\Model\Helper\PortfolioHelper;
use Portfolio\Model\Portfolio;
use Portfolio\Model\Category;
use Phalcon\Exception;
use Cms\Model\Settings;

class IndexController extends Controller
{
    
	public function indexAction()
    {
    	$parameters['order'] = "sort ASC";
        $portfolio = Portfolio::find();
        $category = Category::find($parameters);

    	$portfolioResult = Portfolio::findFirstBySlug($slug); 

        $settings = Settings::findFirst(1);
        $curLang = $this->helper->currentUrl(LANG);
        $meta_url = $this->helper->base_url().$curLang.'portfolio';
        $meta_image = $this->helper->base_url().'/'.$settings->getLogo();

        $this->helper->title()->append($this->helper->translate('Portfolio'));
        $this->helper->meta()->set('title', $this->helper->translate('Portfolio'));
        $this->helper->meta()->set('description', $portfolioResult->meta_description);  
        $this->helper->meta()->set('type', 'article');
        $this->helper->meta()->set('site_name', $settings->getSiteName());
        $this->helper->meta()->set('url', $meta_url);
        $this->helper->meta()->set('image', $meta_image);      

        $this->view->title = $this->helper->translate('Portfolio');
        $this->view->portfolio = $portfolio;
        $this->view->category = $category;
    }

    public function viewAction()
    {
    	$slug = $this->dispatcher->getParam('slug', 'string');
    	$portfolioResult = Portfolio::findFirstBySlug($slug); 

        $settings = Settings::findFirst(1);
        $curLang = $this->helper->currentUrl(LANG);
        $meta_url = $this->helper->base_url().$curLang.'portfolio/'.$slug;        
        $meta_image = $this->helper->base_url().'/'.$portfolioResult->getAnons();

        $this->helper->title()->append($portfolioResult->title);
        $this->helper->meta()->set('title', $portfolioResult->title);
        $this->helper->meta()->set('description', $portfolioResult->meta_description); 
        $this->helper->meta()->set('type', 'article');
        $this->helper->meta()->set('site_name', $settings->getSiteName());
        $this->helper->meta()->set('url', $meta_url);
        $this->helper->meta()->set('image', $meta_image);       

        $this->view->portfolioResult = $portfolioResult;
    }

}
