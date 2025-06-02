<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::create(['country_name' => 'Indonesia']);
        Country::create(['country_name' => 'Malaysia']);
        Country::create(['country_name' => 'Singapore']);
    }
}
