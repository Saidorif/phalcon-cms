<?php

namespace Payment\Controller;

use Application\Mvc\Controller;
use Payment\Model\Payment;
use Payment\Model\Order;
use Payment\Form\PaymentForm;
use Payment\Form\MembershipForm;
use Menu\Model\Menus;

class AdminController extends Controller
{

    public function initialize()
    {
        $this->setAdminEnvironment();
        $this->helper->activeMenu()->setActive('admin-payment');
        $this->view->languages_disabled = true;
    }

    public function indexAction()
    {
        $this->view->orders = Order::find();

        $this->helper->title($this->helper->at('Members '), true);
    }

    public function orderAction($id)
    {
        $this->view->order = Order::findFirst($id);
    }


} 