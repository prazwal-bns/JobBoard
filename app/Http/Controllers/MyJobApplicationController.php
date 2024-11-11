<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\MyJob;
use Illuminate\Routing\Controller as RoutingController;

class MyJobApplicationController extends RoutingController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view(
            'my_job_application.index',
            [
                'applications' => auth()->user()->jobApplications()
                    ->with([
                        'job' => fn($query)=> $query->withCount('jobApplications')
                            ->withAvg('jobApplications','expected_salary'),
                        'job.employer'
                    ])
                    ->latest()->get()
            ]
        );
    }


    public function destroy(JobApplication $myJobApplication)
    {
        $myJobApplication->delete();
        return redirect()->back()
        ->with('success','Job Application Removed');
    }
}
