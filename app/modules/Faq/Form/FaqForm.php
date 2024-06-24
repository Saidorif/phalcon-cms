<?php

namespace Faq\Form;

use Application\Form\Element\Image;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use \Phalcon\Forms\Element\File;
use Application\Form\Form;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;

class FaqForm extends Form
{

    public function initialize()
    {
        $title = new Text("title", ['required' => true]);
        $title->setLabel('вопрос');

       

        $text = new TextArea("text");
        $text->setLabel('ответ');        


        $this->add($title);
        $this->add($text);
    }

}