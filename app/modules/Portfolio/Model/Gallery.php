<?php

namespace Portfolio\Model;

use Application\Mvc\Model\Model;


class Gallery extends Model
{

    public function getSource()
    {
        return "portfolio_gallery";
    }

    private $id;
    private $portfolio_id;
    private $file;
    private $file_id;

    public function initialize()
    {
        $this->belongsTo('portfolio_id', 'Portfolio\Model\Portfolio', 'id');
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

    public function setPortfolioId($portfolio_id)
    {
        $this->portfolio_id = $portfolio_id;
        return $this;
    }

    public function getPortfolioId()
    {
        return $this->portfolio_id;
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
