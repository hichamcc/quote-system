<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AreaType;
use Illuminate\Http\Request;

class AreaTypeController extends Controller
{
    public function index()
    {
        $areaTypes = AreaType::latest()->get();
        return view('area-types.index', compact('areaTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:area_types',
        ]);

        $data = $request->all();
        $data['is_active'] = true; // Always set to true
        $data['description'] = null; // Set description to null

        AreaType::create($data);

        return redirect()->route('area-types.index')
            ->with('success', 'Area type created successfully.');
    }

    public function update(Request $request, AreaType $areaType)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:area_types,name,' . $areaType->id,
        ]);

        $data = $request->all();
        $data['is_active'] = true; // Always keep active
        $data['description'] = null; // Keep description null

        $areaType->update($data);

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('area-types.index')
            ->with('success', 'Area type updated successfully.');
    }

    public function destroy(AreaType $areaType)
    {
        $areaType->delete();
        return redirect()->route('area-types.index')
            ->with('success', 'Area type deleted successfully.');
    }
}