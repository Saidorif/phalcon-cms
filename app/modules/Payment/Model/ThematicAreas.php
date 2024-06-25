<?php 
namespace Payment\Model;

use Application\Mvc\Model\Model;

class ThematicAreas extends Model
{

    //Relationship with Orders
    public function initialize()
    {
        $this->belongsTo('member_id', 'Payment\Model\Membership', 'id', [
          'alias' => 'thematic_areas'
        ]);
        $this->setSource('membership_thematic_areas');
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