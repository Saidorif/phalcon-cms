<?php

namespace Menu\Model\Translate;

use Application\Mvc\Model\Translate;

class MenusTranslate extends Translate
{
    public function initialize()
    {
        $this->setSource('menu_translate');
    }

}