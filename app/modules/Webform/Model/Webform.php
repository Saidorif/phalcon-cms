<?php

namespace Webform\Model;

use Application\Mvc\Model\Model;

class Webform extends Model
{

    public function mailconfig($from, $name) {
        $config = [
            'driver'     => 'smtp',
            'host'       => 'smtp.gmail.com',
            'port'       => 465,
            'encryption' => 'ssl',
            'username'   => 'no-reply@eskiz.uz',
            'password'   => 'K9i%?#E4mUJX',
            'from'      => [
                'email' => $from,
                'name'  => $name
            ],
            'viewsDir' => APPLICATION_PATH . '/views/'
        ];

        $mailer = new \Phalcon\Ext\Mailer\Manager($config);

        return $mailer;
    }
   
}