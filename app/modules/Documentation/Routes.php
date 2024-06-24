<?php

namespace Documentation;

use Application\Mvc\Router\DefaultRouter;

class Routes
{

    public function init(DefaultRouter $router)
    {
        $router->addML('/siyosatchi-kutubxonasi', array(
            'module' => 'documentation',
            'controller' => 'index',
            'action' => 'index',
        ), 'library');
        
        // $router->addML('/ukazyi', array(
        //     'module' => 'documentation',
        //     'controller' => 'index',
        //     'action' => 'ukazyi',
        // ), 'ukazyi');
        
        return $router;

    }

}
