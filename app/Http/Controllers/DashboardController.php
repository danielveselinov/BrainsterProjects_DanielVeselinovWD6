<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::latest()->where('assembled', 0)->paginate(8);

        if($request->ajax()){
            return view('components.project-sandbox', [
                'projects' => $projects,
                'skills' => Skill::all(),
                'academies' => Academy::all()
            ]);
        } else {
            return view('dashboard.index', [
                'projects' => $projects,
                'skills' => Skill::all(),
                'academies' => Academy::all()
            ]);
        }  
    }

    // when send data to this func,in ajax load from components..
    public function filter(Request $request)
    {

        //SELECT `projects`.*, `academy_project`.`academy_id`, `academy_project`.`project_id` FROM `projects` JOIN `academy_project` ON `projects`.`id` = `academy_project`.`project_id` JOIN `academies` on `academy_project`.`academy_id` = `academies`.`id` WHERE `academy_project`.`academy_id` = 2

        $projects = Project::all();
        
        

        // return $projects->profiles;

        // if($request->ajax()){
        //     return view('components.project-filter', [
        //         'projects' => $projects,
        //         'skills' => Skill::all(),
        //         'academies' => Academy::all()
        //     ]);
        // }
    }
}
