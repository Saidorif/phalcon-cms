<?php
namespace Payment\Model;

use Application\Mvc\Model\Model;

class Membership extends Model
{

    //Relationship with Orders
    public function initialize()
    {
        $this->hasMany('id', 'Payment\Model\Order', 'member_id', [
          'alias' => 'order'
        ]);

        $this->hasMany('id', 'Payment\Model\ThematicAreas', 'member_id', [
          'alias' => 'thematic_areas'
        ]);

        $this->hasMany('id', 'Payment\Model\Howtoknow', 'member_id', [
          'alias' => 'howtoknow'
        ]);
    }

    public function getSource()
    {
        return "membership";
    }

    public $id;
    public $address;
    public $sphere;
    public $fio;
    public $company_status;
    public $website;
    public $phone;
    public $email;
    public $category;
    public $employee_count;
    public $thematic_areas;
    public $howtoknow;
    public $company_name;
    public $registration_date;
    public $created_at;

    public function beforeCreate()
    {
        $this->created_at = date("Y-m-d H:i:s");
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }


}
