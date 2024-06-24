<?php

namespace Faq\Model;

use Application\Mvc\Model\Model;


class Faq extends Model
{

    public function getSource()
    {
        return "faq";
    }

    private $id;   
    private $title; // translate     
    public $text; // translate

    protected $translateModel = 'Faq\Model\Translate\FaqTranslate'; // translate
    protected $translateFields = [
        'title',        
        'text'
    ];
    

    public function initialize()
    {
        $this->hasMany("id", $this->translateModel, "foreign_id"); // translate
    }    

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }    

    public function getTitle()
    {
        return $this->getMLVariable('title');
    }

    public function setTitle($title)
    {
        $this->setMLVariable('title', $title);
        return $this;
    }

    public function getText()
    {
        return $this->getMLVariable('text');
    }

    public function setText($text)
    {
        $this->setMLVariable('text', $text);
        return $this;
    }

}