<?php

namespace Cms\Form;

use Application\Form\Form;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Text;

class LanguageForm extends Form
{

    public function initialize()
    {
        $this->add((new Text('iso', array(
            'data-description' => 'Код языка в соответствии со стандартом ISO. Например: en',
            'required' => true
        )))->setLabel('ISO'));

        $this->add((new Text('locale', array(
            'data-description' => 'Стандартный язык локалный обозначение ISO. Например: en_EN',
            'required' => true
        )))->setLabel('Локальный'));

        $this->add((new Text('name', array(
            'data-description' => 'Например: English',
            'required' => true
        )))->setLabel('Язык'));

        $this->add((new Text('short_name', array(
            'data-description' => 'Например: Eng',
            'required' => true
        )))->setLabel('Короткое название'));

        $this->add((new Text('url', array(
            'data-description' => 'URL-префикс строки страницы. Например: en. Для "основного языка" не считается, чтобы сгенерировать URL',
            'required' => true
        )))->setLabel('URL-prefix'));

        $this->add((new Text('sortorder'))->setLabel('Порядок сортировки'));

        $this->add((new Check('primary'))->setLabel('Основной язык'));
    }

} 