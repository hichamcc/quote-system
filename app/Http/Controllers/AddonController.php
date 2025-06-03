<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\AreaType;
use App\Models\PricingFactor;
use App\Models\EdgeType;

class AddonController extends Controller
{
    /**
     * Display a listing of addons for a specific project.
     */
    public function index(Project $project)
    {
        $addons = $project->addons()->paginate(10);
        
        return view('addons.index', compact('project', 'addons'));
    }

     /**
         * Show the form for creating a new addon.
         */
        public function create(Project $project)
        {
            $areaTypes = AreaType::latest()->get();
            
            // Get edge types for the edge dropdown
            $edgeTypes = EdgeType::latest()->get();
            
            // Get pricing factors from database
            $pricingFactors = PricingFactor::first(); // Assuming you have one record, adjust as needed
            
            // Determine customer type based on project type
            $customerType = strtolower($project->project_type) === 'residential' ? 'residential' : 'commercial';
            
            // Get service prices based on customer type
            $servicePrices = [
                'demo' => $pricingFactors->{$customerType . '_demo'} ?? 0,
                'vein_exact_match' => $pricingFactors->{$customerType . '_vein_exact_match'} ?? 0,
                'electrical_cutout' => $pricingFactors->{$customerType . '_electrical_cutout'} ?? 0,
            ];
            
            return view('addons.create', compact('project', 'areaTypes', 'edgeTypes', 'pricingFactors', 'servicePrices', 'customerType'));
        }

    /**
     * Store a newly created addon in storage.
     */
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'type' => 'nullable|string|max:255',
            'sink_model' => 'nullable|string|max:255',
            'sink_name' => 'nullable|string|max:255',
            'sink_quantity' => 'nullable|integer|min:1',
            'sink_price' => 'nullable|numeric|min:0',
            'edge' => 'boolean',
            'edge_type' => 'nullable|string|max:255',
            'edge_price' => 'nullable|numeric|min:0',
            'plumbing' => 'boolean',
            'plumbing_details' => 'nullable|string',
            'plumbing_price' => 'nullable|numeric|min:0',
            'bracket_model' => 'nullable|string|max:255',
            'bracket_name' => 'nullable|string|max:255',
            'bracket_quantity' => 'nullable|integer|min:1',
            'bracket_price' => 'nullable|numeric|min:0',
            'demo' => 'boolean',
            'demo_price' => 'nullable|numeric|min:0',
            'vein_exact_match' => 'boolean',
            'vein_exact_match_price' => 'nullable|numeric|min:0',
            'electrical_cutout' => 'boolean',
            'electrical_cutout_quantity' => 'nullable|integer|min:1',
            'electrical_cutout_price' => 'nullable|numeric|min:0',
        ]);

        $validated['project_id'] = $project->id;

        Addon::create($validated);

        return redirect()->route('projects.addons.index', $project)
                         ->with('success', 'Addon created successfully.');
    }

    /**
     * Display the specified addon.
     */
    public function show(Project $project, Addon $addon)
    {
        return view('addons.show', compact('project', 'addon'));
    }

    /**
     * Show the form for editing the specified addon.
     */
    public function edit(Project $project, Addon $addon)
    {
        $areaTypes = AreaType::latest()->get();

        return view('addons.edit', compact('project', 'addon','areaTypes'));
    }

    /**
     * Update the specified addon in storage.
     */
    public function update(Request $request, Project $project, Addon $addon)
    {
        $validated = $request->validate([
            'type' => 'nullable|string|max:255',
            'sink_model' => 'nullable|string|max:255',
            'sink_name' => 'nullable|string|max:255',
            'sink_price' => 'nullable|numeric|min:0',
            'edge' => 'boolean',
            'edge_type' => 'nullable|string|max:255',
            'edge_price' => 'nullable|numeric|min:0',
            'plumbing' => 'boolean',
            'plumbing_price' => 'nullable|numeric|min:0',
            'bracket_model' => 'nullable|string|max:255',
            'bracket_name' => 'nullable|string|max:255',
            'bracket_quantity' => 'nullable|integer|min:1',
            'bracket_price' => 'nullable|numeric|min:0',
            'demo' => 'boolean',
            'demo_price' => 'nullable|numeric|min:0',
            'vein_exact_match' => 'boolean',
            'vein_exact_match_price' => 'nullable|numeric|min:0',
            'electrical_cutout' => 'boolean',
            'electrical_cutout_quantity' => 'nullable|integer|min:1',
            'electrical_cutout_price' => 'nullable|numeric|min:0',
        ]);

        $addon->update($validated);

        return redirect()->route('projects.addons.index', $project)
                         ->with('success', 'Addon updated successfully.');
    }

    /**
     * Remove the specified addon from storage.
     */
    public function destroy(Project $project, Addon $addon)
    {
        $addon->delete();

        return redirect()->route('projects.addons.index', $project)
                         ->with('success', 'Addon deleted successfully.');
    }
}