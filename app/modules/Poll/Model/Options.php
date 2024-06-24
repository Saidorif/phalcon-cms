<?php

namespace Poll\Model;

use Application\Mvc\Model\Model;

class Options extends Model
{

    public function getSource()
    {
        return "poll_options";
    }
   

    public $id;
    public $poll_id;
    public $title;
    public $vote; 
    public $language; 

    public function initialize()
    {
        $this->belongsTo('poll_id', 'Poll\Model\Poll', 'id');
    }    

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    } 


    /**
     * @param mixed $id
     */
    public function setPollId($poll_id)
    {
        $this->poll_id = $poll_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPollId()
    {
        return $this->poll_id;
    }    

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {        
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }     

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {               
        $this->language = $language;
        return $this;
    }  

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $vote
     */
    public function setVote($vote)
    {               
        $this->vote = $vote;
        return $this;
    }

    public function getVote()
    {
        return $this->vote;
    }  

}
