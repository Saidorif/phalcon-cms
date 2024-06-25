<?php

namespace Menu;

use Phalcon\Di\Injectable;
use Menu\Helper\Helper;

class Init extends Injectable
{

    public function __construct()
    {
        $this->getDi()->set('menu_helper', new Helper());
    }

}