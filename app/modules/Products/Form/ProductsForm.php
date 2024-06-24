<?php

namespace Products\Form;

use Application\Form\Element\Image;
use Application\Form\Element\Images;
use Phalcon\Forms\Element\Check;
use Phalcon\Validation\Validator\PresenceOf;
use Application\Form\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Select;
use \Phalcon\Forms\Element\File;
use Products\Model\Category;

class ProductsForm extends Form
{

    public function initialize()
    {
        $category = new Select('category_id', Category::cachedListArray(['key' => 'id']));
        $category->setLabel('Категория');
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

        $text = new TextArea('text');
        $text->setLabel('Текст');
        $this->add($text);       

        $price = new Numeric("price", ['value' => 0]);
        $price->setLabel('Цена');
        $this->add($price);

        $special_offer = new Check('special_offer');
        $special_offer->setLabel('Спецпредложение');
        $this->add($special_offer);

        $meta_description = new TextArea('meta_description');
        $meta_description->setLabel('Meta-description');
        $this->add($meta_description);

        $meta_title = new TextArea('meta_title');
        $meta_title->setLabel('Meta-title');
        $this->add($meta_title);

        $image = new Image('anons', ['required' => true]);
        $image->setLabel('Изображение');
        $this->add($image);

        $photos = new Images('photos');
        $photos->setLabel('Фотографии');
        $this->add($photos);

        $index_page = new Check('index_page');
        $index_page->setLabel('Показать на главной странице');
        $this->add($index_page);
    }

} 