<?php

namespace App\services;

use App\model\Participant;
use Faker\Factory;

class GeneratorService
{
    const NOVICE = 'novice';
    const MAX_SHARES_AMOUNT = 500;
    const START_DATE_OF_PRESIDENT = 1273449600;

    public static function generateEntity(): Participant
    {
        $faker = Factory::create('en_US');

        $firstname = $faker->firstName;
        $lastname = $faker->lastName;
        if(str_starts_with($lastname, '*\'') ) {
            $lastname = str_replace('*\'', '', $lastname);
        }

        $email = strtolower($firstname . '_' . $lastname). '@' .$faker->safeEmailDomain;
        return new Participant($firstname, $lastname, $email, self::NOVICE,
            $faker->numberBetween(1, self::MAX_SHARES_AMOUNT),
            $faker->numberBetween(self::START_DATE_OF_PRESIDENT, strtotime("-1 day")));
    }

    public static function generateStartDate(): int
    {
        $faker = Factory::create('en_US');
        return $faker->numberBetween(self::START_DATE_OF_PRESIDENT, strtotime("-1 day"));
    }

    public static function getParticipants(int $start, int $limit, int $step = 1): \Generator
    {
        for ($i = $start; $i < $limit; $i+=$step) {
            yield $i => self::generateEntity();
        }
    }

}