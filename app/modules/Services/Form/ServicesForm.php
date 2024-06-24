<?php

namespace Services\Form;

use Application\Form\Element\Image;
use Application\Form\Element\Images;
use Phalcon\Validation\Validator\PresenceOf;
use Application\Form\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Select;
use \Phalcon\Forms\Element\File;
use Services\Model\Category;

class ServicesForm extends Form
{

    public function initialize()
    {
        $category = new Select('category_id', Category::cachedListArray(['key' => 'id']), ["required" => true]);
        $category->setLabel('Категории');
        $this->add($category);

        $type = new Select("type",
        [   
            "" => "Выберите вид услуг",
            "must" => "Обязательные виды услуг",
            "optional" => "Добровольные виды услуг",
        ]);
        $type->setLabel('Вид услуг');
        $this->add($type);

        $title = new Text('title', ['required' => true]);
        $title->addValidator(new PresenceOf([
            'message' => 'Title can not be empty'
        ]));
        $title->setLabel('Заголовок');
        $this->add($title);     

        $text = new TextArea('text');
        $text->setLabel('Текст');
        $this->add($text);
    }

} 