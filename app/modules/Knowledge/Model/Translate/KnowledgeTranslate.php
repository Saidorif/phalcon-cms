<?php

namespace Knowledge\Model\Translate;

use Application\Mvc\Model\Translate;

class KnowledgeTranslate extends Translate
{

    public function initialize()
    {
        $this->setSource('knowledge_translate');
    }

}