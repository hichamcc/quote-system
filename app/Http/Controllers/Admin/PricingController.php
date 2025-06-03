<?php

// Controllers/Admin/PricingController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AreaType;
use App\Models\EdgeType;
use App\Models\ServicePrice;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        $areaTypes = AreaType::latest()->get();
        $edgeTypes = EdgeType::latest()->get();
        $servicePrices = ServicePrice::latest()->get();

        return view('admin.pricing.index', compact('areaTypes', 'edgeTypes', 'servicePrices'));
    }

    // Area Types
    public function storeAreaType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:area_types',
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean'
        ]);

        AreaType::create($request->all());

        return redirect()->route('admin.pricing.index')
            ->with('success', 'Area type created successfully.');
    }

    public function updateAreaType(Request $request, AreaType $areaType)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:area_types,name,' . $areaType->id,
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean'
        ]);

        $areaType->update($request->all());

        return redirect()->route('admin.pricing.index')
            ->with('success', 'Area type updated successfully.');
    }

    public function destroyAreaType(AreaType $areaType)
    {
        $areaType->delete();
        return redirect()->route('admin.pricing.index')
            ->with('success', 'Area type deleted successfully.');
    }

    // Edge Types
    public function storeEdgeType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:edge_types',
            'description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        EdgeType::create($request->all());

        return redirect()->route('admin.pricing.index')
            ->with('success', 'Edge type created successfully.');
    }

    public function updateEdgeType(Request $request, EdgeType $edgeType)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:edge_types,name,' . $edgeType->id,
            'description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        $edgeType->update($request->all());

        return redirect()->route('admin.pricing.index')
            ->with('success', 'Edge type updated successfully.');
    }

    public function destroyEdgeType(EdgeType $edgeType)
    {
        $edgeType->delete();
        return redirect()->route('admin.pricing.index')
            ->with('success', 'Edge type deleted successfully.');
    }

    // Service Prices
    public function storeServicePrice(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'service_key' => 'required|string|max:255|unique:service_prices',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean'
        ]);

        ServicePrice::create($request->all());

        return redirect()->route('admin.pricing.index')
            ->with('success', 'Service price created successfully.');
    }

    public function updateServicePrice(Request $request, ServicePrice $servicePrice)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'service_key' => 'required|string|max:255|unique:service_prices,service_key,' . $servicePrice->id,
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean'
        ]);

        $servicePrice->update($request->all());

        return redirect()->route('admin.pricing.index')
            ->with('success', 'Service price updated successfully.');
    }

    public function destroyServicePrice(ServicePrice $servicePrice)
    {
        $servicePrice->delete();
        return redirect()->route('admin.pricing.index')
            ->with('success', 'Service price deleted successfully.');
    }
}