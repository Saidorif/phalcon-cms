<?php

namespace Menu;

use Phalcon\Mvc\User\Component;
use Menu\Helper\Helper;

class Init extends Component
{

    public function __construct()
    {
        $this->getDi()->set('menu_helper', new Helper());
    }

}