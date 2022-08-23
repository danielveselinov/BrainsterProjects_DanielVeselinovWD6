<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Models\Academy;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('projects.index', [
            'projects' => Project::where('user_id', Auth::id())->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create', [
            'academies' => Academy::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectStoreRequest $request)
    {
        $project = Project::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description
        ]);

        $project->profiles()->sync($request->academy);

        return to_route('projects.index')->with(['status' => true, 'message' => 'Project successfully created']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        if (Auth::id() != $project->user_id) {
            return to_route('projects.index')->with(['status' => true, 'message' => 'Can\'t edit someone else\'s project']);
        }
        
        return view('projects.edit', [
            'project' => $project,
            'academies' => Academy::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectStoreRequest $request, Project $project)
    {
        if (Auth::id() != $project->user_id) {
            return to_route('projects.index')->with(['status' => true, 'message' => 'Can\'t update someone else\'s project']);
        }

        $project->user_id = Auth::id();
        $project->name = $request->name;
        $project->description = $request->description;

        $project->save();
        
        $project->profiles()->sync($request->academy);

        return to_route('projects.index')->with(['status' => true, 'message' => 'Project successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if (Auth::id() != $project->user_id) {
            return to_route('projects.index')->with(['status' => true, 'message' => 'Can\'t delete someone else\'s project']);
        }

        $project->profiles()->detach($project->profiles);

        $project->delete();

        return to_route('projects.index')->with(['status' => true, 'message' => 'Project successfully deleted']);
    }
}
