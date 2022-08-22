<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\Academy;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profiles.index', [
            'skills' => Skill::all(),
            'academies' => Academy::all()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $profile)
    {
        return view('profiles.show', [
            'user' => $profile,
            'skills' => Skill::all(),
            'academies' => Academy::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserProfileRequest $request, User $profile)
    {
        $imagePath = request('profile_picture')->store('uploads/profiles', 'public');
        File::delete(public_path('storage/' . $profile->profile_picture));

        $profile->name = $request->name;
        $profile->surname = $request->surname;
        $profile->biography = $request->biography;
        $profile->academy = $request->academy;
        $profile->profile_picture = $imagePath;
        $profile->completed = 1;

        $profile->save();

        $profile->skills()->sync($request->skill);

        return to_route('profile.index')->with(['status' => true, 'message' => 'Profile successfully updated']);
    }
}
