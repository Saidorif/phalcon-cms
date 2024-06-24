<?php


namespace Page\Form;

use Application\Form\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Check;
use Application\Form\Element\Image;

class PageForm extends Form
{

    public function initialize()
    {
        $title = new Text('title', array('required' => true));
        $title->setLabel('Заголовок');
        $this->add($title);

        $slug = new Text('slug');
        $slug->setLabel('Ссылка');
        $this->add($slug);

        $text = new TextArea('text');
        $text->setLabel('Текст');
        $this->add($text);       

        $meta_title = new TextArea('meta_title');
        $meta_title->setLabel('Meta title');
        $this->add($meta_title);

        $meta_description = new TextArea('meta_description');
        $meta_description->setLabel('Meta description');
        $this->add($meta_description);

        $index_page = new Check('index_page');
        $index_page->setLabel('Отключить индексацию');
        $this->add($index_page);

        $menu = new Check('menu_check');
        $menu->setLabel('Подключить меню');
        $this->add($menu);

        $image = new Image('anons', ['required' => true]);
        $image->setLabel('Изображение');
        $this->add($image);

    }

} 