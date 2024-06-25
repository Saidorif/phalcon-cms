<?php

namespace Reviews\Model\Translate;

use Application\Mvc\Model\Translate;

class ReviewsTranslate extends Translate
{
    public function initialize()
    {
        $this->setSource('reviews_translate');
    }
}