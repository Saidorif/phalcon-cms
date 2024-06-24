<?php

namespace Partner\Model;

use Application\Mvc\Model\Model;


class Partner extends Model
{

    public function getSource()
    {
        return "partner";
    }

    private $id;   
    private $foto;
    private $slug;
    private $title; // translate  


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }    

    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }    


    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
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