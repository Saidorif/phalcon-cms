<?php

namespace Seo;


class Routes
{

    public function init($router)
    {

        $router->addML('/sitemap.xml', array(
            'module' => 'seo',
            'controller' => 'index',
            'action' => 'index'
        ), 'seo');

        $router->addML('/seo/robots', array(
            'module' => 'seo',
            'controller' => 'robots',
            'action' => 'index'
        ), 'seo');

        $router->addML('/rss', array(
            'module' => 'seo',
            'controller' => 'rss',
            'action' => 'index'
        ), 'seo');

        return $router;
    }

}