<?php

namespace Knowledge\Model;

use Application\Mvc\Model\Model;

class KnowledgePivot extends Model
{
    public function getSource()
    {
        return "knowledge_pivot";
    }

    private $id;
    private $parent_id;
    private $knowledge_id;

    public function initialize()
    {
        //
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        return $this->id = $id;
    }

    public function getParentId()
    {
        return $this->parent_id;
    }

    public function setParentId($parent_id)
    {
        return $this->parent_id = $parent_id;
    }

    public function getKnowledgeId()
    {
        return $this->knowledge_id;
    }

    public function setKnowledgeId($knowledge_id)
    {
        return $this->knowledge_id = $knowledge_id;
    }
}