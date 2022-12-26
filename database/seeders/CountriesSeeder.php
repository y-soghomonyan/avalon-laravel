<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $countries = [
        'Cyprus',
        'Netherlands',
        'Switzerland',
        'United States',
        'United Kingdom',
    ];

    public function run()
    {
        foreach ($this->countries as $country){
            DB::table('countries')->insert([
                'name' => $country,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
