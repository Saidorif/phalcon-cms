<?php

namespace Documentation\Model\Helper;

use Application\Cache\Keys;
use Documentation\Model\Documentation;

class DocumentationHelper extends Documentation
{
    
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