<?php

namespace Knowledge\Model;

use Application\Mvc\Model\Model;

class Knowledge extends Model
{
    public function getSource()
    {
        return "knowledge";
    }

    private $id;
    private $parent_id;
    private $slug;
    private $image;
    private $created_at;
    private $updated_at;
    private $title; // translate
    public $text; // translate

    protected $translateModel = 'Knowledge\Model\Translate\KnowledgeTranslate'; // translate
    protected $translateFields = [
        'title',
        'text',
    ];
    
    public function initialize()
    {
        $this->hasMany("id", $this->translateModel, "foreign_id"); // translate
        $this->belongsTo("parent_id", 'Knowledge\Model\Knowledge', "id",['alias' => 'parent']); // parent
        $this->hasMany("id", 'Knowledge\Model\Knowledge', "parent_id",['alias' => 'children']); // children
        $this->hasMany("id", 'Knowledge\Model\KnowledgePivot', "parent_id",['alias' => 'items']); // items
    }

    public function beforeCreate()
    {
        $this->created_at = date("Y-m-d H:i:s");
    }

    public function beforeUpdate()
    {
        $this->updated_at = date("Y-m-d H:i:s");
    }

    public function getItemsArray()
    {
        $result = [];
        foreach ($this->items as $item) {
            $result[] = $item->getKnowledgeId();
        }
        return $result;
    }

    public function getCatsArray()
    {
        $result = [];
        $pivots = KnowledgePivot::find(array(
            'conditions' => 'knowledge_id = ?1',
            'bind' => [1 => $this->getId()]
        ));
        foreach ($pivots as $item) {
            $result[] = $item->getParentId();
        }
        if(count($result)){
            return $result;
        }
        return [0];
    }

    public function getCats()
    {
        $result = Knowledge::find(array(
            "conditions" => "id IN ({ids:array})",
            "bind" => ["ids" => $this->getCatsArray() ],
            "bindTypes" => ["ids", \Phalcon\Db\Column::BIND_PARAM_INT]
        ));
        return $result;
    }

    public static function getAsArray()
    {
        $result  = [];
        $result[] = 'Нет родитель';
        $items = self::find([
            'order' => 'parent_id DESC'
        ]);
        foreach ($items as $item) {
            $result[$item->getId()] = $item->getTitle();
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

    public function getText()
    {
        return $this->getMLVariable('text');
    }

    public function setText($text)
    {
        $this->setMLVariable('text', $text);
        return $this;
    }

    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
        return $this;
    }

    public function getParentId()
    {
        return $this->parent_id;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }
}