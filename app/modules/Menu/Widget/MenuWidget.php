<?php

namespace Menu\Widget;

use Application\Widget\AbstractWidget;
use Menu\Helper\Helper;
use Menu\Model\Menus;

class MenuWidget extends AbstractWidget
{

    public function mainMenu()
    {
        $entries = Menus::$roots;
        $this->widgetPartial('widget/main-menu', ['entries' => $entries]);
    }

} 