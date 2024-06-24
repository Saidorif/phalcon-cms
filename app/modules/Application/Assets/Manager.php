<?php

namespace Application\Assets;


class Manager extends \Phalcon\Assets\Manager
{

    public function outputLess($collectionName = null)
    {
        $this->useImplicitOutput(false);
        return str_replace('stylesheet', 'stylesheet/less', $this->outputCss($collectionName));
    }

} 