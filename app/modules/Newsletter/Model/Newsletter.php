<?php

namespace Newsletter\Model;

use Application\Mvc\Model\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class Newsletter extends Model
{
    public function getSource()
    {
        return "newsletter";
    }

    private $id;
    private $email;

    public function validation()
    {
        $validator = new Validation();
        $validator->add('email', new UniquenessValidator(
            [
                "model"   => $this,
                "message" => $this->getDi()->get('helper')->translate("Email is already exists")
            ]
        ));


        return $this->validate($validator);
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }
}