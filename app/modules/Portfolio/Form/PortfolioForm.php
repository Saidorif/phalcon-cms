<?php

namespace Portfolio\Form;

use Application\Form\Element\Image;
use Application\Form\Element\Images;
use Phalcon\Validation\Validator\PresenceOf;
use Application\Form\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Select;
use \Phalcon\Forms\Element\File;
use Portfolio\Model\Category;

class PortfolioForm extends Form
{

    public function initialize()
    {
        $category = new Select('category_id', Category::cachedListArray(['key' => 'id']));
        $category->setLabel('Категории');
        $this->add($category);

        $title = new Text('title', ['required' => true]);
        $title->addValidator(new PresenceOf([
            'message' => 'Title can not be empty'
        ]));
        $title->setLabel('Заголовок');
        $this->add($title);

        $slug = new Text('slug', ['required' => true]);
        $slug->setLabel('Ссылка');
        $this->add($slug);
        
        $meta_description = new TextArea('meta_description');
        $meta_description->setLabel('Meta description');
        $this->add($meta_description);

        $text = new TextArea('text');
        $text->setLabel('Текст');
        $this->add($text);
        

        $anons = new Image('anons');
        $anons->setLabel('Изображение для анонса');
        $this->add($anons);

        $gallery = new Images('gallery');
        $gallery->setLabel('Галерея');
        $this->add($gallery);
    }

} 