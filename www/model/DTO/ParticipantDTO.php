<?php

namespace App\model\DTO;

class ParticipantDTO implements \JsonSerializable
{
    private $entity_id;
    private $firstname;
    private $lastname;
    private $email;
    private $position;
    private $shares_amount;
    private $start_date;
    private $parent_id;
    private $parent_firstname;

    public function __construct($entity_id = null, $firstname = null, $lastname = null, $email = null, $position = null, $shares_amount = null, $start_date = null, $parent_id = null, $parent_firstname = null)
    {
        $this->entity_id = $entity_id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->position = $position;
        $this->shares_amount = $shares_amount;
        $this->start_date = $start_date;
        $this->parent_id = $parent_id;
        $this->parent_firstname = $parent_firstname;
    }

    public function jsonSerialize(): mixed
    {
        return [
            "id" => $this->entity_id,
            "firstname" => $this->firstname,
            "lastname" => $this->lastname,
            "email" => $this->email,
            "position" => $this->position,
            "shares_amount" => $this->shares_amount,
            "start_date" => $this->start_date,
            "parent_id" => $this->parent_id,
            "parent_firstname" => $this->parent_firstname
        ];
    }

    public function getEntityId()
    {
        return $this->entity_id;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function getSharesAmount()
    {
        return $this->shares_amount;
    }

    public function getStartDate()
    {
        return $this->start_date;
    }

    public function getParentId()
    {
        return $this->parent_id;
    }

    public function getParentFirstname()
    {
        return $this->parent_firstname;
    }


}
