<?php

namespace App\services;

use App\config\Config;
use App\model\Participant;
use App\repos\ParticipantRepository;

class ParticipantService
{
    public ParticipantRepository $repo;

    public function __construct() {
        $this->repo= new ParticipantRepository();
    }

    public function fulfillListWithEntities(): void
    {
        foreach (ParticipantGeneratorService::getEntities(1, 100) as $i => $participant) {
            $participant->setEntityId($i);
            $this->setParentEntityFor($participant);
            $this->repo->insert($participant);
        }
        $this->setManagers();
        $this->repo->setVicePresident();
    }

    public function getList(string $filter = null): array
    {
        if($this->repo->selectCount() === 0) {
            $president = new Participant();
            $president->setParticipant((array)JsonParser::read("president.json"));
            $this->repo->insert($president);
        }
        return $this->repo->selectAll($filter);
    }

    public function clearList(): void
    {
        $this->repo->deleteAllBesidesOne();
    }

    private function setParentEntityFor(Participant $participant): void
    {
        $date = $participant->getStartDate();
        $parent = $this->repo->selectParent($date);
        while($parent === -1){
            $date = ParticipantGeneratorService::generateStartDate();
            $parent = $this->repo->selectParent($date);
        }
        if($date !== $participant->getStartDate()) { $participant->setStartDate($date); }
        $participant->setParentId($parent);
    }

    private function isManager($participant): bool
    {
        return $this->isJoinedLaterSixMonthsAgo($participant) && $this->isTotalSharesAmountMoreThan1000($participant);
    }

    private function isJoinedLaterSixMonthsAgo($participant): bool
    {
        $minus6month = strtotime("-6 Months");
        return $participant["start_date"] < $minus6month;
    }

    private function isTotalSharesAmountMoreThan1000($participant): bool
    {
        $shares_amount_first_level = $this->repo->selectSumOfSharesAmount($participant["parent"]);
        $shares_amount_second_level = 0;
        foreach ($this->repo->selectAllWhereParentIdIs($participant["parent"]) as $children) {
            $shares_amount_second_level += $this->repo->selectSumOfSharesAmount($children["entity_id"]);
        }
        $result = $participant["shares_amount"] + ($shares_amount_first_level) / 2 + ($shares_amount_second_level) / 3;
        return $result > 1000;
    }

    private function setManagers(): void
    {
        $candidates = $this->repo->selectAllWithMoreThan2Children();
        foreach ($candidates as $candidate) {
            if ($this->isManager($candidate)) {
                $this->repo->updatePositionWhereIdIs($candidate["parent"], Config::$POSITIONS[1]);
            }
        }
    }
}