<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials do not match.',
            ]);
        }

        request()->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'member') {
            return redirect('home');
        }

        if ($user->role === 'employer') {
            return redirect()->route('jobs.view-applicants');
        }
    }


    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
