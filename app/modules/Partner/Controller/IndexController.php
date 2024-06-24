<?php

namespace Partner\Controller;

use Application\Mvc\Controller;
use Partner\Model\Partner;

class IndexController extends Controller
{

    public function indexAction()
    {
        $this->view->entries = Partner::find();
        $this->helper->title($this->helper->translate('Partner'), true);
        $this->helper->meta()->set('description', $this->helper->at('Partner'));
    }    

}
