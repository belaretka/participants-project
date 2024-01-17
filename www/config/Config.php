<?php

namespace App\config;

use App\services\JsonParser;

class Config
{
//    const DB_DRIVER = 'mysql';
//    const USER = 'root';
//    const PASSWORD = 'root';
//    const HOST = 'mysql1'; // '192.168.144.2'
//    const DB_NAME = 'project_db';
//    const CHARSET = 'utf8';
//    const TABLE = 'participants';
//    const NOVICE = 'novice';
//    const MAX_SHARES_AMOUNT = 500;
//    const START_DATE_OF_PRESIDENT = 1273449600;

    const filename = "data.json";

    public static $DB_DRIVER;
    public static $USER;
    public static $PASSWORD;
    public static $HOST; // '192.168.144.2'
    public static $DB_NAME;
    public static $CHARSET;
    public static $TABLE;
    public static $MAX_SHARES_AMOUNT;
    public static $START_DATE_OF_PRESIDENT;
    public static $POSITIONS;

    public static function load(): void
    {
        foreach (JsonParser::readJson(self::filename) as $key => $prop) {
            self::$$key=$prop;
        }
    }
}