<?php

namespace Webform\Form;

use Phalcon\Forms\Element\Text;
use \Phalcon\Forms\Element\File;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\TextArea;
use Application\Form\Form;
use Phalcon\Validation\Validator\PresenceOf;

class FeedbackForm extends Form
{

    public function initialize()
    {
        $name = new Text("name", ['required' => true, 'class' => 'form-control', 'placeholder' => "Имя"]);
        $file = new File("files", ['required' => true, 'class' => 'form-control', 'accept' => 'image/*,application/pdf']);
        $phone = new Text("phone", ['required' => true, 'class' => 'form-control', 'placeholder' => "Телефон"]);
        $email = new Email("email", ['required' => true, 'class' => 'form-control',  'placeholder' => 'Эл. адрес']);
        $company = new Text("company", ['required' => true, 'class' => 'form-control',  'placeholder' => 'Компания']);     
        $message = new TextArea("message", ['required' => false , 'rows'=>"10", 'class' => 'form-control', 'placeholder' => 'Ваше сообщение']);      
       

        $this->add($name);
        $this->add($file);
        $this->add($phone);
        $this->add($email);
        $this->add($company);         
        $this->add($message);  

    }
}

                                           