<?php

namespace App\services;

interface IGeneratorService
{
    public static function generateEntity();
    public static function getEntities(int $start, int $limit, int $step = 1);
}
