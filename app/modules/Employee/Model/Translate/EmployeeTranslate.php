<?php

namespace Employee\Model\Translate;

use Application\Mvc\Model\Translate;

class EmployeeTranslate extends Translate
{
    public function initialize()
    {
        $this->setSource('employee_translate');
    }

}