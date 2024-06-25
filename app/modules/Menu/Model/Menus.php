<?php

namespace Menu\Model;

use Phalcon\Validation;
use Application\Mvc\Model\Model;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class Menus extends Model
{
    protected $translateModel = 'Menu\Model\Translate\MenusTranslate'; // translate

    private $id;
    private $root = 'main';
    private $parent_id;
    private $slug;
    private $status;
    private $depth = 0;
    private $left_key;
    private $right_key;
    private $created_at;
    private $updated_at;
    public  $title; // translate

    public static $roots = [
        'main' => 'Меню в шапке',
        'bottom' => 'Нижный меню футера'
    ];

    public function initialize()
    {
        $this->setSource('menu');
        $this->belongsTo('parent_id', 'Menus\Model\Menus', 'id', ['alias' => 'Parent']);
        $this->hasMany("id", $this->translateModel, "foreign_id");
    }

    public function beforeCreate()
    {
        $this->created_at = date("Y-m-d H:i:s");
    }

    public function beforeUpdate()
    {
        $this->updated_at = date("Y-m-d H:i:s");
    }

    public static function menuUpperLeafs($root)
    {
        $entries = Menus::find([
            'root = :root: AND parent_id IS NULL',
            'order' => 'left_key',
            'bind'  => ['root' => $root]
        ]);
        return $entries;
    }

    public function children()
    {
        $entries = $this->find([
            'left_key >= :left_key: AND right_key <= :right_key: AND depth = :depth_plus: AND id <> :id: AND root = :root:',
            'order' => 'left_key ASC',
            'bind'  => [
                'id'          => $this->getId(),
                'root'        => $this->getRoot(),
                'depth_plus' => $this->getDepth() + 1,
                'left_key'    => $this->getLeftKey(),
                'right_key'   => $this->getRightKey(),
            ]
        ]);
        return $entries;
    }

    public function hasChildren()
    {
        if (abs($this->getRightKey() - $this->getLeftKey()) > 1) {
            return true;
        }
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
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @param string $root
     */
    public function setRoot($root)
    {
        $this->root = $root;
    }

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @param mixed $parent_id
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }

    /**
     * @return mixed
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * @param mixed $depth
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;
    }

    /**
     * @return mixed
     */
    public function getLeftKey()
    {
        return $this->left_key;
    }

    /**
     * @param mixed $left_key
     */
    public function setLeftKey($left_key)
    {
        $this->left_key = $left_key;
    }

    /**
     * @return mixed
     */
    public function getRightKey()
    {
        return $this->right_key;
    }

    /**
     * @param mixed $right_key
     */
    public function setRightKey($right_key)
    {
        $this->right_key = $right_key;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->getMLVariable('title');
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->setMLVariable('title', $title);
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->getMLVariable('status');
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->setMLVariable('status', $status);
    }
}
