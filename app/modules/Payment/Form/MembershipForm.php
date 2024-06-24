<?php

namespace Payment\Form;

use Phalcon\Forms\Element\Text;
use \Phalcon\Forms\Element\File;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Radio;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\TextArea;
use Application\Form\Form;
use Phalcon\Validation\Validator\PresenceOf;

class MembershipForm extends Form
{

    public function initialize()
    {
        $address = new Text("address", [ 'class' => 'input-red',  'placeholder' => '', 'required' => 'required']);

        $sphere = new Text("sphere", [ 'class' => 'input-red', 'placeholder' => "", 'required' => 'required']);

        $company_name = new Text("company_name", [ 'class' => 'input-red', 'placeholder' => "", 'required' => 'required']);

        $registration_date = new Text("registration_date", [ 'class' => 'input-red', 'placeholder' => "", 'required' => 'required']);

        $fio = new Text("fio", [ 'class' => 'input-red', 'placeholder' => "", 'required' => 'required']);

        $company_status = new Text("company_status", [ 'class' => 'input-red', 'placeholder' => "", 'required' => 'required']);

        $website = new Text("website", [ 'class' => 'input-red', 'placeholder' => "", 'required' => 'required']);

        $phone = new Text("phone", [ 'class' => 'input-red', 'placeholder' => "+998901234567", 'required' => 'required']);

        $email = new Email("email", [ 'class' => 'input-red',  'placeholder' => 'example@example.uz', 'required' => 'required']);

        $category = new Text("category", [ 'class' => 'input-red',  'placeholder' => '', 'required' => 'required']);

        $employee_count = new Text("employee_count", [ 'class' => 'input-red',  'placeholder' => '', 'required' => 'required']);


        $thematic_areas = new Text("thematic_areas", [ 'class' => 'input-red',  'placeholder' => '', 'required' => 'required']);

        $howtoknow = new Text("howtoknow", [ 'class' => 'input-red',  'placeholder' => '', 'required' => 'required']);


        $education = new Radio("education", [ 'class' => '', 'value' => 'YES', 'required' => 'required']);
        $company = new Text("company", [ 'class' => 'input-red',  'placeholder' => '', 'required' => 'required']);


        $this->add($address);
        $this->add($sphere);
        $this->add($company_name);
        $this->add($registration_date);
        $this->add($fio);
        $this->add($company_status);
        $this->add($website);
        $this->add($phone);
        $this->add($email);
        $this->add($category);
        $this->add($employee_count);
        $this->add($thematic_areas);
        $this->add($howtoknow);

    }
}
