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
        $academies = ['Marketing', 'Frontend Development', 'Backend Development', 'Data Science', 'Design', 'QA', 'UX/UI'];

        foreach ($academies as $academy) {
            Academy::create(['name' => $academy]);
        }
    }
}
