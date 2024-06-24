<?php

/**
 * LoginForm
 */

namespace Admin\Form;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\PresenceOf;

class LoginForm extends \Phalcon\Forms\Form
{

    public function initialize()
    {
        $login = new Text('login', array(
            'required' => true,
            'placeholder' => 'Введите логин',
        ));
        $login->addValidator(new PresenceOf(array('message' => 'Логин обязательно')));
        $this->add($login);

        $password = new Password('password', array(
            'required' => true,
        ));
        $password->addValidator(new PresenceOf(array('message' => 'Пароль обязательно')));
        $this->add($password);

    }

}
