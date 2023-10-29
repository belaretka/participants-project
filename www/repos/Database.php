<?php

namespace App\repos;

use App\Config;

class Database
{
    private static $conn = null;

    public static function connect() {
        if(self::$conn == null) {
            try {
                self::$conn = new \PDO( Config::$DB_DRIVER . ':host=' . Config::$HOST . ';dbname=' . Config::$DB_NAME . ';charset=' . Config::$CHARSET,
                    Config::$USER, Config::$PASSWORD);
                self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                die('Connection Error: ' . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
