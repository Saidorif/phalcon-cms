<?php

namespace Publication\Controller;

use Application\Mvc\Controller;
use Publication\Model\Helper\PublicationHelper;
use Publication\Model\Publication;
use Phalcon\Exception;
use Publication\Model\Type;
use Cms\Model\Settings;

class IndexController extends Controller
{

    public function indexAction()
    {
        $type      = $this->dispatcher->getParam('type', 'string');
        $typeModel = Type::getCachedBySlug($type);
        if (!$typeModel) {
            throw new Exception("Publication hasn't type = '$type''");
        }

        $typeLimit = ($typeModel->getLimit()) ? $typeModel->getLimit() : 10;
        $limit     = $this->request->getQuery('limit', 'string', $typeLimit);
        if ($limit != 'all') {
            $paginatorLimit = (int)$limit;
        } else {
            $paginatorLimit = 9999;
        }
        $page = $this->request->getQuery('page', 'int', 1);

        /*$publications = Publication::find(array(
            "type_id = {$typeModel->getId()}",
            "order" => "date DESC",
        ));*/

        $publicationHelper = new PublicationHelper();
        $fields = $publicationHelper->translateFieldsSubQuery();

        $columns = ['p.*', 't_slug' => 't.slug'];
        $columns = array_merge($columns, $fields);

        $qb = $this->modelsManager->createBuilder()
            ->columns($columns)
            ->addFrom('Publication\Model\Publication', 'p')
            ->leftJoin('Publication\Model\Type', null, 't')
            ->andWhere('t.slug = :type:', ['type' => $type])
            ->andWhere('p.date <= NOW()')
            ->orderBy('p.date DESC');

        $paginator = new \Phalcon\Paginator\Adapter\QueryBuilder([
            "builder"  => $qb,
            "limit" => $paginatorLimit,
            "page"  => $page
        ]);

        $this->view->paginate = $paginator->getPaginate();

        $settings = Settings::findFirst(1);
        $curLang = $this->helper->currentUrl(LANG);
        $meta_url = $this->helper->base_url().$curLang.$type;
        $meta_image = $this->helper->base_url().'/'.$settings->getLogo();
        
        if(!$typeModel->getMetaTitle()){
            $this->helper->title()->append($typeModel->getTitle());
            $this->helper->meta()->set('title', $typeModel->getTitle());
        }
        if($typeModel->getMetaTitle()){
            $this->helper->title()->append($typeModel->getMetaTitle());
            $this->helper->meta()->set('title', $typeModel->getMetaTitle());
        }

        $this->helper->meta()->set('description', $typeModel->getMetaDescription());
        $this->helper->meta()->set('type', 'article');
        $this->helper->meta()->set('site_name', $settings->getSiteName());
        $this->helper->meta()->set('url', $meta_url);
        $this->helper->meta()->set('image', $meta_image);

        if($typeModel->getIndexPage() == 1)        
            $this->helper->meta()->set('robots', 'noindex, nofollow');
       
        if ($page > 1) {
            $this->helper->title()->append($this->helper->translate('Страница №') . ' ' . $page);
        }
        $this->view->title  = $typeModel->getTitle();
        $this->view->format = $typeModel->getFormat();
        $this->view->type   = $type;

        $this->helper->menu->setActive($type);
    }

    public function servicesAction()
    {
        $type = 'services';        
        $typeModel = Type::getCachedBySlug($type);
        if (!$typeModel) {
            throw new Exception("Publication hasn't type = '$type'");
        }

        $typeLimit = ($typeModel->getLimit()) ? $typeModel->getLimit() : 10;
        $limit     = $this->request->getQuery('limit', 'string', $typeLimit);
        if ($limit != 'all') {
            $paginatorLimit = (int)$limit;
        } else {
            $paginatorLimit = 9999;
        }
        $page = $this->request->getQuery('page', 'int', 1);        

        $publicationHelper = new PublicationHelper();
        $fields = $publicationHelper->translateFieldsSubQuery();

        $columns = ['p.*', 't_slug' => 't.slug'];
        $columns = array_merge($columns, $fields);

        $qb = $this->modelsManager->createBuilder()
            ->columns($columns)
            ->addFrom('Publication\Model\Publication', 'p')
            ->leftJoin('Publication\Model\Type', null, 't')
            ->andWhere('t.slug = :type:', ['type' => 'services'])
            ->andWhere('p.date <= NOW()')
            ->orderBy('p.date DESC');

        $paginator = new \Phalcon\Paginator\Adapter\QueryBuilder([
            "builder"  => $qb,
            "limit" => $paginatorLimit,
            "page"  => $page
        ]);

        $this->view->paginate = $paginator->getPaginate();

        $settings = Settings::findFirst(1);
        $curLang = $this->helper->currentUrl(LANG);
        $meta_url = $this->helper->base_url().$curLang.$type;
        $meta_image = $this->helper->base_url().'/'.$settings->getLogo();
        
        if(!$typeModel->getMetaTitle()){
            $this->helper->title()->append($typeModel->getTitle());
            $this->helper->meta()->set('title', $typeModel->getTitle());
        }
        if($typeModel->getMetaTitle()){
            $this->helper->title()->append($typeModel->getMetaTitle());
            $this->helper->meta()->set('title', $typeModel->getMetaTitle());
        }

        $this->helper->meta()->set('description', $typeModel->getMetaDescription());
        $this->helper->meta()->set('type', 'article');
        $this->helper->meta()->set('site_name', $settings->getSiteName());
        $this->helper->meta()->set('url', $meta_url);
        $this->helper->meta()->set('image', $meta_image);

        if($typeModel->getIndexPage() == 1)        
            $this->helper->meta()->set('robots', 'noindex, nofollow');

        if ($page > 1) {
            $this->helper->title()->append($this->helper->translate('Страница №') . ' ' . $page);
        }
        $this->view->title  = $typeModel->getTitle();
        $this->view->format = $typeModel->getFormat();
        $this->view->type   = $type;

        $this->helper->menu->setActive($type);
    }

    public function publicationAction()
    {
        $slug = $this->dispatcher->getParam('slug', 'string');
        $type = $this->dispatcher->getParam('type', 'string');

        $publicationHelper = new PublicationHelper();
        $publicationResult = $publicationHelper->publicationBySlug($slug);
        if (!$publicationResult) {
            throw new Exception("Publication '$slug.html' not found");
        }
        if ($publicationResult->p->getTypeSlug() != $type) {
            throw new Exception("Publication type <> $type");
        }

        $settings = Settings::findFirst(1);
        $curLang = $this->helper->currentUrl(LANG);
        $meta_url = $this->helper->base_url().$curLang.$type.'/'.$slug;
        $meta_image = $this->helper->base_url().'/'.$publicationResult->p->preview_src;

        if(!$publicationResult->meta_title){
            $this->helper->title()->append($publicationResult->title);
            $this->helper->meta()->set('title', $publicationResult->title);
        }
        if($publicationResult->meta_title){
            $this->helper->title()->append($publicationResult->meta_title);
            $this->helper->meta()->set('title', $publicationResult->meta_title);
        }

        $this->helper->meta()->set('description', $publicationResult->meta_description);
        $this->helper->meta()->set('type', 'article');
        $this->helper->meta()->set('site_name', $settings->getSiteName());
        $this->helper->meta()->set('url', $meta_url);
        $this->helper->meta()->set('image', $meta_image);

        if($publicationResult->p->index_page == 1)        
            $this->helper->meta()->set('robots', 'noindex, nofollow');        

        $this->helper->menu->setActive($type);

        $this->view->publicationResult = $publicationResult;
    }

}
