<?php

namespace Page\Model;

use Application\Cache\Keys;
use Application\Mvc\Model\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Application\Localization\Transliterator;

class Page extends Model
{
    private $id;
    private $slug;
    private $created_at;
    private $updated_at;
    private $index_page;
    private $anons;

    protected $title; // translate
    protected $text; // translate   
    protected $meta_title; // translate
    protected $meta_description; // translate
    protected $menu_check; // translate

    protected $translateModel = 'Page\Model\Translate\PageTranslate'; // translate
    protected $translateFields = [
        'title',        
        'meta_title',        
        'meta_description',        
        'menu_check',        
        'text'
    ];

    public function initialize()
    {
        $this->setSource('page');
        $this->hasMany("id", $this->translateModel, "foreign_id"); // translate
    }

    public function beforeCreate()
    {
        $this->created_at = date("Y-m-d H:i:s");
    }

    public function beforeUpdate()
    {
        $this->updated_at = date("Y-m-d H:i:s");
    }

    public function afterUpdate()
    {
        $this->getDi()->get('cacheManager')->delete([
            Keys::PAGE,
            $this->slug,
            self::$lang
        ]);        
    }

    public function updateFields($data)
    {
        if (!$this->getSlug()) {
            $this->setSlug(Transliterator::slugify($data['title']));
        }        
        $this->setIndexPage(isset($data['index_page']) ? 1 : 0);
        $this->setMenuCheck(isset($data['menu_check']) ? 1 : 0);
    }

    public function validation()
    {
        $validator = new Validation();
        $validator->add('slug', new UniquenessValidator(
            [
                "model"   => $this,
                "message" => $this->getDi()->get('helper')->translate("Page with slug is already exists")
            ]
        ));
        return $this->validate($validator);
    }

    public static function findCachedBySlug($slug)
    {
        $query = "slug = '$slug'";
        $key   = HOST_HASH . md5("Page::findFirst($query)");
        $page  = self::findFirst([$query, 'cache' => ['key' => $key, 'lifetime' => 60]]);
        return $page;
    }

    /**
     * @param mixed $created_at
     * @return $this
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $id
     * @return $this
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
     * @return $this
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
     * @param mixed $text
     * @return $this
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
     * @param mixed $title
     * @return $this
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
     * @param $updated_at
     * @return $this
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
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

    /**
    * @return mixed
    */

    public function setMenuCheck($menu_check)
    {
        $this->setMLVariable('menu_check', $menu_check);
        return $this;
    }
   
    public function getMenuCheck()
    {
        return $this->getMLVariable('menu_check');
    }

    public function getAnons()
    {
        return $this->anons;
    }

    public function setAnons($anons)
    {
        $this->anons = $anons;
        return $this;
    }    

}
