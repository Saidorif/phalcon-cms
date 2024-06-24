<?php

namespace Search;

class Routes
{

    public function init($router)
    {
        $router->addML('/search', array(
            'module' => 'search',
            'controller' => 'index',
            'action' => 'index',
        ), 'search');

        return $router;

    }

}