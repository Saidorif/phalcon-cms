<?php

namespace Publication\Model;

use Application\Mvc\Helper\CmsCache;
use Application\Mvc\Model\Model;
use Phalcon\DI;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class Type extends Model
{

    public function getSource()
    {
        return "publication_type";
    }

    protected $translateModel = 'Publication\Model\Translate\TypeTranslate';

    public $id;
    public $title; // translate
    public $slug;
    public $index_page;
    public $limit = 10;
    public $display_date;
    public $format = 'list';    
    public $meta_description; // translate    
    public $meta_title; // translate
    public $menu_check; // translate

    public static $formats = [
        'list' => 'List',
        'grid' => 'Grid',
        'services' => 'Services'
    ];

    public function initialize()
    {
        $this->hasMany('id', $this->translateModel, 'foreign_id'); // translate

        $this->hasMany('id', 'Publication\Model\Publication', 'type_id', [
            'alias' => 'publications'
        ]);
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
        CmsCache::getInstance()->save('publication_types', $this->buildCmsTypesCache());
    }

    public function afterDelete()
    {
        CmsCache::getInstance()->save('publication_types', $this->buildCmsTypesCache());
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
        if (isset($data['display_date'])) {
            $this->setDisplayDate(1);
        } else {
            $this->setDisplayDate(0);
        }
        $this->setIndexPage(isset($data['index_page']) ? 1 : 0);
        $this->setMenuCheck(isset($data['menu_check']) ? 1 : 0);
    }

    public static function types()
    {
        return CmsCache::getInstance()->get('publication_types');
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
        return HOST_HASH . md5('Publication\Model\Type; slug = ' . $slug);
    }

    public static function cacheListKey($params)
    {
        return HOST_HASH . md5('Publication\Model\Type; list; ' . serialize($params));
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
     * @param string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    public function getFormatTitle()
    {
        if (array_key_exists($this->format, self::$formats)) {
            return self::$formats[$this->format];
        }
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
     public function getMetaDescription()
    {
        return $this->getMLVariable('meta_description');
    }

    /**
     * @return mixed
     */
    public function getSeoText()
    {
        return $this->getMLVariable('seo_text');
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

    /**
     * @param mixed $display_date
     */
    public function setDisplayDate($display_date)
    {
        $this->display_date = $display_date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDisplayDate()
    {
        return $this->display_date;
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

    /**
     * @return mixed
     */
    public function getMenuCheck()
    {
        return $this->getMLVariable('menu_check');
    }

}
