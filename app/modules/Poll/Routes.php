<?php

namespace Poll;

use Application\Mvc\Router\DefaultRouter;

class Routes
{

    public function init(DefaultRouter $router)
    {
    		$router->addML('/poll', array(
            'module' => 'poll',
            'controller' => 'index',
            'action' => 'poll',
        ), 'poll');

        $router->addML('/polls', array(
            'module' => 'poll',
            'controller' => 'index',
            'action' => 'index',
        ), 'poll');

        $router->addML('/poll/vote', array(
            'module' => 'poll',
            'controller' => 'index',
            'action' => 'vote'
        ), 'poll');        

        $router->addML('/poll/vote/{id}', array(
            'module' => 'poll',
            'controller' => 'index',
            'action' => 'result'
        ), 'poll');       

        return $router;

    }

}