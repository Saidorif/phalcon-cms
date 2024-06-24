<?php

namespace Newsletter\Model;

use Application\Mvc\Model\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class Newslist extends Model
{
    public function getSource()
    {
        return "newsletter_list";
    }

    private $id;
    private $news_id;    
    private $language;    
    private $date;    

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNewsId($news_id)
    {
        $this->news_id = $news_id;
        return $this;
    }

    public function getNewsId()
    {
        return $this->news_id;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }
   
}