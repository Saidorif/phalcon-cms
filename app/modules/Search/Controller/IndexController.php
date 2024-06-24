<?php

namespace Search\Controller;

use Application\Mvc\Controller;
use Page\Model\Translate\PageTranslate;
use Publication\Model\Translate\PublicationTranslate;
use Page\Model\Page;
use Publication\Model\Publication;
use Products\Model\Translate\ProductsTranslate;
use Products\Model\Products;
use \Phalcon\Http\Request;

class IndexController extends Controller
{

    public function indexAction()
    {
    	$request = new Request();
    	$search = $request->getQuery('search');
    	$lang = LANG;

    	$pageTrans = PageTranslate::query()
	    ->where("key = 'title' OR key = 'text'")
	    ->andWhere('value LIKE :term: AND lang = :lang:', array('term' => '%'.$search.'%', "lang" => $lang))
	    ->order("foreign_id")
      ->groupBy('foreign_id')
	    ->execute();

	    $publicationTrans = PublicationTranslate::query()
      ->where("key = 'title' OR key = 'text'")
      ->andWhere('value LIKE :term: AND lang = :lang:', array('term' => '%'.$search.'%', "lang" => $lang))
      ->order("foreign_id")
	    ->groupBy('foreign_id')
	    ->execute();

      $productsTrans = ProductsTranslate::query()
        ->where("key = 'title' OR key = 'text'")
        ->andWhere('value LIKE :term: AND lang = :lang:', array('term' => '%'.$search.'%', "lang" => $lang))
        ->order("foreign_id")
        ->groupBy('foreign_id')
        ->execute();

	    $searchPageResult = array();	    
	    foreach ($pageTrans as $value) {	
	    	$pageData = array();    	
    	 	$pages = Page::find($value->foreign_id);
    	 	foreach ($pages as $page) {
    	 		$title = str_ireplace($search, '<b>'.$search.'</b>', $page->title);
          $text = str_ireplace($search, '<b>'.$search.'</b>', $page->text);
          $text = substr($text, 0, 500).' ...';
    	 		$pageData['title'] = $title;
    	 		$pageData['text'] = $text;
    	 		$pageData['slug'] = $page->slug;
    	 	}    	 	
    	 	$searchPageResult[] = $pageData;    	 	  	 	
	    }		    

	    $searchPublicationResult = array();	    
	    foreach ($publicationTrans as $value) {	
	    	$publicationData = array();    	
    	 	$publications = Publication::find($value->foreign_id);        
    	 	foreach ($publications as $publication) {
          $title = str_ireplace($search, '<b>'.$search.'</b>', $publication->title);
          $text = str_ireplace($search, '<b>'.$search.'</b>', $publication->text);
          $text = substr($text, 0, 500).' ...';
    	 		$publicationData['title'] = $title;
    	 		$publicationData['text'] = $text;
    	 		$publicationData['slug'] = $publication->slug;
    	 		$publicationData['type'] = $publication->getTypeSlug();
    	 		$publicationData['date'] = date('d.m.Y', strtotime($publication->getDate()));
    	 	}
    	 	$searchPublicationResult[] = $publicationData;    	 	  	 	
	    } 

      $searchProductsResult = array();     
      foreach ($productsTrans as $value) { 
        $productData = array();     
        $products = Products::find($value->foreign_id);
        foreach ($products as $product) {
          $title = str_ireplace($search, '<b>'.$search.'</b>', $product->title);
          $text = str_ireplace($search, '<b>'.$search.'</b>', $product->text);
          $text = substr($text, 0, 500).' ...';
          $productData['title'] = $title;
          $productData['text'] = $text;
          $productData['slug'] = $product->getSlug();
          $productData['category'] = $product->getCategorySlug();
          $productData['anons'] = $product->getAnons();
        }
        $searchProductsResult[] = $productData;                  
      } 	
     
	    $count = array('pageCount' => count($pageTrans), 'publicationCount' => count($publicationTrans), 'productCount' => count($productsTrans));
      $searchResult = array('pageRes' => $searchPageResult, 'publRes' => $searchPublicationResult, 'prodRes' => $searchProductsResult);

		  $this->view->resultCount = $count;		
      $this->view->searchResult = $searchResult;
		  $this->view->searchQuery = $search;
    }    

}