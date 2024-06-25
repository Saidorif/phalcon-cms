<?php

namespace Media\Model\Translate;

use Application\Mvc\Model\Translate;

class MediaTranslate extends Translate
{

    public function initialize()
    {
        $this->setSource('media_translate');
    }

} 