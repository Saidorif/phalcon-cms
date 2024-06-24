<?php 
namespace Payment\Model;

use Application\Mvc\Model\Model;

class Howtoknow extends Model
{

    //Relationship with Orders
    public function initialize()
    {
        $this->belongsTo('member_id', 'Payment\Model\Membership', 'id', [
          'alias' => 'howtoknow'
        ]);
    }

    public function getSource()
    {
        return "membership_howtoknow";
    }

    public $id;
    public $member_id;
    public $value;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }


}