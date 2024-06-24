<?php

namespace Newsletter\Form;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Email;
use Application\Form\Form;
use Phalcon\Validation\Validator\PresenceOf;

class NewsletterForm extends Form
{

    public function initialize()
    {
        $email = new Email("email", ['required' => true, 'class' => 'form-control',  'placeholder' => 'Эл. адрес']);
        $this->add($email);
    }
}

                                           