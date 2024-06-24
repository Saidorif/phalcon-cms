<?php

namespace Publication\Form;

use Application\Form\Form;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Select;
use Publication\Model\Type;

class TypeForm extends Form
{

    public function initialize()
    {
        $this->add((new Text('title', array('required' => true)))->setLabel('Заголовок'));
        $this->add((new Text('slug', array('required' => true, 'data-description' => 'Пример: articles')))->setLabel('Ссылка'));
        $this->add((new Text('meta_title'))->setLabel('Meta-title'));
        $this->add((new Text('meta_description'))->setLabel('Meta-description'));
        $this->add((new TextArea('seo_text'))->setLabel('SEO-Текст'));
        $this->add((new Text('limit', array('style' => 'width:106px')))->setDefault(10)->setLabel('Количество публикаций на странице'));
        $this->add((new Select('format', Type::$formats))->setLabel('Макет шаблона'));
        $this->add((new Check('display_date'))->setLabel('Показать дату'));
        $this->add((new Check('index_page'))->setLabel('Отключить индексацию'));
        $this->add((new Check('menu_check'))->setLabel('Подключить меню'));

    }

} 