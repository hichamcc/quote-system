<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\PlaceTakeoff;
use App\Models\AreaType;
use App\Models\Top;
use App\Models\Backsplash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlaceTakeoffController extends Controller
{
    /**
     * Show the form for creating takeoffs for a project.
     */
    public function create(Project $project)
    {
        $areaTypes = AreaType::latest()->get();

        return view('place-takeoffs.create', compact('project','areaTypes'));
    }

    /**
     * Store the takeoffs for a project.
     */

    public function store(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'amg_job_numbers' => 'nullable|array',
            'amg_job_numbers.*' => 'nullable|string|max:255',
            'types' => 'nullable|array',
            'types.*' => 'nullable|string',
            'material_name' => 'nullable|array',
            'material_name.*' => 'nullable|string|max:255',
            'material_price' => 'nullable|array',
            'material_price.*' => 'nullable|numeric|min:0',
            'supplier' => 'nullable|array',
            'supplier.*' => 'nullable|string|max:255',
            'area' => 'nullable|array',
            'area.*' => 'nullable|string|max:255',
            'piece_number' => 'nullable|array',
            'piece_number.*' => 'nullable|string|max:255',
            'length' => 'nullable|array',
            'length.*' => 'nullable|numeric',
            'width' => 'nullable|array',
            'width.*' => 'nullable|numeric',
            'polished_edge_length' => 'nullable|array',
            'polished_edge_length.*' => 'nullable|numeric',
            'miter_edge_length' => 'nullable|array',
            'miter_edge_length.*' => 'nullable|numeric',
            'sink_cutout' => 'nullable|array',
            'sink_cutout.*' => 'nullable|integer',
            'cooktop_cutout' => 'nullable|array',
            'cooktop_cutout.*' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $amg_job_numbers = $request->input('amg_job_numbers');
        $types = $request->input('types', []);
        
        foreach ($amg_job_numbers as $key => $job) {
            if(!$job)
            $job = "--";
            $project->placeTakeoffs()->create([
                'amg_job_number' => $job,
                'type' => $types[$key] ?? null,
                'material_name' => $request->input("material_name.$key"),
                'material_price' => $request->input("material_price.$key"),  
                'supplier' => $request->input("supplier.$key"),
                'area' => $request->input("area.$key"),
                'piece_number' => $request->input("piece_number.$key"),
                'length' => $request->input("length.$key"),
                'width' => $request->input("width.$key"),
                'polished_edge_length' => $request->input("polished_edge_length.$key"),
                'miter_edge_length' => $request->input("miter_edge_length.$key"),
                'sink_cutout' => $request->input("sink_cutout.$key"),
                'cooktop_cutout' => $request->input("cooktop_cutout.$key"),
            ]);
        }

        return redirect()->route('projects.show', $project)
            ->with('success', 'Place takeoffs added successfully.');
    }


    public function edit(Project $project, PlaceTakeoff $takeoff)
{
    // Ensure the takeoff belongs to the given project
    if ($takeoff->project_id !== $project->id) {
        return redirect()->route('projects.takeoffs.show', $project)
            ->with('error', 'The specified takeoff does not belong to this project.');
    }

    $areaTypes = AreaType::latest()->get();


    return view('place-takeoffs.edit', [
        'project' => $project,
        'placeTakeoff' => $takeoff,
        'areaTypes'=> $areaTypes
    ]);
}


    /**
 * Update the specified place takeoff in storage.
 */
public function update(Request $request, Project $project, PlaceTakeoff $takeoff)
{

    $validator = Validator::make($request->all(), [
        'amg_job_number' => 'nullable|string|max:255',
        'type' => 'nullable|string|in:Kitchen,Bathroom,Master Bath,Common Area',
        'material_name' => 'nullable|string|max:255',
        'material_price' => 'nullable|numeric|min:0',
        'supplier' => 'nullable|string|max:255',
        'area' => 'nullable|string|max:255',
        'piece_number' => 'nullable|string|max:255',
        'length' => 'nullable|numeric',
        'width' => 'nullable|numeric',
        'polished_edge_length' => 'nullable|numeric',
        'miter_edge_length' => 'nullable|numeric',
        'sink_cutout' => 'nullable|integer',
        'cooktop_cutout' => 'nullable|integer',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    if(!$request->amg_job_number)
        $request->amg_job_number = "--";


    $takeoff->update([
        'amg_job_number' => $request->amg_job_number,
        'type' => $request->type,
        'material_name' => $request->material_name,
        'material_price' => $request->material_price, 
        'supplier' => $request->supplier,
        'area' => $request->area,
        'piece_number' => $request->piece_number,
        'length' => $request->length,
        'width' => $request->width,
        'polished_edge_length' => $request->polished_edge_length,
        'miter_edge_length' => $request->miter_edge_length,
        'sink_cutout' => $request->sink_cutout,
        'cooktop_cutout' => $request->cooktop_cutout,
    ]);

    return redirect()->route('projects.takeoffs.show', $project)
        ->with('success', 'Place takeoff updated successfully.');
}

        /**
         * Display the specified takeoffs for a project.
         */
        public function show(Project $project)
        {
            $placeTakeoffs = $project->placeTakeoffs()->get();
            return view('place-takeoffs.show', compact('project', 'placeTakeoffs'));
        }
    /**
     * Remove all takeoffs for a project.
     */
    public function destroy(Project $project)
    {
        $project->placeTakeoffs()->delete();
        return redirect()->route('projects.show', $project)
            ->with('success', 'All Place Takeoffs deleted successfully.');
    }

    public function destroy_single(Project $project, PlaceTakeoff $takeoff)
        {
            // Ensure the takeoff belongs to the given project
            if ($takeoff->project_id !== $project->id) {
                return redirect()->route('projects.takeoffs.show', $project)
                    ->with('error', 'The specified takeoff does not belong to this project.');
            }

            // Delete the takeoff
            $takeoff->delete();

            // Redirect back with success message
            return redirect()->route('projects.takeoffs.show', $project)
                ->with('success', 'Takeoff deleted successfully.');
        }
}