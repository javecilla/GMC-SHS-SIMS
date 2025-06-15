<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolYearSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('school_years')->insert([
            [
                'school_year_name' => '2010-2011',
                'is_current' => false
            ],
            [
                'school_year_name' => '2011-2012',
                'is_current' => false
            ],
            [
                'school_year_name' => '2012-2013',
                'is_current' => false
            ],
            [
                'school_year_name' => '2013-2014',
                'is_current' => false
            ],
            [
                'school_year_name' => '2014-2015',
                'is_current' => false
            ],
            [
                'school_year_name' => '2015-2016',
                'is_current' => false
            ],
            [
                'school_year_name' => '2016-2017',
                'is_current' => false
            ],
            [
                'school_year_name' => '2017-2018',
                'is_current' => false
            ],
            [
                'school_year_name' => '2018-2019',
                'is_current' => false
            ],
            [
                'school_year_name' => '2019-2020',
                'is_current' => false
            ],
            [
                'school_year_name' => '2020-2021',
                'is_current' => false
            ],
            [
                'school_year_name' => '2021-2022',
                'is_current' => false
            ],
            [
                'school_year_name' => '2022-2023',
                'is_current' => false
            ],
            [
                'school_year_name' => '2023-2024',
                'is_current' => false
            ],
            [
                'school_year_name' => '2024-2025',
                'is_current' => false
            ],
            [
                'school_year_name' => '2025-2026',
                'is_current' => true
            ],
        ]);
    }
}
