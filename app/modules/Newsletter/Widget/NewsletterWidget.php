<?php

namespace Newsletter\Widget;

use Application\Widget\AbstractWidget;
use Newsletter\Form\NewsletterForm;
use Newsletter\Model\Newsletter;

class NewsletterWidget extends AbstractWidget
{

    public function newsletter()
    {
        $form = new NewsletterForm();        

        $this->widgetPartial('widget/newsletter', ['form' => $form]);
    }    

} 