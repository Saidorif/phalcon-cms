<?php

namespace Slider\Model;

use Application\Mvc\Model\Model;


class Slider extends Model
{

    public function getSource()
    {
        return "slider";
    }

    private $id;   
    private $banner;
    private $view_title;
    private $title; // translate   
    public $text; // translate

    protected $translateModel = 'Slider\Model\Translate\SliderTranslate'; // translate
    protected $translateFields = [
        'title',        
        'text'
    ];
    

    public function initialize()
    {
        $this->hasMany("id", $this->translateModel, "foreign_id"); // translate
    }    

    public function updateFields($data)
    {       
        if (isset($data['view_title'])) {
            $this->setViewTitle(1);
        } else {
            $this->setViewTitle(0);
        }        
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
        return $this->getMLVariable('title');;

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

    public function setViewTitle($view_title)
    {
        $this->view_title = $view_title;
        return $this;
    }

    public function getViewTitle()
    {
        return $this->view_title;
    }

    public function getBanner()
    {
        return $this->banner;
    }

    public function setBanner($banner)
    {
        $this->banner = $banner;
        return $this;
    }

}