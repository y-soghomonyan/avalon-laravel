<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IndustriesTypes;

class IndustriesTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IndustriesTypes::factroy()->count(20)->create();
    }
}
