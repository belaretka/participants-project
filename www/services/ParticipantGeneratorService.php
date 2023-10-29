<?php

namespace App\services;

use App\Config;
use App\model\Participant;
use Faker\Factory;

class ParticipantGeneratorService implements IGeneratorService
{
    public static function generateEntity(): Participant
    {
        $faker = Factory::create('en_US');

        $firstname = $faker->firstName;
        $lastname = $faker->lastName;
        if(str_starts_with($lastname, '*\'') ) {
            $lastname = str_replace('*\'', '', $lastname);
        }

        $email = strtolower($firstname . '_' . $lastname). '@' .$faker->safeEmailDomain;
        return new Participant($firstname, $lastname, $email, Config::$POSITIONS[0],
            $faker->numberBetween(1, Config::$MAX_SHARES_AMOUNT),
            $faker->numberBetween(Config::$START_DATE_OF_PRESIDENT, strtotime("-1 day")));
    }

    public static function generateStartDate(): int
    {
        $faker = Factory::create('en_US');
        return $faker->numberBetween(Config::$START_DATE_OF_PRESIDENT, strtotime("-1 day"));
    }

    public static function getEntities(int $start, int $limit, int $step = 1): \Generator
    {
        for ($i = $start; $i < $limit; $i+=$step) {
            yield $i => self::generateEntity();
        }
    }
}
