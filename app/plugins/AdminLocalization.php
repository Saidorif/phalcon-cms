<?php

/**
 * Admin localization
 */

namespace Eskiz\Plugin;

use Phalcon\Di\Injectable;

class AdminLocalization extends Injectable
{

    public function __construct($config)
    {
        $file = APPLICATION_PATH . '/../data/translations/admin/' . $config->admin_language . '.php';
        if (!is_file($file)) {
            die("file $file not exists");
        }
        $interpolatorFactory = new \Phalcon\Translate\InterpolatorFactory();
        $translations = include($file);
        $this->getDI()->set('admin_translate', new \Phalcon\Translate\Adapter\NativeArray($interpolatorFactory, ['content' => $translations]));

    }

}
