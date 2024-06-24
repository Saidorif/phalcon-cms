<?php

namespace Documentation\Model;

use Application\Mvc\Model\Model;


class Documentation extends Model
{

    public function getSource()
    {
        return "documentation";
    }

    private $id;
    private $url;
    private $type;
    private $file;
    private $size;
    private $format;
    private $title; // translate
    private $author; // translate
    private $text; // translate
    private $sources;
    private $category_id;
    public $image;

    protected $translateModel = 'Documentation\Model\Translate\DocumentationTranslate'; // translate
    protected $translateFields = [
        'title',
        'author',
        'text',
    ];


    public function initialize()
    {
        $this->hasMany("id", $this->translateModel, "foreign_id"); // translate
        $this->belongsTo("category_id", 'Documentation\Model\Category', "id");
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

    public function getAuthor()
    {
        return $this->getMLVariable('author');
    }

    public function setAuthor($author)
    {
        $this->setMLVariable('author', $author);
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

    public function setSources($sources)
    {
        $this->sources = $sources;
        return $this;
    }

    public function getSources()
    {
        return $this->sources;
    }
    
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }


    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }


    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function setCategoryId($category_id)
    {
        return $this->category_id = $category_id;
    }


}
