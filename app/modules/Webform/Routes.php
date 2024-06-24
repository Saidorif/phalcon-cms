<?php

namespace Webform;

use Application\Mvc\Router\DefaultRouter;

class Routes
{

    public function init(DefaultRouter $router)
    {
        $router->addML('/webform/feedback', array(
            'module' => 'webform',
            'controller' => 'index',
            'action' => 'feedback',
        ), 'feedback');

        $router->addML('/webform/booking', array(
            'module' => 'webform',
            'controller' => 'index',
            'action' => 'booking',
        ), 'booking');

        return $router;

    }

}