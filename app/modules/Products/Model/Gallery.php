<?php

namespace Products\Model;

use Application\Mvc\Model\Model;


class Gallery extends Model
{

    public function getSource()
    {
        return "products_photos";
    }

    private $id;
    private $product_id;
    private $file;
    private $file_id;

    public function initialize()
    {
        $this->belongsTo('product_id', 'Products\Model\Products', 'id');
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

    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
        return $this;
    }

    public function getProductId()
    {
        return $this->product_id;
    }    

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    public function getFileId()
    {
        return $this->file_id;
    }

    public function setFileId($file_id)
    {
        $this->file_id = $file_id;
        return $this;
    }
    

}
