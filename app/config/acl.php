<?php

return [

    // frontend
    'guest'      => [
        'admin/index'       => '*',
        'index/index'       => '*',
        'index/error'       => '*',
        'page/index'        => '*',
        'webform/index'     => '*',
        'employee/index'    => '*',
        'publication/index' => '*',
        'products/index'    => '*',
        'tours/index'       => '*',
        'seo/index'         => '*',
        'seo/rss'           => '*',
        'portfolio/index'   => '*',
        'search/index'      => '*',
        'partner/index'     => '*',
        'faq/index'         => '*',
        'region/index'         => '*',
        'documentation/index'         => '*',
        'newslatter/index'         => '*',
        'poll/index'         => '*',
        'knowledge/index'         => '*',
    ],
    'member'     => [
        'index/index' => '*',
    ],
    // backend
    'journalist' => [
        'publication/admin'  => [
            'index',
            'add',
            'edit',
        ],
        'page/admin'         => [
            'index',
            'add',
            'edit',
        ],        
    ],
    'editor'     => [
        'publication/admin'  => '*',
        'publication/type'   => '*',        
        'cms/translate'      => '*',
        'widget/admin'       => '*',
        'file-manager/index' => '*',
        'page/admin'         => '*',
        'tree/admin'         => '*',
        'menu/admin'         => '*',
        'slider/admin'       => '*',
        'faq/admin'       => '*',
        'employee/admin'     => '*',
        'reviews/admin'      => '*',
        'documentation/admin'      => '*',
        'poll/admin'      => '*',
        'newslatter/admin'      => '*',
        'region/admin'      => '*',
        'portfolio/admin'    => '*',
        'portfolio/category' => '*',
        'products/admin'     => '*',
        'products/category'  => '*',
        'tours/admin'        => '*', 
        'tours/category'     => '*',
        'tours/country'      => '*',   
    ],
    'admin'      => [
        'admin/admin-user'   => '*',
        'cms/configuration'  => '*',
        'cms/settings'       => '*',        
        'cms/translate'      => '*',
        'cms/language'       => '*',
        'cms/javascript'     => '*',
        'widget/admin'       => '*',
        'file-manager/index' => '*',
        'page/admin'         => '*',
        'publication/admin'  => '*',
        'publication/type'   => '*',
        'seo/robots'         => '*',
        'menu/admin'         => '*',
        'slider/admin'       => '*',
        'employee/admin'     => '*',
        'reviews/admin'      => '*',
        'portfolio/admin'    => '*',
        'portfolio/category' => '*',
        'products/admin'     => '*',
        'products/category'  => '*', 
        'tours/admin'        => '*', 
        'tours/category'     => '*', 
        'tours/country'      => '*', 
        'partner/admin'      => '*',
        'faq/admin'          => '*',
        'poll/admin'          => '*',
        'newslatter/admin'          => '*',
        'documentation/admin'          => '*',
        'region/admin'          => '*',
        'knowledge/admin'          => '*',
    ],
];