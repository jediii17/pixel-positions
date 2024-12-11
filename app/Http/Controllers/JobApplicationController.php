<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class JobApplicationController extends Controller
{
    public function show()
    {
        if (Auth::user()->role !== 'member') {
            abort(403, 'Unauthorized');
        }

        $applications = JobApplication::with('job')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('member.appliedJobs', ['applications' => $applications]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Job $job)
    {

        return view('member.apply', ['job' => $job]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Job $job)
    {
        try {
            $validated = $request->validate([
                'resume' => 'required|mimes:pdf,docx|max:10240',
                'title' => 'required|string',
                'company' => 'required|string',
            ]);

            $resumePath = $request->file('resume')->store('resumes', 'public');

            JobApplication::create([
                'user_id' => Auth::id(),
                'job_id' => $job->id,
                'resume' => $resumePath,
                'title' => $validated['title'],
                'company' => $validated['company'],
            ]);

            return redirect()->route('home')->with('success', 'Job application submitted successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('')->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function updateStatus(Request $request, JobApplication $application)
    {
        if (Auth::user()->role !== 'employer') {
            abort(403, 'Unauthorized');
        }

        $job = $application->job;

        $employerUserId = $job->employer->user_id;

        if (Auth::id() !== $employerUserId) {
            return redirect()->back()->with('error', 'Unauthorized access attempt.');
        }

        $application->status = $request->status;

        if ($application->save()) {
            return redirect()->back()->with('success', "Status updated to {$application->status}.");
        }

        return redirect()->back()->with('error', 'Failed to update status.');
    }
}
