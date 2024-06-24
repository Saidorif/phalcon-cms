<?php

namespace Admin;

class Routes
{

    public function init($router)
    {
        $router->add('/admin', array(
            'module'     => 'admin',
            'controller' => 'index',
            'action'     => 'index',
        ))->setName('admin');

        return $router;
    }

}