<?php

namespace Search\Widget;

use Application\Widget\AbstractWidget;

class SearchWidget extends AbstractWidget
{

    public function search()
    {
    	$this->widgetPartial('index/block');
    }    

} 