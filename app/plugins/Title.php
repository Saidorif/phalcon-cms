<?php

namespace Eskiz\Plugin;

use Phalcon\Di\Injectable;

class Title extends Injectable
{

    public function __construct($di)
    {
        $helper = $di->get('helper');
        if (!$helper->meta()->get('seo-manager')) {
            $helper->title($helper->translate('SITE NAME'));
        }
    }

} 