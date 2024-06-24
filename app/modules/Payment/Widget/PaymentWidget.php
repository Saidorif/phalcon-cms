<?php

namespace Payment\Widget;

use Application\Widget\AbstractWidget;
use Payment\Form\MembershipForm;
use Payment\Model\Membership;

class PaymentWidget extends AbstractWidget
{

    public function membership()
    {
        $form = new MembershipForm();        

        $this->widgetPartial('index/membership', ['form' => $form]);
    }

} 