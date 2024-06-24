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
use Documentation\Model\Category;
class DocumentationForm extends Form
{

  public function initialize()
  {
    $title = new Text("title", ['required' => true]);
    $title->setLabel('Заголовок');

    $file = new File("file");
    $file->setLabel('Файл');

    $sources = new Select(
      "sources",
      [
        "lexuz" => "Lex.uz",
        "file" => "Загрузить файл",
      ]
    );

    $sources->setLabel('Источник');
    
    $cateogry = new Select(
      "type",
      [
        "library" => "Библотека",
        "docs" => "Законодательство",
        "ukazyi" => "Указы",
      ]
    );

    $cateogry->setLabel('Тип');

    $category_id = new Select(
      "category_id", Category::asArray()
    );

    $category_id->setLabel('Категория');


    $url = new Text("url");
    $url->setLabel('Ссылка');
    
    $author = new Text("author");
    $author->setLabel('Автор');
    
    $text = new TextArea("text");
    $text->setLabel('Текст');

    $image = new Image('image');
    $image->setLabel('Изображение');
    $this->add($image);

    $this->add($title);
    $this->add($sources);
    $this->add($cateogry);
    $this->add($url);
    $this->add($file);
    $this->add($author);
    $this->add($text);
    $this->add($category_id);
  }

}
