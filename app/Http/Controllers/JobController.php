<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::latest()->with(['employer', 'tags'])->get()->groupBy('featured');

        return view('jobs.index', [
            'jobs' => $jobs[0],
            'featuredJobs' => $jobs[1],
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        if (Auth::user()->role !== 'employer') {
            abort(403, 'Unauthorized');
        }

        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required'],
            'salary' => ['required'],
            'location' => ['required'],
            'schedule' => ['required', Rule::in(['Part Time', 'Full Time'])],
            'url' => ['required', 'active_url'],
            'tags' => [
                'nullable',
                'regex:/^([a-zA-Z0-9]+(?:,[a-zA-Z0-9]+)*)?$/',
                'max:255',
            ],
        ]);

        $attributes['featured'] = $request->has('featured');

        try {
            $job = Auth::user()->employer->jobs()->create(Arr::except($attributes, 'tags'));

            if ($attributes['tags'] ?? false) {
                foreach (explode(',', $attributes['tags']) as $tag) {
                    $job->tag(trim($tag));
                }
            }

            return redirect()->route('jobs.view-applicants')->with('success', 'Job posted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to post job: ', $e->getMessage());
            return redirect()->back()->with('error', 'Failed to post the job. Please try again.');
        }
    }



    public function show()
    {
        if (Auth::user()->role !== 'employer') {
            abort(403, 'Unauthorized');
        }

        $employer = Auth::user()->employer;
        $jobs = $employer->jobs()->latest()->get();

        return view('jobs.show', compact('jobs'));
    }


    public function showApplicants(Job $job)
    {
        if (Auth::user()->role !== 'employer') {
            abort(403, 'Unauthorized');
        }

        $job->load('applications.user');

        return view('jobs.job-applicant', compact('job'));
    }

    public function destroy(Job $job)
    {
        if (Auth::user()->role !== 'employer') {
            abort(403, 'Unauthorized');
        }

        if ($job->employer_id !== Auth::user()->employer->id) {
            abort(403, 'Unauthorized');
        }

        if ($job->applications()->count() > 0) {
            return redirect()->route('jobs.view-applicants')->with('error', 'Cannot delete job. There are applicants for this job.');
        }

        try {
            $job->delete();
            return redirect()->route('jobs.view-applicants')->with('success', 'Job deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete job: ', $e->getMessage());
            return redirect()->route('jobs.view-applicants')->with('error', 'Failed to delete job. Please try again.');
        }
    }
}
