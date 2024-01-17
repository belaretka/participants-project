<?php

namespace App\services\generator;

interface IGeneratorService
{
    public static function generateEntity(int $id);
    public static function getEntities(int $start, int $limit, int $step = 1);
}
