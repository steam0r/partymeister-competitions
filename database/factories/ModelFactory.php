<?php

$factory->define(Partymeister\Competitions\Models\OptionGroup::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});
