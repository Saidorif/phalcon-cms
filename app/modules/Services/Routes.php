<?php

namespace Services;


class Routes
{

    public function init($router)
    {

        $router->addML('/legal-entities', array(
            'module' => 'services',
            'controller' => 'index',//Class
            'action' => 'legal'
        ), 'legal');

        $router->addML('/individuals', array(
            'module' => 'services',
            'controller' => 'index',
            'action' => 'individuals'
        ), 'individuals');

        $router->addML('/structural-units', array(
            'module' => 'services',
            'controller' => 'index',
            'action' => 'structural'
        ), 'structural');        

        $router->addML('/services/admin', array(
            'module' => 'services',
            'controller' => 'admin',
            'action' => 'index'
        ), 'admin');

        $router->addML('/services/category', array(
            'module' => 'services',
            'controller' => 'category',
            'action' => 'index'
        ), 'category');

        return $router;

    }

}
