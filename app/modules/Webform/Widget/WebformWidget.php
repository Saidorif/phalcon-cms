<?php

namespace Webform\Widget;

use Application\Widget\AbstractWidget;
use Webform\Form\FeedbackForm;
use Webform\Form\TravelbackForm;
use Webform\Model\Webform;

class WebformWidget extends AbstractWidget
{

    public function feedback()
    {
        $form = new FeedbackForm();        

        $this->widgetPartial('feedback', ['form' => $form]);
    }

} 