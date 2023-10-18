<?php

namespace App\services;

//require_once('ParticipantRepository.php');
use App\repos\ParticipantRepository;

class ParticipantService
{

    private static $table = 'participants';
    public $participant_gateway;

    public function __construct()
    {
        $this->participant_gateway= new ParticipantRepository();
    }

    // create

    // update

    // delete


    // get all
    public function getAll() {
        return $this->participant_gateway->selectAll(self::$table);
    }

    public function delete()
    {
        $this->participant_gateway->deleteAllBesidesOne(self::$table);
    }

}