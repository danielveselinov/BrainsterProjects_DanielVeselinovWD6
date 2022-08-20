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
        $academies = ['Frontend Development', 'Backend Development', 'Data Science', 'QA', 'Marketing', 'Design', 'UX/UI'];

        foreach ($academies as $academy) {
            Academy::create(['name' => $academy]);
        }
    }
}
