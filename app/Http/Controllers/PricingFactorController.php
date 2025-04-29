<?php

namespace App\Http\Controllers;

use App\Models\PricingFactor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PricingFactorController extends Controller
{
    /**
     * Display the pricing factors.
     */
    public function index()
    {
        $pricingFactor = PricingFactor::first();
        $factorNames = PricingFactor::getFactorNames();
        
        return view('pricing-factors.index', compact('pricingFactor', 'factorNames'));
    }

    /**
     * Show the form for editing pricing factors.
     */
    public function edit()
    {
        $pricingFactor = PricingFactor::first();
        $factorNames = PricingFactor::getFactorNames();
        
        return view('pricing-factors.edit', compact('pricingFactor', 'factorNames'));
    }

    /**
     * Update the pricing factors.
     */
    public function update(Request $request)
    {
        $pricingFactor = PricingFactor::first();
        
        $rules = [];
        foreach (PricingFactor::getFactorNames() as $code => $name) {
            $rules["residential_$code"] = 'required|numeric|min:0';
            $rules["contractor_$code"] = 'required|numeric|min:0';
        }
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $pricingFactor->update($request->only(array_keys($rules)));

        return redirect()->route('pricing-factors.index')
            ->with('success', 'Pricing factors updated successfully.');
    }
}