<?php

namespace Breadcrumbs\Widget;

use Application\Widget\AbstractWidget;
use Breadcrumbs\Model\Breadcrumbs;
use Publication\Model\Type;
use Products\Model\Category;

class BreadcrumbsWidget extends AbstractWidget
{

    public function breadcrumbs($param = null, $type = null, $product = null)
    {
        $home = $this->helper->translate('Home');
        $path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));
        $base = $this->helper->currentUrl(constant('LANG'));
        $breadcrumbs = Array("<li property='itemListElement' class='breadcrumb-item breadcrumb_item_fixed' typeof='ListItem'><a href=\"$base\" property='item' typeof='WebPage'><span property='name'>$home</span></a><meta property='position' content='1'></li>");
        $last = end(array_keys($path));
        foreach ($path AS $x => $crumb) {
            if(LANG != $crumb){
                $current_title = array_filter(explode('|', $this->helper->title()->get()));
                if ($x != $last){
                    if($type)
                        $url = $this->helper->langUrl(array('for'=>$param, $type=>$crumb));

                    if($crumb == 'portfolio'){
                        $url = $this->helper->langUrl(array('for'=>$param));
                        $title = $this->helper->translate('Portfolio');
                    }
                    if($crumb == 'products'){
                        $url = $this->helper->langUrl(array('for'=>"product-category"));
                        $title = $this->helper->translate('Products');
                    }
                    if($crumb == 'knowledge'){
                        $url = $this->helper->langUrl(array('for'=>"knowledge"));
                        $title = $this->helper->translate('Knowledge');
                    }
                    else{
                        $publication_cat_model = Type::findFirst("slug = '".$crumb."'");

                        if($publication_cat_model){
                            $title = $publication_cat_model->getTitle();
                        }
                        else{
                            $product_cat_model = Category::findFirst("slug = '".$crumb."'");
                            if($product_cat_model){
                                $url = $this->helper->langUrl(array('for'=>"products",'category' => $crumb ));
                                $title = $product_cat_model->getTitle();
                            }
                        }
                    }
                    $x = $x + 1;
                    $breadcrumbs[] = "<li property='itemListElement' class='breadcrumb-item breadcrumb_item_fixed' typeof='ListItem'><a href=\"$url\" property='item' typeof='WebPage'><span property='name'>$title</span></a><meta property='position' content='$x'></li>";

                } else {
                    $x = $x + 1;
                    $breadcrumbs[] = "<li property='itemListElement' typeof='ListItem' class='breadcrumb-item active'><span property='name'>" .$current_title[0]. "</span><meta property='position' content='$x'></li>";
                }
            }

        }

        $breadcrumb = '<ol vocab="http://schema.org/" typeof="BreadcrumbList" class="breadcrumb">'.implode($breadcrumbs).'</ol>';

        $this->widgetPartial('breadcrumbs', ['breadcrumbs' => $breadcrumb]);
    }

} 