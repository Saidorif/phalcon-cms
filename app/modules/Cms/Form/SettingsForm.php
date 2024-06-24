<?php

namespace Cms\Form;

use Application\Form\Form;
use Application\Form\Element\Image;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Text;

class SettingsForm extends Form
{

    public function initialize()
    {
        $this->add((new Text('site_name'))->setLabel('Название сайта'));
        $this->add((new Text('email'))->setLabel('E-mail адрес для обратной связи'));
        $this->add((new Image('logo'))->setLabel('Логотип веб сайта'));
        $this->add((new Image('favicon'))->setLabel('Значок веб сайта (favicon)'));
    }

} 