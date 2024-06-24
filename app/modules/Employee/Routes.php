<?php

namespace Employee;

use Application\Mvc\Router\DefaultRouter;

class Routes
{

    public function init(DefaultRouter $router)
    {
        $router->addML('/employee', array(
            'module' => 'employee',
            'controller' => 'index',
            'action' => 'index',
        ), 'employee');

        return $router;

    }

}