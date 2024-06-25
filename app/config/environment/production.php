<?php

return [
    'base_path' => '/',    

    'database'  => [
        'adapter'  => 'Mysql',
        'host'     => 'db',
        'username' => 'root',
        'password' => 'very_secret',
        'dbname'   => 'phalcon-cms',
        'charset'  => 'utf8',
    ],

    'memcache'  => [
        'host' => 'localhost',
        'port' => 11211,
    ],

    'memcached'  => [
        'host' => 'localhost',
        'port' => 11211,
    ],

    'cache'     => 'file', // memcache, memcached
];