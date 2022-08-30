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

    public function filter(Request $request)
    {
        $projects = Project::with('profiles')
                        ->where('assembled', 0)
                        ->whereRelation('profiles', 'academy_id', '=', $request->academy_id)
                        ->latest()->paginate(8);

        if($request->ajax()){
            return view('components.project-filter', [
                'projects' => $projects,
                'skills' => Skill::all(),
                'academies' => Academy::all()
            ]);
        }
    }
}
