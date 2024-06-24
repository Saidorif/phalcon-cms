<?php

namespace Products\Model\Helper;

use Application\Cache\Keys;
use Products\Model\Products;

class ProductsHelper extends Products
{

    public function productsBySlug($slug, $lang = null, $lifeTime = 60)
    {
        $lang = ($lang) ? $lang : LANG;

        $productsResult = $this->getDi()->get('cacheManager')->load([
            Keys::PRODUCTS,
            $slug,
            $lang

        ], function() use ($slug, $lang, $lifeTime) {
            $columns = [
                'p.*',
                't_slug' => 't.slug'
            ];
            $fields = $this->translateFieldsSubQuery($lang);
            $columns = array_merge($columns, $fields);

            $qb = $this->modelsManager->createBuilder()
                ->columns($columns)
                ->addFrom('Products\Model\Products', 'p')
                ->innerJoin('Products\Model\Category', 'p.category_id = t.id', 't')
                ->where('p.slug = :slug:', ['slug' => $slug]);

            $result = $qb->getQuery()->execute()->getFirst();
            return $result;

        }, $lifeTime);

        return $productsResult;
    }

    public function translateFieldsSubQuery($lang = null)
    {
        $lang = ($lang) ? $lang : LANG;
        
        $fields = [];
        foreach($this->translateFields as $field) {
            $fields[] = "(SELECT tr.value FROM [$this->translateModel] AS tr WHERE tr.foreign_id = p.id AND tr.lang = '$lang' AND tr.key = '$field') AS $field";
        }
        return $fields;
    }

}