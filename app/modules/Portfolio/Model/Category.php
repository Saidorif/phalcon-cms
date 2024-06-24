<?php

namespace Portfolio\Model;

use Application\Mvc\Helper\CmsCache;
use Application\Mvc\Model\Model;
use Phalcon\DI;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class Category extends Model
{

    public function getSource()
    {
        return "portfolio_category";
    }

    protected $translateModel = 'Portfolio\Model\Translate\CategoryTranslate';

    public $id;
    public $sort;
    public $title; // translate  
   

    public function initialize()
    {
        $this->hasMany('id', $this->translateModel, 'foreign_id');
    }   

    public function validation()
    {
        $validator = new Validation();
        $validator->add('sort', new UniquenessValidator(
            [
                "model"   => $this,
                "message" => $this->getDi()->get('helper')->translate("Category sort is already exists")
            ]
        ));
        return $this->validate($validator);
    }

    public static function category()
    {
        return CmsCache::getInstance()->get('portfolio_category');
    }

    public static function cachedListArray($params = [])
    {
        $cache = DI::getDefault()->get('cache');
        $key = self::cacheListKey($params);
        $list = $cache->get($key);
        if (!$list) {
            $result = self::find();
            $list = [];
            foreach ($result as $el) {
                if (isset($params['value']) && $params['value']) {
                    $value = $el->{$params['value']};
                } else {
                    $value = $el->getTitle();
                }
                if (isset($params['key']) && $params['key']) {
                    $list[$el->{$params['key']}] = $value;
                } else {
                    $list[$el->getSlug()] = $value;
                }
            }
            $cache->save($key, $list, 120);
        }

        return $list;
    }

    public static function cacheListKey($params)
    {
        return HOST_HASH . md5('Portfolio\Model\Category; list; ' . serialize($params));
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->setMLVariable('title', $title);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->getMLVariable('title');
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
    public function setSort($sort)
    {
        $this->sort = $sort;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSort()
    {
        return $this->sort;
    }

}
