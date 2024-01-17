<?php

namespace App\controller;

use App\services\participant\ParticipantService;

class ParticipantController extends BaseController
{
    public ParticipantService $service;

    public function __construct() {
        $this->service = new ParticipantService();
    }

    public function handleRequest(): void
    {
        $operation = $_GET['action'] ?? null;

        switch ($operation){
            case null:
            case 'show':
                $this->showList(); break;
            case 'insert':
                $this->fulfillList(); break;
            case 'delete':
                $this->deleteList(); break;
            case 'get':
                $this->getParticipants();break;
            case 'chart':
                $this->showChart(); break;
            default:
                $this->showError("Wrong operation", "Page for operation '$operation' not found"); break;
        }
    }

    protected function fulfillList(): void
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

    protected function getParticipants()
    {
        $participants = $this->service->getList('position');
        $result = json_encode($participants);
        echo $result;
    }

    protected function showChart()
    {
        $title = 'Chart';
        include ('view/chart.php');
    }

}