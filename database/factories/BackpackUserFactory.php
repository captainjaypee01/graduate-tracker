<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BackpackUser;
use App\Models\Company;
use App\Models\School;
use App\Models\Student;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(BackpackUser::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory
    ->state(BackpackUser::class, 'student', [])
    ->afterCreatingState(BackpackUser::class, 'student', function ($user, $faker) {
        $user->assignRole('student');

        $company = Company::all()->random();
        $school = School::all()->random();
        factory(Student::class)->create([
            'name' => $user->name,
            'user_id' => $user->id,
            'school_id' => $school->id,
            'company_id' => $company->id, 
            'work_sector' => $company->work_sector,
            'work_industry' => $company->work_industry,
        ]);
    });