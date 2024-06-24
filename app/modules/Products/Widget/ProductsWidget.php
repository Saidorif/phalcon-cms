<?php

namespace Products\Widget;

use Application\Widget\AbstractWidget;
use Products\Model\Products;
use Products\Model\Category;

class ProductsWidget extends AbstractWidget
{

    public function lastProducts($limit = 10)
    {
        $products = Products::query()        
        ->orderBy('created_at DESC')
        ->limit($limit)
        ->execute();        

        $this->widgetPartial('widget/last-products', ['products' => $products]);
    } 
    
    public function parentCategories($limit = 8)
    {
        $categories = Category::query()
        ->where("parent_id = '0'")
        ->orderBy('id ASC')
        ->limit($limit)
        ->execute();        

        $this->widgetPartial('widget/parent-categories', ['categories' => $categories]);
    } 


    public function footerProducts($limit = 7)
    {
        $products = Products::query()
        ->where("index_page = '1'")
        ->orderBy('id DESC')
        ->limit($limit)
        ->execute();

        $this->widgetPartial('widget/footer-products', ['products' => $products]);
    }    

} 