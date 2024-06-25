<?php

namespace Portfolio\Model\Translate;

use Application\Mvc\Model\Translate;

class PortfolioTranslate extends Translate
{
    public function initialize()
    {
        $this->setSource('portfolio_translate');
    }
} 