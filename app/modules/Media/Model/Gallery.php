<?php

namespace Media\Model;

use Application\Mvc\Model\Model;


class Gallery extends Model
{
    private $id;
    private $media_id;
    private $file;
    private $file_id;

    public function initialize()
    {
        $this->setSource('media_gallery');
        $this->belongsTo('media_id', 'Media\Model\Media', 'id');
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

    public function setMediaId($media_id)
    {
        $this->media_id = $media_id;
        return $this;
    }

    public function getMediaId()
    {
        return $this->media_id;
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
