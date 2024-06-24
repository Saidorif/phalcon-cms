<?php

namespace Knowledge;

use Application\Mvc\Router\DefaultRouter;

class Routes
{

    public function init(DefaultRouter $router)
    {
        $router->addML('/knowledges', array(
            'module' => 'knowledge',
            'controller' => 'index',
            'action' => 'index',
        ), 'knowledge');

        $router->addML('/knowledges/{slug:[a-zA-Z0-9_-]+}', array(
            'module' => 'knowledge',
            'controller' => 'index',
            'action' => 'parents',
        ), 'parents');

        $router->addML('/knowledges/{parent:[a-zA-Z0-9_-]+}/{slug:[a-zA-Z0-9_-]+}', array(
            'module' => 'knowledge',
            'controller' => 'index',
            'action' => 'view',
        ), 'kview');

        $router->addML('/knowledges/{parent:[a-zA-Z0-9_-]+}/{slug:[a-zA-Z0-9_-]+}/{link:[a-zA-Z0-9_-]+}', array(
            'module' => 'knowledge',
            'controller' => 'index',
            'action' => 'show',
        ), 'kshow');

        return $router;

    }

}