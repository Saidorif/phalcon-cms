<?php

namespace Portfolio\Model;

use Application\Cache\Keys;
use Application\Mvc\Model\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Application\Localization\Transliterator;

class Portfolio extends Model
{

    public function getSource()
    {
        return "portfolio";
    }

    public function initialize()
    {
        $this->hasMany('id', $this->translateModel, 'foreign_id'); // translate
        $this->hasMany('id', 'Portfolio\Model\Gallery', 'portfolio_id', [
            'alias' => 'gallery'
        ]);

        $this->belongsTo('category_id', 'Portfolio\Model\Category', 'id', [
            'alias' => 'category'
        ]);
    }

    private $id;
    private $category_id;
    private $slug;
    private $anons;    
    
    protected $title;
    protected $text;
    protected $meta_description;

    protected $translateModel = 'Portfolio\Model\Translate\PortfolioTranslate'; // translate
    protected $translateFields = [
        'title',
        'meta_description',        
        'text',        
    ];    

    public function validation()
    {
        $validator = new Validation();
        $validator->add('slug', new UniquenessValidator(
            [
                "model"   => $this,
                "message" => $this->getDi()->get('helper')->translate("Portfolio with slug is already exists")
            ]
        ));
        return $this->validate($validator);
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
