<?php

namespace Products\Model;

use Application\Mvc\Model\Model;

class Additional extends Model
{

    public function getSource()
    {
        return "products_additional";
    }
   

    public $id;
    public $product_id;
    public $title; 
    public $text; 
    public $language; 

    public function initialize()
    {
        $this->belongsTo('product_id', 'Products\Model\Products', 'id');
    }    

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    } 


    /**
     * @param mixed $id
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->product_id;
    }    

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {        
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }         

    /**
     * @param mixed $text
     */
    public function setText($text)
    {        
        $this->text = $text;
        return $this;
    }  

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setLanguage($language)
    {               
        $this->language = $language;
        return $this;
    }  

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

}
