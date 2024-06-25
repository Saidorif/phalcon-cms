<?php

namespace Menu\Helper;

use Phalcon\Di\Injectable;
use Menu\Model\Menus;

class Helper extends Injectable
{

    public function menuUpperLeafs($root)
    {
        return Menus::menuUpperLeafs($root);
    }

    public function translateFieldsSubQuery($lang = null)
    {
        $lang = ($lang) ? $lang : LANG;
        
        $fields = [];
        foreach($this->translateFields as $field) {
            $fields[] = "(SELECT tr.value FROM [$this->translateModel] AS tr WHERE tr.foreign_id = p.id AND tr.lang = '$lang' AND tr.key = '$field') AS $field";
        }
        return $fields;
    }

}