<?php


namespace Widget\Form;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;

use Application\Form\Form;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;

class WidgetForm extends Form
{

    public function initialize()
    {
        $block = new Text("block");
        $block->addValidator(new PresenceOf(array(
            'message' => 'Блок ID не может быть пустым.'
        )));
        $block->addValidator(new Regex(array(
            'pattern' => '/[a-z0-9_-]+/i',
            'message' => 'Блок ID должен быть a-z 0-9 _ -'
        )));
        $block->setLabel('Блок ID');

        $title = new Text("title");
        $title->setLabel('Заголовок');

        $html = new TextArea("html");
        $html->setLabel('HTML');

        $this->add($block);
        $this->add($title);
        $this->add($html);

    }

}