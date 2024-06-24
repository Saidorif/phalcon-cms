<?php
    /**
     *
     * Данный фильтр является просто заглушкой. Почему-то Phalcon не хотел корректно отображать путь к собираемому файлу без применения фильтра.
     *  
     */

namespace Application\Assets\Filter;

use Phalcon\Assets\FilterInterface;

class Less implements FilterInterface
{

    public function filter($contents)
    {
        return $contents;

    }

} 