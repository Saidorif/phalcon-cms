<?php

namespace Portfolio;

use Portfolio\Model\Portfolio;
use Portfolio\Model\Category;

class Routes
{

    public function init($router)
    {
        
        $router->addML('/portfolio', array(
            'module' => 'portfolio',
            'controller' => 'index',
            'action' => 'index'
        ), 'portfolios');              

        $router->addML('/portfolio/{slug:[a-zA-Z0-9_-]+}', array(
            'module' => 'portfolio',
            'controller' => 'index',
            'action' => 'view'
        ), 'portfolio');

        $router->addML('/portfolio/admin', array(
            'module' => 'portfolio',
            'controller' => 'admin',
            'action' => 'index'
        ), 'admin');

        $router->addML('/portfolio/category', array(
            'module' => 'portfolio',
            'controller' => 'category',
            'action' => 'index'
        ), 'category');

        return $router;

    }

}