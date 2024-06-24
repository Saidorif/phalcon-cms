<?php

namespace Documentation\Model;

use Application\Mvc\Model\Model;


class Category extends Model
{
    public function getSource()
    {
        return "documentation_category";
    }

    private $id;
    private $title; // translate

    protected $translateModel = 'Documentation\Model\Translate\DocumentationCategoryTranslate'; // translate
    protected $translateFields = [
        'title',
    ];


    public function initialize()
    {
        $this->hasMany("id", $this->translateModel, "foreign_id"); // translate
        $this->hasMany("id", 'Documentation\Model\Documentation', "category_id",['alias' => 'documents']);
    }

    public static function asArray()
    {
        $result = [];
        $cats = self::find();
        foreach($cats as $key => $cat){
            $result[$cat->id] = $cat->getTitle();
        }
        return $result;
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
}