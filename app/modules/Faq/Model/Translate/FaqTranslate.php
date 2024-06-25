<?php

namespace Faq\Model\Translate;

use Application\Mvc\Model\Translate;

class FaqTranslate extends Translate
{
    public function initialize()
    {
        $this->setSource('faq_translate');
    }

}