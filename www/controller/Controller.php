<?php

namespace App\controller;

use App\services\ParticipantService;

class Controller
{
    public $participant_service;
    public function __construct()
    {
        $this->participant_service = new ParticipantService();
    }

    // TODO: Create person

    // TODO: Update position of person

    public function delete() {

        $this->participant_service->delete();
        $this->redirect('?action=show');
    }

    public function showAll() {
        $title = 'Participants';
        $participants = $this->participant_service->getAll();

        include('view/participants.php');
    }

    // TODO: Handle request
    public function handleRequest()
    {
        $operation = isset( $_GET['action'] ) ? $_GET['action'] : null;

        try {
            if ($operation == null || $operation == 'show') {
                $this->showAll();
            } elseif ($operation == 'delete') {
                $this->delete();
            }
//            elseif ( $operation == 'create' ) {
//                $this->create();
//            } elseif ( $operation == 'update' ) {
//                $this->update();
//            }
//            else {
//                $this->showError();
//            }
        } catch ( \Exception $e ) {
//            $this->showError( 'Application error', $e->getMessage() );

        }
    }

    private function redirect($location)
    {
        header('Location: ' . $location);
    }


}