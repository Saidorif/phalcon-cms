<?php

namespace Products\Model;

use Application\Cache\Keys;
use Application\Mvc\Model\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Application\Localization\Transliterator;

class Products extends Model
{
    public function initialize()
    {
        $this->hasMany('id', $this->translateModel, 'foreign_id'); 

        $this->hasMany('id', 'Products\Model\Gallery', 'product_id', [
            'alias' => 'photos'
        ]);

        $this->hasMany('id', 'Products\Model\Additional', 'product_id', [
            'alias' => 'additional',
            'reusable' => true, 
            'params' => [
                'conditions' => 'language = "'.LANG.'"',
            ]
        ]);

        $this->belongsTo('category_id', 'Products\Model\Category', 'id', [
            'alias' => 'category'
        ]);
        $this->setSource('products');
    }

    private $id;
    private $category_id;
    private $slug;
    private $created_at;
    private $updated_at;    
    private $anons; 
    private $special_offer; 
    private $price; 
    private $views; 
    private $index_page;
    
    protected $title;
    protected $text;
    protected $meta_description;
     protected $meta_title;

    protected $translateModel = 'Products\Model\Translate\ProductsTranslate'; // translate
    protected $translateFields = [
        'title',       
        'meta_description',        
        'meta_title',        
        'text'
    ];

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
        parent::afterUpdate();

        $cache = $this->getDi()->get('cache');

        $cache->delete(self::cacheSlugKey($this->getSlug()));
        
        $this->getDi()->get('cacheManager')->delete([
            Keys::PRODUCTS,
            $this->slug,
            self::$lang
        ]);
           
    }

    public function validation()
    {
        $validator = new Validation();
        $validator->add('slug', new UniquenessValidator(
            [
                "model"   => $this,
                "message" => $this->getDi()->get('helper')->translate("Product with slug is already exists")
            ]
        ));
        return $this->validate($validator);
    }
    

    public function updateFields($data)
    {
        if (!$this->getSlug()) {
            $this->setSlug(Transliterator::slugify($data['title']));
        }   
        $this->setSpecialOffer(isset($data['special_offer']) ? 1 : 0);
        $this->setIndexPage(isset($data['index_page']) ? 1 : 0);
        
    }

    public static function findCachedBySlug($slug)
    {
        $products = self::findFirst(["slug = '$slug'",
            'cache' => [
                'key'      => self::cacheSlugKey($slug),
                'lifetime' => 60]
        ]);
        return $products;
    }

    public static function cacheSlugKey($slug)
    {
        $key = HOST_HASH . md5('Products\Model\Products; slug = ' . $slug);
        return $key;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
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

    public function getMetaDescription()
    {
        return $this->getMLVariable('meta_description');
    }
    
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
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

    public function setTitle($title)
    {
        $this->setMLVariable('title', $title);
        return $this;
    }

    public function getTitle()
    {
        return $this->getMLVariable('title');
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
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

    public function getCategoryTitle()
    {
        if ($this->category_id) {
            $category = Category::cachedListArray(['key' => 'id']);
            if (array_key_exists($this->category_id, $category)) {
                return $category[$this->category_id];
            }
        }
    }

    public function getCategorySlug()
    {
        if ($this->category_id) {
            $category = Category::cachedListArray(['key' => 'id', 'value' => 'slug']);
            if (array_key_exists($this->category_id, $category)) {
                return $category[$this->category_id];
            }
        }
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

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function getViews()
    {
        return $this->views;
    }

    public function setViews($views)
    {
        $this->views = $views;
        return $this;
    }

    public function setSpecialOffer($special_offer)
    {
        $this->special_offer = $special_offer;
        return $this;
    }

    public function getSpecialOffer()
    {
        return $this->special_offer;
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

}
