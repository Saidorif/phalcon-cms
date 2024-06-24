<?php 
namespace Payment\Model;

use Application\Mvc\Model\Model;

class Subscriber extends Model
{

    //Relationship with Orders
    public function initialize()
    {
        //
    }

    public function getSource()
    {
        return "magazine_subscribers";
    }

    public $id;
    public $fio;
    public $subtime;
    public $address;
    public $phone;
    public $summa;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }


}