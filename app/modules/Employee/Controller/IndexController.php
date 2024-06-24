<?php

namespace Employee\Controller;

use Application\Mvc\Controller;
use Employee\Model\Employee;

class IndexController extends Controller
{

    public function indexAction()
    {
        $this->view->entries = Employee::find();
        $this->helper->title($this->helper->translate('Employee'), true);
        $this->helper->meta()->set('description', $this->helper->at('Employee'));
    }    

}
