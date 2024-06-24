<?php

namespace Reviews\Model;

use Application\Mvc\Model\Model;


class Reviews extends Model
{

    public function getSource()
    {
        return "reviews";
    }

    private $id; 
    private $foto;
    private $title; // translate   
    private $job; // translate   
    public $text; // translate

    protected $translateModel = 'Reviews\Model\Translate\ReviewsTranslate'; // translate
    protected $translateFields = [
        'title',        
        'text',
        'job'
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

    public function getJob()
    {
        return $this->getMLVariable('job');
    }

    public function setJob($job)
    {
        $this->setMLVariable('job', $job);
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
    
    public function getFoto()
    {
        return $this->foto;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
        return $this;
    }

}