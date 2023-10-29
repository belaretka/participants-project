<?php

namespace App\services;

class JsonParser implements IRead
{
    public static function read(string $filename)
    {
        $content = file_get_contents($filename);
        return json_decode($content);
    }
}