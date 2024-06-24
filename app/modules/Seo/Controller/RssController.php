<?php

namespace Seo\Controller;

use Application\Mvc\Controller;
use Cms\Model\Language;
use Application\Mvc\Router\DefaultRouter;
use Cms\Model\Settings;
use Publication\Model\Publication;
use Publication\Model\Type;

class RssController extends Controller
{
    private $models;
    private $newsfeed = [];
    
    public function indexAction()
    {      
      $typeNews = Type::findFirst("slug = 'news'");
      $typeArticle = Type::findFirst("slug = 'articles'");
      if($typeNews)
        $typeNewsId = $typeNews->getId(); 
      if($typeArticle)
        $typeArticleId = $typeArticle->getId(); 

      $publications = Publication::query()
      ->where("type_id IN ('".$typeNewsId."', '".$typeArticleId."')")
      ->order("id")
      ->execute();
     
      foreach ($publications as $publication) {
        $text = substr($publication->text, 0, 500);
        $link = $this->langUrlCustom(['for' => 'publication','type' => $publication->getTypeSlug(),'slug' => $publication->slug], LANG);        
        $this->newsfeed[] = [
          'title' => $publication->title,
          'description' => htmlentities($text),
          'link' => $this->helper->base_url().$link,
          'pubDate' => date('c', strtotime($publication->getDate())),
        ];       
      }      
      $rss = $this->getRawRss();          
      $this->response->setHeader('Content-Type', 'application/xml');
      $this->response->setContent($rss);
      return $this->response->send();
    }  

    public function langUrlCustom($params, $lang)
    {
        $routeName = $params['for'];
        $routeName = DefaultRouter::ML_PREFIX . $routeName . '_' . $lang;
        $params['for'] = $routeName;
        return $this->url->get($params);
    }  

    private function getRawRss()
    {      
      $settings = Settings::findFirst(1);
      $this->view->setRenderLevel( \Phalcon\Mvc\View::LEVEL_ACTION_VIEW );
      $this->view->site_name = $settings->getSiteName();
      $this->view->site_link = $this->helper->base_url();
      $this->view->rss_link = $this->helper->base_url().$_SERVER['REQUEST_URI'];
      $this->view->newsfeed = $this->newsfeed;
      $this->view->start();
      $this->view->setLayoutsDir('../views/');
      $this->view->render('rss', 'index');
      $this->view->finish();
      return $this->view->getContent();
    }

} 