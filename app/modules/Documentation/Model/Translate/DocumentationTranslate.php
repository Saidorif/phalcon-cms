<?php

namespace Documentation\Model\Translate;

use Application\Mvc\Model\Translate;

class DocumentationTranslate extends Translate
{

    public function initialize()
    {
        $this->setSource('documentation_translate');
    }

}