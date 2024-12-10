<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userAttributes = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(6)],
            'role' => ['required', 'in:employer,member'],
        ]);

        $user = User::create([
            'name' => $userAttributes['name'],
            'email' => $userAttributes['email'],
            'password' => bcrypt($userAttributes['password']),
            'role' => $userAttributes['role'],
        ]);

        if ($user->role === 'employer') {
            $employerAttributes = $request->validate([
                'employer' => ['required'],
                'logo' => ['required', File::types(['png', 'jpg', 'webp'])],
            ]);

            $logoPath = $request->file('logo')->store('logos');

            $user->employer()->create([
                'name' => $employerAttributes['employer'],
                'logo' => $logoPath,
            ]);
        }

        Auth::login($user);

        return redirect('/');
    }
}
