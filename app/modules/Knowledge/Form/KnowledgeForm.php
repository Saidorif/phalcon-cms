<?php

namespace Knowledge\Form;

use Application\Form\Element\Image;
use Knowledge\Model\Knowledge;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Select;
use \Phalcon\Forms\Element\File;
use Application\Form\Form;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;

class KnowledgeForm extends Form
{

    public function initialize()
    {
        $title = new Text("title", ['required' => true]);
        $title->setLabel('Заголовок');

        $slug = new Text("slug", ['required' => true]);
        $slug->setLabel('Ссылка');

        $parent_id = new Select("parent_id", [
            1 => 'Нет',
            0 => 'Да',
        ]);
        $parent_id->setLabel('Показать на главном');

        $text = new TextArea("text");
        $text->setLabel('Текст');

        $image = new Image('image', ['required' => false]);
        $image->setLabel('Изображение');

        $this->add($title);
        $this->add($slug);
        $this->add($parent_id);
        $this->add($text);
        $this->add($image);
    }

}