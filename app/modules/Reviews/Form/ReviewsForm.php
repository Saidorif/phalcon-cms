<?php

namespace Reviews\Form;

use Application\Form\Element\Image;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use \Phalcon\Forms\Element\File;
use Application\Form\Form;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;

class ReviewsForm extends Form
{

    public function initialize()
    {
        $title = new Text("title", ['required' => true]);
        $title->setLabel('ФИО');

        $job = new Text("job", ['required' => true]);
        $job->setLabel('Должность');
        
        $text = new TextArea("text");
        $text->setLabel('Отзыв');        

        $foto = new Image('foto', ['required' => true]);
        $foto->setLabel('Изображение');

        $this->add($title);
        $this->add($job);        
        $this->add($text);
        $this->add($foto);
    }

}