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

$factory->define(Partymeister\Competitions\Models\VoteCategory::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(Partymeister\Competitions\Models\Entry::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(Partymeister\Competitions\Models\AccessKey::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(Partymeister\Competitions\Models\CompetitionPrize::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(Partymeister\Competitions\Models\Vote::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});
