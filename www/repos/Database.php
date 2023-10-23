<?php

namespace App\repos;

class Database
{
    private static $conn = null;

    private static $db_driver = 'mysql';
    private static $user = 'root';
    private static $pass = 'root';
    private static $host = '192.168.144.2';
    private static $db = 'project_db';
    private static $charset = 'utf8';

    public static function connect() {
        if(self::$conn == null) {
            try {
                self::$conn = new \PDO(self::$db_driver . ':host=' . self::$host . ';dbname=' . self::$db . ';charset=' . self::$charset,
                    self::$user, self::$pass);
                self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                die('Connection Error: ' . $e->getMessage());
            }
        }
        return self::$conn;
    }
}