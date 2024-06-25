<?php

namespace Newsletter\Model;

use Application\Mvc\Model\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class Settings extends Model
{
    public function initialize()
    {
        $this->setSource('newsletter_settings');
    }

    private $id;
    private $category;    
    private $email;    
    private $from_name;    

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    public function getCategory()
    {
        return $this->category;
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

    public function setFromName($from_name)
    {
        $this->from_name = $from_name;
        return $this;
    }

    public function getFromName()
    {
        return $this->from_name;
    }
   
}