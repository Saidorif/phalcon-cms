<?php

namespace Media\Model\Translate;

use Application\Mvc\Model\Translate;

class CategoryTranslate extends Translate
{
    public function initialize()
    {
        $this->setSource('media_category_translate');
    }

} 