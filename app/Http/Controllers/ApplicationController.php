<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // take only project that user have applied for
        $projects = Project::all();

        dd($projects->applications);

        return view('applications.index', [
            'projects' => $projects
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

         $application = Application::create([
            'user_id' => Auth::id(),
            'project_id' => $request->project_id,
            'description' => $request->description
         ]);

        if($application) {
            // event(new InvitationEvent($user, $token));

            return response()->json('success');
        }

        return response()->json('error', 400);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Project $application)
    {
        if (Auth::id() != $application->user_id) {
            return to_route('projects.index');
        }

        return view('applications.show', [
            'projects' => $application
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        //
    }
}
