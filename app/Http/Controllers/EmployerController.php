<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{

    public function __construct(){
        $this->authorizeResource(Employer::class);
    }

    public function create()
    {
        return view('employer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|min:3|unique:employers,company_name',
        ]);

        auth()->user()->employer()->create($validatedData);

        return redirect()->route('jobs.index')
            ->with('success','Your Employer Account Has Been Created');
    }

}
