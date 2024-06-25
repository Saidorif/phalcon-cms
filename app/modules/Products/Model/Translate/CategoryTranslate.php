<?php

namespace Products\Model\Translate;

use Application\Mvc\Model\Translate;

class CategoryTranslate extends Translate
{
    public function initialize()
    {
        $this->setSource('products_category_translate');
    }
} 