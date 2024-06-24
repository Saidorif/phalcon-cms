<?php

namespace Knowledge\Widget;

use Application\Widget\AbstractWidget;
use Knowledge\Model\Helper\KnowledgeHelper;

class KnowledgeWidget extends AbstractWidget
{

    public function knowledgeBlock($limit = 5)
    {
        $helper = new KnowledgeHelper();
        $fields = $helper->translateFieldsSubQuery();

        $columns = ['p.*'];
        $columns = array_merge($columns, $fields);

        $qb = $this->modelsManager->createBuilder()
            ->columns($columns)
            ->addFrom('Knowledge\Model\Knowledge', 'p')
            ->orderBy('p.id DESC')
            ->limit($limit);

        $entries = $qb->getQuery()->execute();

        $this->widgetPartial('widget/knowledge-block', ['entries' => $entries]);
    }

} 