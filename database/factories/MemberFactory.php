<?php

$factory->define(App\Member::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,

        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->randomNumber(8, true),
        'qq' => $faker->randomNumber(8, true),
        'GitTq' => $faker->word(),
        'GitHub' => $faker->word(),
        'stdId' => $faker->randomNumber(8, true),
        'department' => $faker->word(),
        'grade' => 'F00',
        'birthday' => $faker->date(),
        'gender' => rand(0, 2),
        'QA' => $faker->word(),
        'nickname' => $faker->word(),
        'remark' => $faker->text(20)
    ];
});

