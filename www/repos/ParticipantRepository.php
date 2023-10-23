<?php

namespace App\repos;

use App\model\Participant;

class ParticipantRepository
{
    public $conn;
    private static $table = 'participants';

    public function __construct()
    {
        $this->conn = Database::connect();
    }

    public function insert(Participant $participant) {
        $sql = 'INSERT INTO '. self::$table . ' ( firstname, lastname, email, position, shares_amount, start_date, parent_id) 
        VALUES (:firstname, :lastname, :email, :position, :shares_amount, :start_date, :parent_id)';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':firstname', $participant->getFirstname());
        $stmt->bindValue(':lastname', $participant->getLastname());
        $stmt->bindValue(':email', $participant->getEmail());
        $stmt->bindValue(':position', $participant->getPosition());
        $stmt->bindValue(':shares_amount', $participant->getSharesAmount());
        $stmt->bindValue(':start_date', $participant->getStartDate());
        $stmt->bindValue(':parent_id', $participant->getParentId());
        $stmt->execute();
    }

    public function setVicePresident(): void
    {
        $position = 'vice president';
        $id = $this->getCandidateForVicePresident();
        $sql = 'UPDATE ' . self::$table  . ' SET position = :position WHERE entity_id = :id;';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":position", $position);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    public function getCandidateForVicePresident() {
        $sql = 'SELECT entity_id FROM '
            . self::$table . ' WHERE parent_id = 1 AND shares_amount = (SELECT MAX(shares_amount) FROM '
            . self::$table  . ' WHERE parent_id = 1);';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC)["entity_id"];
    }

    public function selectAll() {
        $sql = 'SELECT * FROM ' . self::$table ;

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\model\Participant');
    }

    public function deleteAllBesidesOne() {
        $sql = 'DELETE FROM ' . self::$table  . ' WHERE entity_id > 1; ALTER TABLE '. self::$table  .' AUTO_INCREMENT = 2;';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function selectSumOfSharesAmount(int $entityId)
    {
        $sql = 'SELECT SUM(shares_amount) FROM ' . self::$table . ' WHERE parent_id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $entityId);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC)["SUM(shares_amount)"];
    }

    public function selectParent(int $date)
    {
        $sql = 'SELECT entity_id AS parent, 
                       start_date, 
                       (SELECT COUNT(entity_id) FROM ' . self::$table . ' WHERE parent_id = parent) AS affiliates_num
                FROM ' . self::$table . ' 
                WHERE start_date < :date
                ORDER BY affiliates_num, parent DESC, start_date';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':date', $date);
        $stmt->execute();

        $candidates = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($candidates as $item) {
            if($item["affiliates_num"] < 2)  {
                $parent = $item["parent"];
                break;
            }
            if($item["affiliates_num"] < 4 && !isset($parent))  {
                $parent = $item["parent"];
            }
        }

        return isset($parent) ? $parent : -1;
    }

    public function selectAllWhereParentIdIs(int $id) {
        $sql = 'SELECT entity_id FROM ' . self::$table . ' WHERE parent_id = :id';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updatePosition(int $id)
    {
        $position = 'manager';
        $sql = 'UPDATE ' . self::$table  . ' SET position = :position WHERE entity_id = :id;';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":position", $position);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    public function selectAllWithMoreThan2Children()
    {
        $sql = 'SELECT entity_id AS parent,
                        start_date,
                        shares_amount,
                    (SELECT COUNT(entity_id) FROM ' . self::$table . ' WHERE parent_id = parent) AS affiliates 
                FROM ' . self::$table . ' 
                WHERE position = :position 
                ORDER BY affiliates DESC;';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":position", "novice");
        $stmt->execute();
        $candidates = array();
        while($obj = $stmt->fetch(\PDO::FETCH_ASSOC)){
            if($obj["affiliates"] < 3) {
                break;
            }
            $candidates[] = $obj;
        }
        return $candidates;
    }
}