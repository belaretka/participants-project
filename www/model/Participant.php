<?php

namespace App\model;

class Participant
{
    private $entity_id;
    private $firstname;
    private $lastname;
    private $email;
    private $position;
    private $shares_amount;
    private $start_date;
    private $parent_id;

    public function __construct($_id = null, $_firstname = null, $_lastname  = null, $_email  = null, $_position  = null, $_shares_amount = null, $_start_date  = null, $_parent_id = null)
    {
        $this->entity_id = $_id;
        $this->firstname = $_firstname;
        $this->lastname = $_lastname;
        $this->email = $_email;
        $this->position = $_position;
        $this->shares_amount = $_shares_amount;
        $this->start_date = $_start_date;
        $this->parent_id = $_parent_id;
    }

    public function getEntityId()
    {
        return $this->entity_id;
    }

    public function setEntityId($id)
    {
        $this->entity_id = $id;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function getSharesAmount()
    {
        return $this->shares_amount;
    }

    public function setSharesAmount($shares_amount)
    {
        $this->shares_amount = $shares_amount;
    }

    public function getStartDate()
    {
        return $this->start_date;
    }

    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;
    }

    public function getParentId()
    {
        return $this->parent_id;
    }

    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }


}