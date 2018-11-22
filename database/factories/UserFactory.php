<?php
use App\Applicant;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/


$factory->define(Applicant::class, function (Faker $faker) {
    $genderValue = rand(0, 1);
    ($genderValue == 0)? 'male' : 'female';
    return [
        'aID' => rand(50000, 59999),
        'name' => $faker->name($gender = $genderValue),
        'dateOfBirth' => $faker->dateTimeBetween($startDate = '-50 years', $endDate = '-20 years', $timezone = null),
        'country' => $faker->country
    ];
});
