<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\MyJob;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    use AuthorizesRequests;

    public function create(MyJob $job)
    {
        $this->authorize('apply',$job);
        return view('job_application.create', ['job'=>$job]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MyJob $job, Request $request)
    {
        $this->authorize('apply',$job);

        $validatedData = $request->validate([
            'expected_salary' => 'required|min:1|max:1000000',
            'cv' => 'required|file|mimes:pdf|max:2048'
        ]);

        $file = $request->file('cv');
        $path = $file->store('cvs','private');

        $job->jobApplications()->create([
            'user_id' => $request->user()->id,
            'expected_salary' => $validatedData['expected_salary'],
            'cv_path' => $path
        ]);

        return redirect()->route('jobs.show',$job)
            ->with('success', 'Job application Submitted Successfully !!');
    }

    public function downloadCV(JobApplication $application)
    {
        // Authorize that the current user can view the application
        $this->authorize('view', $application);

        // Check if the CV file exists
        if (Storage::disk('private')->exists($application->cv_path)) {
            return Storage::disk('private')->download($application->cv_path);
        }

        return redirect()->back()->with('error', 'CV file not found.');
    }


    public function destroy(string $id)
    {
        //
    }
}
