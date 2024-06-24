<?php

namespace Services\Form;

use Application\Form\Form;
use Phalcon\Forms\Element\Text;
use Services\Model\Category;

class CategoryForm extends Form
{

    public function initialize()
    {
        $this->add((new Text('title', array('required' => true)))->setLabel('Заголовок'));
        $this->add((new Text('slug', array('required' => true)))->setLabel('Ссылка'));

    }

}
