<?php

namespace Media\Form;

use Application\Form\Form;
use Phalcon\Forms\Element\Text;
use Media\Model\Category;

class CategoryForm extends Form
{

    public function initialize()
    {
        $this->add((new Text('title', array('required' => true)))->setLabel('Заголовок'));        
        $this->add((new Text('sort', array('required' => true)))->setLabel('Сортировка'));        

    }

} 