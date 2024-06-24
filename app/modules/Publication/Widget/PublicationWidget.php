<?php

namespace Publication\Widget;

use Application\Widget\AbstractWidget;
use Publication\Model\Helper\PublicationHelper;

class PublicationWidget extends AbstractWidget
{

    public function lastNews($limit = 6)
    {
        $publicationHelper = new PublicationHelper();
        $fields = $publicationHelper->translateFieldsSubQuery();

        $columns = ['p.*', 't_slug' => 't.slug'];
        $columns = array_merge($columns, $fields);

        $qb = $this->modelsManager->createBuilder()
            ->columns($columns)
            ->addFrom('Publication\Model\Publication', 'p')
            ->leftJoin('Publication\Model\Type', null, 't')
            ->andWhere('t.slug = :type:', ['type' => 'news'])
            ->andWhere('p.date <= NOW()')
            ->orderBy('p.date DESC')
            ->limit($limit);

        $entries = $qb->getQuery()->execute();

        $this->widgetPartial('widget/last-news', ['entries' => $entries]);
    }

    public function advantages($limit = 6)
    {
        $publicationHelper = new PublicationHelper();
        $fields = $publicationHelper->translateFieldsSubQuery();

        $columns = ['p.*', 't_slug' => 't.slug'];
        $columns = array_merge($columns, $fields);

        $qb = $this->modelsManager->createBuilder()
            ->columns($columns)
            ->addFrom('Publication\Model\Publication', 'p')
            ->leftJoin('Publication\Model\Type', null, 't')
            ->andWhere('t.slug = :type:', ['type' => 'advantages'])
            ->andWhere('p.date <= NOW()')
            ->orderBy('p.date DESC')
            ->limit($limit);

        $entries = $qb->getQuery()->execute();

        $this->widgetPartial('widget/advantages', ['entries' => $entries]);
    }

} 