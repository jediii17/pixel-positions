<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index()
    {
        $member = Auth::user()->member;

        return view('member.applied-jobs', [
            'appliedJobs' => $member->appliedJobs()->with('employer', 'tags')->get(),
        ]);
    }
}
