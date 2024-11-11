<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MyJobRequest;
use App\Models\MyJob;
use Illuminate\Http\Request;

class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAnyEmployer', MyJob::class);
        return view('my_job.index',
        [
            'jobs' => auth()->user()->employer
                ->jobs()
                ->with(['employer','jobApplications','jobApplications.user'])
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', MyJob::class);
        return view('my_job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MyJobRequest $request)
    {
        $this->authorize('create', MyJob::class);
        $validatedData = $request->validated();

        auth()->user()->employer->jobs()->create($validatedData);

        return redirect()->route('jobs.index')
            ->with('success','Job added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MyJob $myJob)
    {
        $this->authorize('update', $myJob);
        return view('my_job.edit',['myJob'=>$myJob]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MyJobRequest $request, MyJob $myJob)
    {
        $this->authorize('update', $myJob);

        $myJob->update($request->validated());
        return redirect()->route('my-jobs.index')
            ->with('success','Job Updated Successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
