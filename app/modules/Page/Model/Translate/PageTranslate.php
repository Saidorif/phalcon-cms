<?php

namespace Page\Model\Translate;

use Application\Mvc\Model\Translate;

class PageTranslate extends Translate
{

    public function initialize()
    {
        $this->setSource('page_translate');
    }

}