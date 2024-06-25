<?php

namespace Services\Model\Translate;

use Application\Mvc\Model\Translate;

class ServicesTranslate extends Translate
{
    public function initialize()
    {
        $this->setSource('services_translate');
    }
} 