<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YearLevelSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('year_levels')->insert([
            [
                'year_level_name' => 'Grade 11',
                'year_level_code' => 'G11',
                'level_order' => 11
            ],
            [
                'year_level_name' => 'Grade 12',
                'year_level_code' => 'G12',
                'level_order' => 12
            ],
        ]);
    }
}
