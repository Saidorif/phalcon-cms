<?php

namespace Payment;

use Application\Mvc\Router\DefaultRouter;

class Routes
{

    public function init(DefaultRouter $router)
    {
        $router->addML('/payment', array(
            'module' => 'payment',
            'controller' => 'index',
            'action' => 'index',
        ), 'payment');

        $router->addML('/payment/subscribe', array(
            'module' => 'payment',
            'controller' => 'index',
            'action' => 'subscribe'
        ), 'subscribe');

        $router->addML('/payment/magorder', array(
            'module' => 'payment',
            'controller' => 'index',
            'action' => 'magorder'
        ), 'magorder');

        //Payme.uz callback route
        $router->addML('/payment/payme', array(
            'module' => 'payment',
            'controller' => 'index',
            'action' => 'paycom',
        ), 'paycom');

        $router->addML('/payment/admin', array(
            'module' => 'payment',
            'controller' => 'admin',
            'action' => 'index',
        ), 'admin');

        return $router;

    }

}