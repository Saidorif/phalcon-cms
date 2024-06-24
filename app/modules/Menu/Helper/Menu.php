<?php

namespace Menu\Helper;

use Menu\Item;

class Menu
{

    private static $instance;
    private $active_items = [];

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Menu();
        }
        return self::$instance;
    }

    public function __construct()
    {

    }   

    public function setActive($id)
    {
        if (!in_array($id, $this->active_items)) {
            $this->active_items[] = $id;
        }
    }

}