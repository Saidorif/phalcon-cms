<?php

namespace Poll\Model;

use Application\Mvc\Model\Model;


class Poll extends Model
{
    private $id;   
    private $title; 
    private $status; 
    private $created_at;

    protected $translateModel = 'Poll\Model\Translate\PollTranslate'; // translate
    protected $translateFields = [
        'title'
    ];
    

    public function initialize()
    {
        $this->hasMany("id", $this->translateModel, "foreign_id"); // translate
        $this->hasMany('id', 'Poll\Model\Options', 'poll_id', [
            'alias' => 'options',
            'reusable' => true, 
            'params' => [
                'conditions' => 'language = "'.LANG.'"',
            ]
        ]);

        $this->hasMany('id', 'Poll\Model\Votes', 'poll_id', [
            'alias' => 'votes',
            'reusable' => true, 
            'params' => [
                'conditions' => 'language = "'.LANG.'"',
            ]
        ]);
        $this->setSource('poll');
    }    

    public function beforeCreate()
    {
        $this->created_at = date("Y-m-d H:i:s");
    }

    public function updateFields($data)
    {
        $this->setStatus(isset($data['status']) ? 1 : 0);
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    } 

    public function setStatus($status)
    {
        $this->status = $status;
    } 

    public function getStatus()
    {
        return $this->status;
    }       

    public function getTitle()
    {
        return $this->getMLVariable('title');
    }

    public function setTitle($title)
    {
        $this->setMLVariable('title', $title);
        return $this;
    }    

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

}