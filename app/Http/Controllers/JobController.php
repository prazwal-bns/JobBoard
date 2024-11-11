<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MyJob;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', MyJob::class);
        $filters = request()->only(
            'search',
            'min_salary',
            'max_salary',
            'experience',
            'category'
        );

        $jobs = MyJob::with('employer')->latest()->filter($filters)->get();


        return view('job.index', ['jobs' => $jobs]);
    }


    public function show(MyJob $job)
    {
        $this->authorize('view',$job);
        return view('job.show', ['job'=> $job->load('employer.jobs')]);
    }


}
