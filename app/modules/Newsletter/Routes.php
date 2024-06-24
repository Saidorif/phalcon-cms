<?php

namespace Newsletter;

use Application\Mvc\Router\DefaultRouter;

class Routes
{

    public function init(DefaultRouter $router)
    {
        $router->addML('/newsletter/subscribe', array(
            'module' => 'newsletter',
            'controller' => 'index',
            'action' => 'subscribe',
        ), 'newsletter');

        $router->addML('/newsletter/settings/{id}', array(
            'module' => 'newsletter',
            'controller' => 'admin',
            'action' => 'settings',
        ), 'newsletter');

        $router->addML('/newsletter/news', array(
            'module' => 'newsletter',
            'controller' => 'admin',
            'action' => 'news',
        ), 'newsletter');         

        return $router;

    }

}