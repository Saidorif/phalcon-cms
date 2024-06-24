<?php

namespace Employee\Model\Translate;

use Application\Mvc\Model\Translate;

class EmployeeTranslate extends Translate
{

    public function getSource()
    {
        return "employee_translate";
    }

}