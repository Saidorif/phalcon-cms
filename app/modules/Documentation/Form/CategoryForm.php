<?php

namespace Documentation\Form;

use Application\Form\Element\Image;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use \Phalcon\Forms\Element\File;
use Phalcon\Forms\Element\Select;
use Application\Form\Form;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;

class CategoryForm extends Form
{

  public function initialize()
  {
    $title = new Text("title", ['required' => true]);
    $title->setLabel('Заголовок');

    $this->add($title);
  }

}
