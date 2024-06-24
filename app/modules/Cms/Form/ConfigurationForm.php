<?php

namespace Cms\Form;

use Application\Form\Form;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Text;

class ConfigurationForm extends Form
{

    public function initialize()
    {
        $this->add((new Check('DEBUG_MODE'))->setLabel('Режим отладки, ошибки приложений дисплей'));
        $this->add((new Check('PROFILER'))->setLabel('База Данных профайлер'));
        $this->add((new Check('DISPLAY_CHANGELOG'))->setLabel('Дисплей изменений на административным панели начальной страницы'));
        $this->add((new Check('WIDGETS_CACHE'))->setLabel('Кэширование Виджеты'));
        $this->add((new Text('ADMIN_EMAIL'))->setLabel('Админ Email'));
        $this->add((new Check('TECHNICAL_WORKS'))->setLabel('Сайт находится на стадии технического обслуживания'));

    }

} 