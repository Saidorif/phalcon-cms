<?php

namespace Widget\Model;

use Application\Mvc\Model\Model;


class Widget extends Model
{

    private $id;
    public $block;
    private $title;    
    public $html; // translate

    protected $translateModel = 'Widget\Model\Translate\WidgetTranslate'; // translate
    

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

    public function getBlock()
    {
        return $this->block;

    }

    public function setBlock($block)
    {
        $this->block = $block;

    }

    public function getTitle()
    {
        return $this->title;

    }

    public function setTitle($title)
    {
        $this->title = $title;

    }

    public function getHtml()
    {
        return $this->getMLVariable('html');

    }

    public function setHtml($html)
    {
        $this->setMLVariable('html', $html);
        return $this;
    }

    public function getCsrf()
    {
        return $this->getDi()->get('security')->getToken();
    }

}