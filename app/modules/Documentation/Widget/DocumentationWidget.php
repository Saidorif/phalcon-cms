<?php

namespace Documentation\Widget;

use Application\Widget\AbstractWidget;
use Documentation\Model\Helper\DocumentationHelper;
use \Documentation\Model\Documentation;

class DocumentationWidget extends AbstractWidget
{

    public function documentationBlock($limit = 5)
    {
        $helper = new DocumentationHelper();
        $fields = $helper->translateFieldsSubQuery();

        $columns = ['p.*'];
        $columns = array_merge($columns, $fields);

        $qb = $this->modelsManager->createBuilder()
            ->columns($columns)
            ->addFrom('Documentation\Model\Documentation', 'p')
            ->orderBy('p.id DESC')
            ->limit($limit);

        $entries = $qb->getQuery()->execute();

        $this->widgetPartial('widget/documentation-block', ['entries' => $entries]);
    }

    public function normativ($limit = 4)
    {
        $helper = new DocumentationHelper();
        $fields = $helper->translateFieldsSubQuery();

        $columns = ['p.*'];
        $columns = array_merge($columns, $fields);

        $qb = $this->modelsManager->createBuilder()
            ->columns($columns)
            ->addFrom('Documentation\Model\Documentation', 'p')
            ->orderBy('p.id DESC')
            ->limit($limit);

        $entries = $qb->getQuery()->execute();

        $this->widgetPartial('widget/normativ', ['entries' => $entries]);
    }

    public function normativLoyiha($limit = 4)
    {
        $helper = new DocumentationHelper();
        $fields = $helper->translateFieldsSubQuery();

        $columns = ['p.*'];
        $columns = array_merge($columns, $fields);

        $qb = $this->modelsManager->createBuilder()
            ->columns($columns)
            ->addFrom('Documentation\Model\Documentation', 'p')
            ->orderBy('p.id DESC')
            ->limit($limit);

        $entries = $qb->getQuery()->execute();

        $this->widgetPartial('widget/normativ-loyiha', ['entries' => $entries]);
    }

    public function openDocs($limit = 4)
    {
        $helper = new DocumentationHelper();
        $fields = $helper->translateFieldsSubQuery();

        $columns = ['p.*'];
        $columns = array_merge($columns, $fields);

        $qb = $this->modelsManager->createBuilder()
            ->columns($columns)
            ->addFrom('Documentation\Model\Documentation', 'p')
            ->orderBy('p.id DESC')
            ->limit($limit);

        $entries = $qb->getQuery()->execute();

        $this->widgetPartial('widget/open-docs', ['entries' => $entries]);
    }

    public function downloads()
    {
        $entries = Documentation::find('type = "forms"');
        $this->widgetPartial('widget/downloads', ['entries' => $entries]);
    }

} 