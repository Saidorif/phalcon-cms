<?php

namespace Page;

use Application\Mvc\Router\DefaultRouter;

class Routes
{

    public function init(DefaultRouter $router)
    {
        $router->addML('/{slug:[a-zA-Z0-9_-]+}', array(
            'module' => 'page',
            'controller' => 'index',
            'action' => 'index'
        ), 'page');

        $router->addML('/contacts', array(
            'module' => 'page',
            'controller' => 'index',
            'action' => 'contacts',
        ), 'contacts');

        $router->addML('/admin', array(
            'module' => 'page',
            'controller' => 'index',
            'action' => 'admin',
        ), 'admin');

        return $router;

    }

}