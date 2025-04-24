<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Sink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SinksController extends Controller
{
    /**
     * Display a listing of the sinks for a project.
     */
    public function index(Project $project)
    {
        $sinks = $project->sinks;
        return view('sinks.index', compact('project', 'sinks'));
    }

    /**
     * Show the form for creating a new sink.
     */
    public function create(Project $project)
    {
        return view('sinks.create', compact('project'));
    }

    /**
     * Store a newly created sink in storage.
     */
    public function store(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'sink_areas' => 'required|array',
            'sink_areas.*' => 'required|string|max:255',
            'brands' => 'required|array',
            'brands.*' => 'required|string|max:255',
            'models' => 'required|array',
            'models.*' => 'required|string|max:255',
            'prices' => 'required|array',
            'prices.*' => 'required|numeric|min:0',
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $sink_areas = $request->input('sink_areas');
        
        foreach ($sink_areas as $key => $sink_area) {
            $project->sinks()->create([
                'sink_area' => $sink_area,
                'brand' => $request->input("brands.$key"),
                'model' => $request->input("models.$key"),
                'price' => $request->input("prices.$key"),
                'quantity' => $request->input("quantities.$key"),
            ]);
        }

        return redirect()->route('projects.sinks.index', $project)
            ->with('success', 'Sinks added successfully.');
    }

    /**
     * Display the specified sinks for a project.
     */
    public function show(Project $project)
    {
        $sinks = $project->sinks()->get();
        return view('sinks.show', compact('project', 'sinks'));
    }

    /**
     * Show the form for editing the specified sink.
     */
    public function edit(Project $project, Sink $sink)
    {
        return view('sinks.edit', compact('project', 'sink'));
    }

    /**
     * Update the specified sink in storage.
     */
    public function update(Request $request, Project $project, Sink $sink)
    {
        $validator = Validator::make($request->all(), [
            'sink_area' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $sink->update($request->all());

        return redirect()->route('projects.sinks.index', $project)
            ->with('success', 'Sink updated successfully.');
    }

    /**
     * Remove the specified sink from storage.
     */
    public function destroy_single(Project $project, Sink $sink)
    {
        $sink->delete();

        return redirect()->route('projects.sinks.index', $project)
            ->with('success', 'Sink deleted successfully.');
    }

    /**
     * Remove all sinks for a project.
     */
    public function destroy(Project $project)
    {
        $project->sinks()->delete();

        return redirect()->route('projects.sinks.index', $project)
            ->with('success', 'All sinks deleted successfully.');
    }
}