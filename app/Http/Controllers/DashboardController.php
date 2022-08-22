<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'projects' => Project::all(),
            'skills' => Skill::all(),
            'academies' => Academy::all()
        ]);
    }
}
