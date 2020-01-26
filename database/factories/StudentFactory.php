<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    $degree = array('Senior High School', 'College Degree', 'Master\'s Degree', 'Doctorate Degree');
    $employment_status = array("Regular", 'Contractual', 'Temporary', 'Self-employed','Unemployed');
    $gender = array('male', 'female');
    $job_roles = array('executive', 'manager', 'supervisor','entry level', 'internship');
    $workPlace = array('overseas', 'non-overseas');
    $job_length = $faker->numberBetween(0, 11);
    $year_graduated = now()->year - $job_length;
    return [ 
        'year_graduated' => $year_graduated,
        'birthday' => $faker->date('Y-m-d', now()),
        'degree' => $faker->randomElement($degree),
        'employment_status' => $faker->randomElement($employment_status),
        'gender' => $faker->randomElement($gender),
        'job_role' => $faker->randomElement($job_roles),
        'job_position' => $faker->jobTitle,
        'job_length' => $job_length,
        'work_place' => $faker->randomElement($workPlace),
    ];
});

