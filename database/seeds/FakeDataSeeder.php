<?php

use App\Models\BackpackUser;
use App\Models\Company;
use App\Models\School;
use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class FakeDataTableSeeder extends Seeder
{
    public function run()
    {
        factory(School::class, 10)->create();
        factory(Company::class, 10)->create();
        factory(BackpackUser::class, 200)->states('student')->create();
    }
}
