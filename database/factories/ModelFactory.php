<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
    ];
});

$factory->define(App\GasReading::class, function (Faker\Generator $faker) {
    return [
        'user_id' => ($user = App\User::inRandomOrder()->first()) ? $user->id : factory(App\User::class)->create()->id,
        'date' => $faker->date(),
        'state' => $faker->randomFloat(2, 0, 9999999, 99),
        'fixed_usage' => $faker->boolean(),
        'usage' => $faker->randomFloat(2, 0, 9999999, 99),
    ];
});
