<?php

namespace Slider\Form;

use Application\Form\Element\Image;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Check;
use \Phalcon\Forms\Element\File;
use Application\Form\Form;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;

class SliderForm extends Form
{

    public function initialize()
    {
        $title = new Text("title", ['required' => true]);
        $title->setLabel('Заголовок');

        $text = new TextArea("text");
        $text->setLabel('Текст для слайдера');

        $view_title = new Check('view_title');
        $view_title->setLabel('Показать заголовок');

        $banner = new Image('banner', ['required' => true]);
        $banner->setLabel('Изображение');

        $this->add($title);
        $this->add($text);
        $this->add($banner);
        $this->add($view_title);  

    }

}