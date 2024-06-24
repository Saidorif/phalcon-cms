<?php

namespace Faq\Controller;

use Application\Mvc\Controller;
use Faq\Model\Faq;

class IndexController extends Controller
{

    public function indexAction()
    {
        $this->view->entries = Faq::find();
        $this->helper->title($this->helper->translate('Faq'), true);
        $this->helper->meta()->set('description', $this->helper->at('Faq'));
    }    

}
