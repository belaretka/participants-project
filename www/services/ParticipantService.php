<?php

namespace App\services;

use App\model\Participant;
use App\repos\ParticipantRepository;

class ParticipantService
{
    public ParticipantRepository $participantRepository;

    public function __construct() {
        $this->participantRepository= new ParticipantRepository();
    }

    public function insert(): void
    {
        $this->insertAll();
    }

    public function insertAll(): void
    {
        foreach (GeneratorService::getParticipants(1, 100) as $i => $participant) {
            $participant->setEntityId($i);
            $this->setParent($participant);
            $this->participantRepository->insert($participant);
        }
        $this->setManagers();
        $this->participantRepository->setVicePresident();
    }

    public function getAll(): array
    {
        return $this->participantRepository->selectAll();
    }

    public function delete(): void
    {
        $this->participantRepository->deleteAllBesidesOne();
    }

    private function setParent(Participant $participant): void
    {
        $date = $participant->getStartDate();
        $parent = $this->participantRepository->selectParent($date);
        while($parent === -1){
            $date = GeneratorService::generateStartDate();
            $parent = $this->participantRepository->selectParent($date);
        }
        $participant->setStartDate($date);
        $participant->setParentId($parent);
    }

    private function isManager($participant): bool
    {
        return $this->isJoinedLaterSixMonthsAgo($participant) && $this->totalSharesAmountMoreThan1000($participant);
    }

    private function isJoinedLaterSixMonthsAgo($participant): bool
    {
        $minus6month = strtotime("-6 Months");
        return $participant["start_date"] < $minus6month;
    }

    private function totalSharesAmountMoreThan1000($participant): bool
    {
        $shares_amount_first_level = $this->participantRepository->selectSumOfSharesAmount($participant["parent"]);
        $shares_amount_second_level = 0;
        foreach ($this->participantRepository->selectAllWhereParentIdIs($participant["parent"]) as $children) {
            $shares_amount_second_level += $this->participantRepository->selectSumOfSharesAmount($children["entity_id"]);
        }
        $result = $participant["shares_amount"] + ($shares_amount_first_level) / 2 + ($shares_amount_second_level) / 3;
        return $result > 1000;
    }

    private function setManagers(): void
    {
        $candidates = $this->participantRepository->selectAllWithMoreThan2Children();
        foreach ($candidates as $candidate) {
            if ($this->isManager($candidate)) {
                $this->participantRepository->updatePosition($candidate["parent"]);
            }
        }
    }
}