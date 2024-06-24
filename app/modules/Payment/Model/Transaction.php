<?php 
namespace Payment\Model;

use Application\Mvc\Model\Model;

class Transaction extends Model
{
    public function initialize()
    {
        $this->belongsTo('order_id', 'Payment\Model\Order', 'id', ['alias' => 'transactions']);
    }

    public function getSource()
    {
        return "transactions";
    }

    public $id;
    public $paycom_transaction_id;
    public $paycom_time;
    public $paycom_time_datetime;
    public $create_time;
    public $perform_time; //NULL
    public $cancel_time; //NULL
    public $amount;
    public $state;
    public $reason; //NULL
    public $receivers; //NULL
    public $order_id;
    public $status;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }


}