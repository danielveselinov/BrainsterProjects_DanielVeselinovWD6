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
        $projects = Project::latest()->paginate(8);

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
}
