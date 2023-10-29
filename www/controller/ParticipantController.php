<?php

namespace App\controller;

use App\services\ParticipantService;

class ParticipantController
{
    public ParticipantService $service;

    public function __construct() {
        $this->service = new ParticipantService();
    }

    public function handleRequest(): void
    {
        $operation = isset( $_GET['action'] ) ? $_GET['action'] : null;

        switch ($operation){
            case null:
            case 'show':
                $this->showList(); break;
            case 'insert':
                $this->fulfillList(); break;
            case 'delete':
                $this->deleteList(); break;
            default:
                $this->showError("Wrong operation", "Page for operation '$operation' not found"); break;
        }
    }

    private function fulfillList(): void
    {
        try {
            $this->service->fulfillListWithEntities();
            $this->redirect('?action=show');
        } catch (\Exception $e) {
            $this->showError( 'Application error', $e->getMessage() );
        }
    }

    public function deleteList(): void
    {
        $this->service->clearList();
        $this->redirect('?action=show');
    }

    public function showList(): void
    {
        $title = 'Participants';
        $participants = $this->service->getList();

        include('view/participants.php');
    }

    private function redirect($location): void
    {
        header('Location: ' . $location);
    }

    protected function showError($title, $message): void
    {
        include ('view/error.php');
    }
}