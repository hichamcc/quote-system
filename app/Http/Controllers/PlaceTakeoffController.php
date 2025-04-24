<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\PlaceTakeoff;
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
        return view('place-takeoffs.create', compact('project'));
    }

    /**
     * Store the takeoffs for a project.
     */

    public function store(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'places' => 'required|array',
            'places.*' => 'required|string|max:255',
            'types' => 'nullable|array',
            'types.*' => 'nullable|string',
            'material_name' => 'nullable|array',
            'material_name.*' => 'nullable|string|max:255',
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

        $places = $request->input('places');
        $types = $request->input('types', []);
        
        foreach ($places as $key => $place) {
            $project->placeTakeoffs()->create([
                'place' => $place,
                'type' => $types[$key] ?? null,
                'material_name' => $request->input("material_name.$key"),
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
}