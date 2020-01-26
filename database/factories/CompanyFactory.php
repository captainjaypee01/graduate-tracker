<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    $workIndustries = array('IT,BPO and Business Services', 'Manufacturing', 'Banking and Finance', 'Gaming', 'Other');
    $workSector = array('Government', 'Non-government');//randomElements($array = array ('a','b','c'), $count = 1) // array('c')
    return [
        "name" => $faker->company,
        "address" => $faker->address,
        "work_industry" => $faker->randomElement($workIndustries),
        "work_sector" => $faker->randomElement($workSector),
    ];
});

// $factory
//     ->state(Company::class, 'with_students', [])
//     ->afterCreatingState(Company::class, 'with_students', function ($company, $faker) {

//         factory(Student::class, $faker->numberBetween(3,10))->create([
//             'company_id' => $company->id, 
//             'work_sector' => $company->work_sector,
//             'work_industry' => $company->work_industry,
//         ]);
// });
    