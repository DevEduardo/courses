<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    $time = $faker->time($format = 'H:i:s', $max = 'now') . 'a' . $faker->time($format = 'H:i:s', $max = 'now');
    return [
        'name' => $faker->sentence(),
        'schedule' => $time,
        'starDate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'endDate' => $faker->date($format = 'Y-m-d', $max = 'now')
    ];
});
