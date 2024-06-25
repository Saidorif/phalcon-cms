<?php

namespace Publication\Model\Translate;

use Application\Mvc\Model\Translate;

class PublicationTranslate extends Translate
{
    public function initialize()
    {
        $this->setSource('publication_translate');
    }
} 