<?php

namespace Partner\Form;

use Application\Form\Element\Image;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use \Phalcon\Forms\Element\File;
use Application\Form\Form;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;

class PartnerForm extends Form
{

    public function initialize()
    {

        $title = new Text("title", ['required' => true]);
        $title->setLabel('названия компаний');

        $slug = new Text('slug', ['required' => true]);
        $slug->setLabel('Сылка');
        $this->add($slug);
              

        $foto = new Image('foto', ['required' => true]);
        $foto->setLabel('Логотип');

        $this->add($title);
        $this->add($foto);
    }

}