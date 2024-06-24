<?php

namespace Portfolio\Widget;

use Application\Widget\AbstractWidget;
use Portfolio\Model\Portfolio;
use Portfolio\Model\Category;


class PortfolioWidget extends AbstractWidget
{

    public function portfolio()
    {
    	$parameters['order'] = "sort ASC";
        $portfolio = Portfolio::find();
        $category = Category::find($parameters);
        $this->widgetPartial('index/block', ['portfolio' => $portfolio, 'category' => $category]);
    }    

} 