<?php

namespace Reviews\Widget;

use Application\Widget\AbstractWidget;
use Reviews\Model\Helper\ReviewsHelper;

class ReviewsWidget extends AbstractWidget
{

    public function reviews($limit = 5)
    {
        $helper = new ReviewsHelper();
        $fields = $helper->translateFieldsSubQuery();

        $columns = ['p.*'];
        $columns = array_merge($columns, $fields);

        $qb = $this->modelsManager->createBuilder()
            ->columns($columns)
            ->addFrom('Reviews\Model\Reviews', 'p')
            ->orderBy('p.id DESC')
            ->limit($limit);

        $entries = $qb->getQuery()->execute();

        $this->widgetPartial('widget/reviews', ['entries' => $entries]);
    }

} 