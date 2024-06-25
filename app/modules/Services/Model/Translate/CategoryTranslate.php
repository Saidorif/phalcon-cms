<?php

namespace Services\Model\Translate;

use Application\Mvc\Model\Translate;

class CategoryTranslate extends Translate
{
    public function initialize()
    {
        $this->setSource('services_category_translate');
    }
} 