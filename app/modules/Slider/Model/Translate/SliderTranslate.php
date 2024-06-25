<?php

namespace Slider\Model\Translate;

use Application\Mvc\Model\Translate;

class SliderTranslate extends Translate
{
    public function initialize()
    {
        $this->setSource('slider_translate');
    }
}