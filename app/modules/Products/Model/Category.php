<?php

namespace Products\Model;

use Application\Mvc\Helper\CmsCache;
use Application\Mvc\Model\Model;
use Phalcon\DI;
use Phalcon\Validation;
use Application\Localization\Transliterator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class Category extends Model
{
    protected $translateModel = 'Products\Model\Translate\CategoryTranslate';

    public $id;
    public $parent_id;
    public $title; // translate
    public $slug;
    public $foto;
    public $text;
    private $index_page;
    public $limit = 10; 
    public $meta_description; 
    protected $meta_title; 
    protected $menu_check;   

    public function initialize()
    {
        $this->hasMany('id', $this->translateModel, 'foreign_id'); // translate

        $this->hasMany('id', 'Products\Model\Products', 'category_id', [
            'alias' => 'products'
        ]);

        $this->belongsTo('parent_id', 'Products\Model\Category', 'id', [
            'alias' => 'parent'
        ]);

        $this->setSource('products_category');
    }

    public function children()
    {
        $children = self::find([
            'conditions' => 'parent_id = ?1',
            'bind' => [
                1 => $this->getId()
            ]
        ]);
        if(count($children)){
            return true;
        }
        return false;
    }

    public function getChildren()
    {
        $children = self::find([
            'conditions' => 'parent_id = ?1',
            'bind' => [
                1 => $this->getId()
            ]
        ]);
        if(count($children)){
            return $children;
        }
        return false;
    }

    public function validation()
    {
        $validator = new Validation();
        $validator->add('slug', new UniquenessValidator(
            [
                "model"   => $this,
                "message" => "Тип публикаций с таким URL раздела = '" . $this->slug . "' уже существует"
            ]
        ));
        return $this->validate($validator);
    }

    public function afterUpdate()
    {
        parent::afterUpdate();

        $cache = $this->getDi()->get('cache');
        $cache->delete(self::cacheSlugKey($this->getSlug()));
    }

    public function afterSave()
    {
        CmsCache::getInstance()->save('products_category', $this->buildCmsTypesCache());
    }

    public function afterDelete()
    {
        CmsCache::getInstance()->save('products_category', $this->buildCmsTypesCache());
    }

    public function asArray(){
        $all = self::find();
        $result = [
            0 => 'Нет родитель',
        ];
        foreach($all as $k => $a){
            $result[$a->getId()] = $a->getTitle(); 
        }
        return $result;
    }

    private function buildCmsTypesCache()
    {
        $types = self::find();
        $save = [];
        foreach ($types as $type) {
            $save[$type->getSlug()] = [
                'id' => $type->getId(),
                'slug' => $type->getSlug(),
            ];
        }
        return $save;
    }

    public function updateFields($data)
    {
        if (!$this->getSlug()) {
            $this->setSlug(Transliterator::slugify($data['title']));
        }
        if (!$this->getTitle()) {
            $this->setTitle($data['title']);
        }              
        $this->setIndexPage(isset($data['index_page']) ? 1 : 0);
        $this->setMenuCheck(isset($data['menu_check']) ? 1 : 0);
    }

    public static function category()
    {
        return CmsCache::getInstance()->get('products_category');
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

    public static function getCachedBySlug($slug)
    {
        $data = self::findFirst([
            'slug = :slug:',
            'bind' => [
                'slug' => $slug,
            ],
            'cache' => [
                'key' => self::cacheSlugKey($slug),
                'lifetime' => 86400,
            ]
        ]);

        return $data;
    }

    public static function cacheSlugKey($slug)
    {
        return HOST_HASH . md5('Products\Model\Category; slug = ' . $slug);
    }

    public static function cacheListKey($params)
    {
        return HOST_HASH . md5('Products\Model\Category; list; ' . serialize($params));
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
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->setMLVariable('text', $text);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->getMLVariable('text');
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
     * @param mixed $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param mixed $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param mixed $meta_description
     * @return $this
     */
    public function setMetaTitle($meta_title)
    {
        $this->setMLVariable('meta_title', $meta_title);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMetaTitle()
    {
        return $this->getMLVariable('meta_title');
    }
    /**
     * @param mixed $meta_description
     */
    public function setMetaDescription($meta_description)
    {
        $this->setMLVariable('meta_description', $meta_description);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMetaDescription()
    {
        return $this->getMLVariable('meta_description');
    }   

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }   

    public function setIndexPage($index_page)
    {
        $this->index_page = $index_page;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIndexPage()
    {
        return $this->index_page;
    } 

    public function setMenuCheck($menu_check)
    {
        $this->setMLVariable('menu_check', $menu_check);
        return $this;
    }
   
    public function getMenuCheck()
    {
        return $this->getMLVariable('menu_check');
    }

    public function getParentId()
    {
        return $this->parent_id;
    }

    public function setParentId($parent_id)
    {
        return $this->parent_id = $parent_id;
    }

}
