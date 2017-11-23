<?php

$factory->define(Partymeister\Competitions\Models\OptionGroup::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(Partymeister\Competitions\Models\CompetitionType::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(Partymeister\Competitions\Models\Competition::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});
