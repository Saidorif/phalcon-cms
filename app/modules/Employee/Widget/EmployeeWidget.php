<?php

namespace Employee\Widget;

use Application\Widget\AbstractWidget;
use Employee\Model\Helper\EmployeeHelper;

class EmployeeWidget extends AbstractWidget
{

    public function employeeBlock($limit = 5)
    {
        $helper = new EmployeeHelper();
        $fields = $helper->translateFieldsSubQuery();

        $columns = ['p.*'];
        $columns = array_merge($columns, $fields);

        $qb = $this->modelsManager->createBuilder()
            ->columns($columns)
            ->addFrom('Employee\Model\Employee', 'p')
            ->orderBy('p.id DESC')
            ->limit($limit);

        $entries = $qb->getQuery()->execute();

        $this->widgetPartial('widget/employee-block', ['entries' => $entries]);
    }

} 