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
        // Validate the basic data
        $validator = Validator::make($request->all(), [
            'places' => 'required|array|min:1',
            'places.*' => 'required|string|max:255',
            'has_top' => 'nullable|array',
            'has_backsplash' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Process each place takeoff
        foreach ($request->places as $index => $place) {
            // Create the place takeoff
            $placeTakeoff = $project->placeTakeoffs()->create([
                'place' => $place,
            ]);

            // Create top if selected
            if (isset($request->has_top[$index]) && $request->has_top[$index] == '1') {
                $topData = [
                    'elevation' => $request->top_elevation[$index] ?? null,
                    'detail' => $request->top_detail[$index] ?? null,
                    'area' => $request->top_area[$index] ?? null,
                    'color' => $request->top_color[$index] ?? null,
                    'supplier_brand' => $request->top_supplier_brand[$index] ?? null,
                    'type' => $request->top_type[$index] ?? null,
                    'unit_qty' => $request->top_unit_qty[$index] ?? null,
                    'thickness' => $request->top_thickness[$index] ?? null,
                    'length_inches' => $request->top_length_inches[$index] ?? null,
                    'width_inches' => $request->top_width_inches[$index] ?? null,
                    'sqft_per_unit' => $request->top_sqft_per_unit[$index] ?? null,
                    'total_sqft_counter_top' => $request->top_total_sqft_counter_top[$index] ?? null,
                    'polished_edge_inches' => $request->top_polished_edge_inches[$index] ?? null,
                    'polished_edge_lnft' => $request->top_polished_edge_lnft[$index] ?? null,
                    'total_pol_edge_lnft' => $request->top_total_pol_edge_lnft[$index] ?? null,
                    'lmnt_mtr_edge_inches' => $request->top_lmnt_mtr_edge_inches[$index] ?? null,
                    'lmnt_mtr_edge_lnft' => $request->top_lmnt_mtr_edge_lnft[$index] ?? null,
                    'total_lmn_mtr_edge_lnft' => $request->top_total_lmn_mtr_edge_lnft[$index] ?? null,
                    'num_of_sinks_per_unit' => $request->top_num_of_sinks_per_unit[$index] ?? null,
                    'total_sinks_per_unit' => $request->top_total_sinks_per_unit[$index] ?? null,
                    'num_of_cook_tops_per_unit' => $request->top_num_of_cook_tops_per_unit[$index] ?? null,
                ];
                
                $placeTakeoff->tops()->create($topData);
            }

            // Create backsplash if selected
            if (isset($request->has_backsplash[$index]) && $request->has_backsplash[$index] == '1') {
                $backsplashData = [
                    'elevation' => $request->backsplash_elevation[$index] ?? null,
                    'detail' => $request->backsplash_detail[$index] ?? null,
                    'area' => $request->backsplash_area[$index] ?? null,
                    'color' => $request->backsplash_color[$index] ?? null,
                    'supplier_brand' => $request->backsplash_supplier_brand[$index] ?? null,
                    'type' => $request->backsplash_type[$index] ?? null,
                    'unit_qty' => $request->backsplash_unit_qty[$index] ?? null,
                    'thickness' => $request->backsplash_thickness[$index] ?? null,
                    'length_inches' => $request->backsplash_length_inches[$index] ?? null,
                    'width_inches' => $request->backsplash_width_inches[$index] ?? null,
                    'sqft_per_unit' => $request->backsplash_sqft_per_unit[$index] ?? null,
                    'total_sqft_counter_top' => $request->backsplash_total_sqft_counter_top[$index] ?? null,
                    'polished_edge_inches' => $request->backsplash_polished_edge_inches[$index] ?? null,
                    'polished_edge_lnft' => $request->backsplash_polished_edge_lnft[$index] ?? null,
                    'total_pol_edge_lnft' => $request->backsplash_total_pol_edge_lnft[$index] ?? null,
                ];
                
                $placeTakeoff->backsplashes()->create($backsplashData);
            }
        }

        return redirect()->route('projects.show', $project)
            ->with('success', 'Place Takeoffs added successfully.');
    }

    /**
     * Display the specified takeoffs for a project.
     */
    public function show(Project $project)
    {
        $placeTakeoffs = $project->placeTakeoffs()->with(['tops', 'backsplashes'])->get();
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