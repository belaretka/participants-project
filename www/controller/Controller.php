<?php

namespace App\controller;

use App\services\ParticipantService;

class Controller
{
    public $participant_service;

    public function __construct() {
        $this->participant_service = new ParticipantService();
    }

    public function handleRequest() {
        $operation = isset( $_GET['action'] ) ? $_GET['action'] : null;

        try {
            if ($operation == null || $operation == 'show') {
                $this->showAll();
            } elseif ($operation == 'delete') {
                $this->delete();
            } elseif ( $operation == 'insert' ) {
                $this->insert();
            } else {
                $this->showError("Wrong operation", "Page for operation '$operation' not found");
            }
        } catch ( \Exception $e ) {
            $this->showError( 'Application error', $e->getMessage() );
        }
    }

    private function insert() {
        try {
            $this->participant_service->insert();
            $this->redirect('?action=show');
        } catch (\Exception $e) {
            $this->showError( 'Application error', $e->getMessage() );
        }
    }

    public function delete() {
        $this->participant_service->delete();
        $this->redirect('?action=show');
    }

    public function showAll() {
        $title = 'Participants';
        $participants = $this->participant_service->getAll();

        include('view/participants.php');
    }

    private function redirect($location) {
        header('Location: ' . $location);
    }

    protected function showError($title, $message) {
        include ('view/error.php');
    }
}