<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StrandSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('strands')->insert([
            [
                'strand_name' => 'Accountancy, Business and Management',
                'strand_code' => 'ABM',
                'strand_description' => 'Focuses on developing foundational knowledge and skills in accounting, business management, and entrepreneurship. Students learn financial literacy, business operations, and management principles, preparing them for careers in accountancy, finance, marketing, and business administration or for pursuing entrepreneurial ventures.'
            ],
            [
                'strand_name' => 'Humanities and Social Sciences',
                'strand_code' => 'HUMSS',
                'strand_description' => 'Emphasizes the study of human behavior, society, and culture through subjects like history, philosophy, literature, and social sciences. It hones critical thinking, communication, and research skills, preparing students for careers in education, law, journalism, psychology, and public service.'
            ],
            [
                'strand_name' => 'Science, Technology, Engineering and Mathematics',
                'strand_code' => 'STEM',
                'strand_description' => 'Centers on advanced study in science, mathematics, technology, and engineering principles. It develops problem-solving, analytical, and technical skills, preparing students for careers in engineering, medicine, computer science, research, and other STEM-related fields.'
            ],
            [
                'strand_name' => 'General Academic Strand',
                'strand_code' => 'GAS',
                'strand_description' => 'Offers a flexible curriculum combining subjects from various strands, allowing students to explore diverse academic interests. It develops critical thinking, communication, and general academic skills, suitable for students still deciding on a career path or pursuing broad-based college programs.'
            ],
            [
                'strand_name' => 'Technical-Vocational-Livelihood Home Economics',
                'strand_code' => 'TVL-HE',
                'strand_description' => 'Focuses on practical skills in home economics fields such as culinary arts, caregiving, and hospitality management. It equips students with hands-on expertise for immediate employment in industries like tourism, food service, and wellness or for further vocational training.'
            ],
            [
                'strand_name' => 'Technical-Vocational-Livelihood Information and Communications Technology',
                'strand_code' => 'TVL-ICT',
                'strand_description' => 'Concentrates on technical skills in information technology, computer programming, and digital communication. It prepares students for careers in software development, network administration, web design, and other ICT-related fields or for further technical education.'
            ],
        ]);
    }
}
