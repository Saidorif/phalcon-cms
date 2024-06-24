<?php

namespace Products;

use Products\Model\Products;
use Products\Model\Category;

class Routes
{

    public function init($router)
    {
        $category_keys = array_keys(Category::category());
        $category_regex = '(' . implode('|', $category_keys) . ')';

        $router->add('/products/admin/{category:' . $category_regex . '}', array(
            'module' => 'products',
            'controller' => 'admin',
            'action' => 'index'
        ))->setName('products_admin');

        $router->add('/products/admin/{category:' . $category_regex . '}/([a-zA-Z0-9_]+)', array(
            'module' => 'products',
            'controller' => 'admin',
            'action' => 2
        ))->setName('products_admin_action');        

        $router->addML('/products', array(
            'module' => 'products',
            'controller' => 'index',
            'action' => 'products'
        ), 'product-category');

        $router->addML('/products/{category:' . $category_regex . '}', array(
            'module' => 'products',
            'controller' => 'index',
            'action' => 'index'
        ), 'products');

        $router->addML('/products/{category:' . $category_regex . '}/{slug:[a-zA-Z0-9_-]+}', array(
            'module' => 'products',
            'controller' => 'index',
            'action' => 'view'
        ), 'product');

        return $router;

    }

}