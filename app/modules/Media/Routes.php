<?php

namespace Media;

use Media\Model\Media;
use Media\Model\Category;

class Routes
{

    public function init($router)
    {
        
        $router->addML('/media', array(
            'module' => 'media',
            'controller' => 'index',
            'action' => 'index'
        ), 'media-index');              

        $router->addML('/media/{slug:[a-zA-Z0-9_-]+}', array(
            'module' => 'media',
            'controller' => 'index',
            'action' => 'view'
        ), 'media');

        $router->addML('/media/admin', array(
            'module' => 'media',
            'controller' => 'admin',
            'action' => 'index'
        ), 'admin');

        $router->addML('/media/category', array(
            'module' => 'media',
            'controller' => 'category',
            'action' => 'index'
        ), 'category');

        return $router;

    }

}