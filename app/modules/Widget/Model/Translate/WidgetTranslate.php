<?php

namespace Widget\Model\Translate;

use Application\Mvc\Model\Translate;

class WidgetTranslate extends Translate
{
    public function initialize()
    {
        $this->setSource('widget_translate');
    }
}