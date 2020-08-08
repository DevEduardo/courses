<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'name' => $faker->firstNameMale(),
        'lastName' => $faker->lastname(),
        'age' => 20,
        'email' => $faker->email()
    ];
});
