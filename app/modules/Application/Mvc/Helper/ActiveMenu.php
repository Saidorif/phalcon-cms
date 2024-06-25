<?php

/**
 * ActiveMenu
 */

namespace Application\Mvc\Helper;

class ActiveMenu extends \Phalcon\Di\Injectable
{

    private static $instance;
    private $active = null;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new ActiveMenu();
        }
        return self::$instance;
    }

    public function setActive($value)
    {
        $this->active = $value;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function isActive($value)
    {
        if ($this->active == $value) {
            return true;
        }
    }

    public function activeClass($value)
    {
        if ($this->isActive($value)) {
            return ' active';
        }
    }

}
