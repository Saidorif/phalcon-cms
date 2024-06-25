<?php

namespace Products\Model\Translate;

use Application\Mvc\Model\Translate;

class ProductsTranslate extends Translate
{
    public function initialize()
    {
        $this->setSource('products_translate');
    }
} 