<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'projects' => Project::latest()->get(),
            'skills' => Skill::all(),
            'academies' => Academy::all()
        ]);
    }
}
