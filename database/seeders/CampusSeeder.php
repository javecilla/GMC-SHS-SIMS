<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampusSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('campuses')->insert([
            [
                'campus_name' => 'Golden Minds Colleges of Balagtas Bulacan Inc.',
                'campus_code' => 'GMC - BALAGTAS',
                'deped_school_id' => '404420',
                'shs_permit_no' => 'SHSP No. 667, s. 2016',
                'full_address' => '2nd-4th Flr. D&A Bldg. McArthur HW, San Juan, Balagtas, Bulacan',
                'contact_no' => '09325823875'
            ],
            [
                'campus_name' => 'Golden Minds Colleges of Sta.Maria Bulacan Inc.',
                'campus_code' => 'GMC - STA.MARIA',
                'deped_school_id' => '404468',
                'shs_permit_no' => 'SHSP No. 671, s. 2016',
                'full_address' => '2nd Flr. Megamart Bldg. Bypass Rd, Sta.Clara, Santa Maria, Bulacan',
                'contact_no' => null
            ],
            [
                'campus_name' => 'Golden Minds Colleges of Pandi Bulacan Inc.',
                'campus_code' => 'GMC - PANDI',
                'deped_school_id' => null,
                'shs_permit_no' => null,
                'full_address' => 'Bernando St. Gulod, Poblacion, Pandi, Bulacan',
                'contact_no' => null
            ],
        ]);
    }
}
