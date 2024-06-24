<?php

namespace Employee\Form;

use Application\Form\Element\Image;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use \Phalcon\Forms\Element\File;
use Application\Form\Form;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;

class EmployeeForm extends Form
{

    public function initialize()
    {
        $title = new Text("title", ['required' => true]);
        $title->setLabel('ФИО');

        $job = new Text("job", ['required' => true]);
        $job->setLabel('Должность');

        $phone = new Text("phone");
        $phone->setLabel('Телефон');

        $email = new Text("email");
        $email->setLabel('Email');

        $text = new TextArea("text");
        $text->setLabel('Доп. инфо');        

        $foto = new Image('foto', ['required' => true]);
        $foto->setLabel('Изображение');

        $this->add($title);
        $this->add($job);
        $this->add($phone);
        $this->add($email);
        $this->add($text);
        $this->add($foto);
    }

}