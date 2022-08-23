<?php

namespace Database\Seeders;

use App\Models\Academy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $academies = [
            'Marketing' => 'Marketer', 
            'Frontend Development' => 'Frontend Developer', 
            'Backend Development' => 'Backend Developer', 
            'Data Science' => 'Data Scientist', 
            'Design' => 'Designer', 
            'QA' => 'QA', 
            'UX/UI' => 'UX/UI Designer'
        ];

        foreach ($academies as $academy => $display) {
            Academy::create(['name' => $academy, 'display' => $display]);
        }
    }
}
