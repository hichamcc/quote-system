<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $projects = Project::query()
            ->with('user')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('customer', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('architect', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
            
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        $users = User::where('role', 'customer')->get();
        return view('projects.create', compact('users'));
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request)
    {
        $request->merge(['user_id' => auth()->id()]);

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'customer' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'attention' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'architect' => 'nullable|string|max:255',
            'bid_date' => 'nullable|date',
            'plan_date' => 'nullable|date',
            'date_accepted' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Project::create($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified project.
     */
    public function show(Project $project)
    {
        //$project->load('user', 'placeTakeoff', 'measuringTemplate', 'materials', 'fabrication', 'installationLabor', 'settingMaterial');
        $project->load('user');
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project)
    {
        $users = User::where('role', 'customer')->get();
        return view('projects.edit', compact('project', 'users'));
    }

    /**
     * Update the specified project in storage.
     */
    public function update(Request $request, Project $project)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'customer' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'attention' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'architect' => 'nullable|string|max:255',
            'bid_date' => 'nullable|date',
            'plan_date' => 'nullable|date',
            'date_accepted' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $project->update($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}