<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('applications.index', [
            'applications' => Application::where('user_id', Auth::id())->latest()->get()
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

    public function update(Request $request)
    {
        DB::table('projects')
                        ->where('id', '=', $request->application)
                        ->update(['assembled' => 1]);
        
        DB::table('applications')
                        ->whereIn('user_id', ...[$request->applicantArr])
                        ->where('project_id', '=', $request->application)
                        ->update(['accepted' => 1]);

        DB::table('applications')
                        ->whereNotIn('user_id', ...[$request->applicantArr])
                        ->where('project_id', '=', $request->application)
                        ->update(['accepted' => 0]);


        return response()->json(['auth' => true, 'message' => 'Team successfully assembled']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        if (Auth::id() != $application->user_id) {
            return to_route('applications.index')->with(['status' => true, 'message' => 'Can\'t delete someone else\'s application']);
        }

        $application->delete();

        return to_route('applications.index')->with(['status' => true, 'message' => 'Application successfully deleted']);
    }
}
