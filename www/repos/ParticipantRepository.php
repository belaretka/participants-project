<?php

namespace App\repos;

class ParticipantRepository
{
    public $conn;

    public function __construct()
    {
        $this->conn = Database::connect();
    }

    //insert

    //update

    //select all
    public function selectAll($table) {
        $sql = 'SELECT * FROM ' . $table;

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = array();
        while($obj = $stmt->fetch(\PDO::FETCH_OBJ)) {
            $result[] = $obj;
        }
        return $result;
    }

    //delete
    public function deleteAllBesidesOne($table) {
        $sql = 'DELETE FROM ' . $table . ' WHERE entity_id > 1; ALTER TABLE '. $table .' AUTO_INCREMENT = 2;';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }



}