<?php

namespace Seo\Form;

use Application\Form\Form;
use Phalcon\Forms\Element\TextArea;

class RobotsForm extends Form
{

    public function initialize()
    {
        $this->add((new TextArea('robots', ['style' => 'height:600px;']))->setLabel('Contents'));
    }

} 