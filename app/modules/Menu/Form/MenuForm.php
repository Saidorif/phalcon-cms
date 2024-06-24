<?php

namespace Menu\Form;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Check;
use Phalcon\Validation\Validator\PresenceOf;

class MenuForm extends \Application\Form\Form
{

    public function initialize()
    {
        $this->add(
            (new Text('slug', ['required' => 'required']))
                ->addValidator(new PresenceOf([
                    'message' => 'Url is required'
                ]))
                ->setLabel('Url')
        );

        $this->add(
            (new Text('title', ['required' => 'required']))
                ->addValidator(new PresenceOf([
                    'message' => 'Title is required'
                ]))
                ->setLabel('Заголовок')
        );

        $status = new Check('status');
        $status->setLabel('Отк/Вкл меню');
        $this->add($status);

    }

}