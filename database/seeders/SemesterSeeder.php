<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('semesters')->insert([
            [
                'semester_name' => '1st Semester',
                'semester_code' => '1st'
            ],
            [
                'semester_name' => '2nd Semester',
                'semester_code' => '2nd'
            ],
        ]);
    }
}
