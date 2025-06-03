<?php

// Update your existing PricingFactorController
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PricingFactor;
use App\Models\EdgeType;
use Illuminate\Http\Request;

class PricingFactorController extends Controller
{
    public function index()
    {
        $pricingFactor = PricingFactor::first();
        $factorNames = PricingFactor::getFactorNames();
        $edgeTypes = EdgeType::latest()->get();
        
        return view('pricing-factors.index', compact('pricingFactor', 'factorNames', 'edgeTypes'));
    }

    public function edit()
    {
        $pricingFactor = PricingFactor::first();
        $factorNames = PricingFactor::getFactorNames();
        
        return view('pricing-factors.edit', compact('pricingFactor', 'factorNames'));
    }

    public function update(Request $request)
    {
        $pricingFactor = PricingFactor::first();
        
        // Validate all pricing factor fields including new service prices
        $rules = [];
        foreach (PricingFactor::getFactorNames() as $code => $name) {
            $rules['residential_' . $code] = 'required|numeric|min:0';
            $rules['contractor_' . $code] = 'required|numeric|min:0';
        }
        
        $validated = $request->validate($rules);
        
        $pricingFactor->update($validated);
        
        return redirect()->route('pricing-factors.index')
            ->with('success', 'Pricing factors updated successfully.');
    }

    // Edge Types methods
    public function storeEdgeType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:edge_types',
            'price' => 'required|numeric|min:0',
        ]);

        $data = $request->all();
        $data['is_active'] = true; // Always set to true
        $data['description'] = null; // Set description to null

        EdgeType::create($data);

        return redirect()->route('pricing-factors.index')
            ->with('success', 'Edge type created successfully.');
    }

    public function updateEdgeType(Request $request, EdgeType $edgeType)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:edge_types,name,' . $edgeType->id,
            'price' => 'required|numeric|min:0',
        ]);

        $data = $request->all();
        $data['is_active'] = true; // Always keep active
        $data['description'] = null; // Keep description null

        $edgeType->update($data);

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('pricing-factors.index')
            ->with('success', 'Edge type updated successfully.');
    }

    public function destroyEdgeType(EdgeType $edgeType)
    {
        $edgeType->delete();
        return redirect()->route('pricing-factors.index')
            ->with('success', 'Edge type deleted successfully.');
    }
}