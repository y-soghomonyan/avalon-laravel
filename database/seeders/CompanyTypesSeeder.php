<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyTypes;

class CompanyTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanyTypes::factroy()->count(20)->create();
    }
}
