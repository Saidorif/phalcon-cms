<?php

namespace Services\Model;

use Application\Cache\Keys;
use Application\Mvc\Model\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Application\Localization\Transliterator;

class Services extends Model
{

    public function getSource()
    {
        return "services";
    }

    public function initialize()
    {
        $this->hasMany('id', $this->translateModel, 'foreign_id'); // translate

        $this->belongsTo('category_id', 'Services\Model\Category', 'id', [
            'alias' => 'category'
        ]);
    }

    private $id;
    private $category_id;
    private $type;

    protected $title;
    protected $text;

    protected $translateModel = 'Services\Model\Translate\ServicesTranslate'; // translate
    protected $translateFields = [
        'title',
        'meta_description',
        'text',
    ];    

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }



    public function setTitle($title)
    {
        $this->setMLVariable('title', $title);
        return $this;
    }

    public function getTitle()
    {
        return $this->getMLVariable('title');
    }

    public function setText($text)
    {
        $this->setMLVariable('text', $text);
        return $this;
    }

    public function getText()
    {
        return $this->getMLVariable('text');
    }

    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
        return $this;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function getTypeTitle()
    {
        if ($this->category_id) {
            $types = Category::cachedListArray(['key' => 'id']);
            if (array_key_exists($this->category_id, $types)) {
                return $types[$this->category_id];
            }
        }
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }


}
