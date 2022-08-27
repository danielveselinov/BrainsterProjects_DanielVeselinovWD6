<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;

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

        return $request->academy_id;

        // $projects = Project::whereRaw('SELECT * FROM academy_project')

        // $projects = Project::with('academies')
        //             ->latest()
        //             ->where('assembled', 0)
        //             ->paginate(8);
    }
}
