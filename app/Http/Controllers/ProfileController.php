<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        return view('profile.index', ['user' => $request->user()]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->update($request->validated());

        return Redirect::route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    // public function updatePassword(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     return Redirect::route('profile.edit')->with('success', 'Password changed successfully.');
    // }
}
