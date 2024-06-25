<?php 
namespace Payment\Model;

use Application\Mvc\Model\Model;

class Order extends Model
{
    //Relationship with Memebers
    public function initialize()
    {
        $this->hasMany('id', 'Payment\Model\Transaction', 'order_id', ['alias' => 'transactions']);
        $this->belongsTo('member_id', 'Payment\Model\Membership', 'id', ['alias' => 'member']);
        $this->setSource('orders');
    }


    public $id;
    public $amount;
    public $state;
    public $member_id;
    public $status;
    public $subscriber_id;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getProductIds()
    {
        return $this->product_ids;
    }

    public function setProductIds($product_ids){
        $this->product_ids = $product_ids;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount){
        $this->amount = $amount;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state){
        $this->state = $state;
    }


    public function getMemberId()
    {
        return $this->member_id;
    }

    public function setMemberId($member_id){
        $this->member_id = $member_id;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone){
        $this->phone = $phone;
    }



}