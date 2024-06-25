<?php

namespace Publication\Model\Translate;

use Application\Mvc\Model\Translate;

class TypeTranslate extends Translate
{
    public function initialize()
    {
        $this->setSource('publication_type_translate');
    }
} 