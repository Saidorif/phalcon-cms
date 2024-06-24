<?php

namespace Slider\Widget;

use Application\Widget\AbstractWidget;
use Slider\Model\Slider;

class SliderWidget extends AbstractWidget
{

    public function sliderBlock($limit = 5)
    {
        $entries = Slider::query()        
        ->orderBy('id DESC')
        ->limit($limit)
        ->execute();

        $this->widgetPartial('widget/slider-block', ['entries' => $entries]);
    }

} 