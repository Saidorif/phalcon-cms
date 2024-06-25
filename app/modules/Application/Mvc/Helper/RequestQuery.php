<?php
/**
 */

namespace Application\Mvc\Helper;

class RequestQuery extends \Phalcon\Di\Injectable
{

    public function getSymbol()
    {
        $queries = $this->request->getQuery();
        if (count($queries) == 1) {
            return '?';
        } else {
            return '&';
        }
    }

} 