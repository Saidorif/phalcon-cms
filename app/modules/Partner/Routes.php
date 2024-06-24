<?php

namespace Partner;


class Routes
{

    public function init($router)
    {
        
        $router->addML('/partner', array(
            'module' => 'partner',
            'controller' => 'index',
            'action' => 'index'
        ), 'partner');              


        return $router;

    }

}