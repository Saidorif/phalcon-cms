<?php

/**
 * Form
 */

namespace Application\Form;

use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\File;
use Application\Form\Element\Image;
use Application\Form\Element\Images;

abstract class Form extends \Phalcon\Forms\Form
{

    protected $helper;

    public function renderDecorated($name)
    {

        if (!$this->has($name)) {
            return "form element '$name' not found<br />";
        }

        $this->helper = $this->getDI()->get('helper');

        $element = $this->get($name);        
        $messages = $this->getMessagesFor($element->getName());

        $html = '';
        if (count($messages)) {
            $html .= '<div class="ui error message">';
            $html .= '<div class="header">' . $this->helper->translate('Ошибка валидации формы') . '</div>';
            foreach ($messages as $message) {
                $html .= '<p>' . $message . '</p>';
            }
            $html .= '</div>';
        }

        if ($element instanceof Hidden) {
            echo $element;
        } else {
            switch (true) {
                case $element instanceof Check:
                    $html .= '<div class="field checkbox">';
                    $html .= '<div class="ui toggle checkbox">';
                    $html .= $element;
                    if ($element->getLabel()) {
                        $html .= '<label>';
                        $html .= $element->getLabel();
                        $html .= '</label>';
                    }
                    $html .= '</div>';
                    $html .= '</div>';
                    break;

                case $element instanceof Image:
                    $html = $this->renderImage($element);
                    break;  

                case $element instanceof Images:
                    $html = $this->renderImages($element);
                    break;                    

               case $element instanceof File:
                    $html = $this->renderFiles($element);
                    break;

                default:
                    $html .= '<div class="field">';
                    $html .= $this->makeLabel($element);
                    $html .= $element;
                    $html .= '</div>';
            }
        }

        return $html;

    }

    public function renderAll()
    {
        $html = '';
        if ($this->getElements()) {
            foreach ($this->getElements() as $element) {
                $html .= $this->renderDecorated($element->getName());
            }
        }
        return $html;
    }

    private function makeLabel($element)
    {
        if ($element->getLabel()) {
            return '<label for="' . $element->getName() . '">' . $this->helper->translate($element->getLabel()) . '</label>';
        } else {
            return '';
        }
    }

    /**
     * @param Image $element
     * @return string $html
     */

    private function renderFiles($element)
    {
        $attributes = $element->getAttributes();

        $html = '<div class="form-group">';

        if ($element->getLabel()) {
            $html .= '<label>' . $element->getLabel() . '</label>';
        }
        
        $html .= '<br>';
       
        $html .= '<div class="fileinput fileinput-new ui action input" data-provides="fileinput">';

        if ($element->getValue()) {
            $url = $this->getDI()->get('url');
            $html .= '<label for="amount" class="ui label" style="margin-right:-4px;"><i class="file icon"></i></label><span data-trigger="fileinput" class="fileinput-filename" style="border:1px solid #e8e8e8;padding:5px 15px;min-width:300px;">'.$element->getValue().'</span>';
        } else{
            $html .= '<label for="amount" class="ui label fileinput-exists" style="margin-right:-4px;"><i class="file icon"></i></label><span data-trigger="fileinput" class="fileinput-filename" style="border:1px solid #e8e8e8;padding:5px 15px;min-width:300px;"></span>';
        }

        $html .= '<span class="ui button btn-file">
                    <span class="fileinput-new">Select file</span>
                    <span class="fileinput-exists">Change</span>
                    <input type="file" name="'.$element->getName() . '" accept="'.$attributes['accept'].'">
                </span>
                <a href="#" class="ui button red" data-dismiss="fileinput">Delete</a>
                </div>';
        if ($element->getValue()) {       
            $html .= '<p><a href="' . $url->path() . $element->getValue() . '" class="ui grey button" target="_blank">Посмотреть файл</a></p>';
        }
        $html .= '</div>';
        return $html;
    }

    private function renderImage($element)
    {
        $html = '<div class="form-group">';

        if ($element->getLabel()) {
            $html .= '<label>' . $element->getLabel() . '</label>';
        }
        if ($element->getValue()) {
            $html .= '<section onclick="selectText(this);">' . $element->getValue() . '</section>';
        } else {
            $html .= '<br>';
        }

        $html .= '<div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                 style="width: 200px; min-height: 100px">';

        if ($element->getValue()) {
            $url = $this->getDI()->get('url');
            $html .= '<img src="' . $url->path() . $element->getValue() . '" width="200">';
        }

        $html .= '</div>
                        <div>
                            <span class="btn btn-default btn-file">
                                <span class="fileinput-new">Select image</span>
                                <span class="fileinput-exists">Change</span>
                                <input type="file" name="'.$element->getName() . '">
                            </span>
                            <a href="#" class="ui button red"
                               data-dismiss="fileinput">Delete</a>
                        </div>
                    </div>
                </div>';

        return $html;
    }  


    private function renderImages($element)
    {
          
        $html = '<div class="form-group">';

        if ($element->getLabel()) {
            $html .= '<label>' . $element->getLabel() . '</label>';
        }

        $html .= '<input type="file" multiple="multiple" class="gallery" name="'.$element->getName() . '"> 
                <ul class="gallery-list">';

        if($element->getValue()) {        
	        foreach ($element->getValue() as $file) {

	            if ($file->getId()) {
	                $url = $this->getDI()->get('url');
	                $html .= '<li><div class="img"><img src="' . $url->path() . $file->getFile() . '" width="200"></div>
	                <a href="#" class="delete icon-jfi-trash" id="'.$file->getId().'"></a></li>';
	            }           
	        }        
        }

        $html .= '</ul><div id="message-delete" class="ui green inverted segment"></div></div>';

        return $html;
    }   

}
