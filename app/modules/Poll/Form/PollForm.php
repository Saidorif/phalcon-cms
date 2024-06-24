<?php

namespace Poll\Form;

use Phalcon\Forms\Element\Text;
use Application\Form\Form;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Forms\Element\Check;

class PollForm extends Form
{

    public function initialize()
    {
        $title = new Text("title", ['required' => true]);
        $title->setLabel('Вопрос');
        $this->add($title);

        $status = new Check('status');
        $status->setLabel('Отключить опрос');
        $this->add($status);
    }

}