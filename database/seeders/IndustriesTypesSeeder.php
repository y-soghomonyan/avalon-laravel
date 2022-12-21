<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class IndustriesTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('industries_types')->insert([
            'name'=>Str::random('10'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
