<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Artelye Countertops') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="text-2xl font-semibold text-gray-900">
                            {{ config('app.name', 'Artelye Countertops') }}
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white shadow rounded-lg p-6 mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-bold text-gray-800">Project Summary (Shared)</h1>
                        @if($project->share_expires_at)
                        <p class="text-sm text-gray-500">
                            This link expires on {{ $project->share_expires_at->format('M d, Y') }}
                        </p>
                        @endif
                    </div>
                    
                    <div class="mb-4">
                        <a href="{{ route('shared.generate-pdf', $project->share_token) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Download PDF
                        </a>
                    </div>
                    
                    <div class="summary-document">
                        <!-- Header with Company Info -->
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">Artelye Countertops</h2>
                                <p class="text-sm text-gray-600">{{ $project->address ?? '123 Business Street' }}</p>
                                <p class="text-sm text-gray-600">Tel: {{ $project->phone ?? '(123) 456-7890' }}</p>
                            </div>
                            <div class="text-right">
                                <h3 class="text-xl font-bold text-indigo-700">Final Price After Template</h3>
                                <p class="text-sm text-gray-600">Quote Date: {{ $project->created_at->format('m/d/Y') ?? now()->format('m/d/Y') }}</p>
                            </div>
                        </div>
                        
                        <!-- Quote Info -->
                        <div class="bg-gray-100 p-3 mb-6">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p><span class="font-medium">Quote Name:</span> {{ $project->name }}</p>
                                    <p><span class="font-medium">Client:</span> {{ $project->customer }}</p>
                                    @if(isset($project->showroom))
                                    <p><span class="font-medium">Showroom:</span> {{ $project->showroom }}</p>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <p><span class="font-medium">Job Number:</span> {{ $project->id }}</p>
                                    @if(isset($project->amg_job_number))
                                    <p><span class="font-medium">AMG Job Number:</span> {{ $project->amg_job_number }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        @php
                            // Helper functions
                            function calculateSqft($length, $width) {
                                return ($length && $width) ? ($length * $width / 144) : 0;
                            }
                            
                            function inchesToLinearFeet($inches) {
                                return $inches ? ($inches / 12) : 0;
                            }
                            
                            $grandTotal = 0;
                        @endphp
                        
                        <!-- Areas and Materials -->
                        @foreach($takeoffsByType as $type => $items)
                            @php
                                $typeSubtotal = 0;
                                $typeSqft = 0;
                                $materialsByType = [];
                                $cooktopCutoutCost = 0;
                                $sinkCutoutCost = 0;
                                $polishedEdgesCost = 0;
                                $miterEdgesCost = 0;
                                
                                // Calculate areas and initial costs
                                foreach($items as $item) {
                                    $sqft = calculateSqft($item->length, $item->width);
                                    $typeSqft += $sqft;
                                    
                                    // Group by material name to consolidate identical materials
                                    $materialName = $item->material_name ?? 'Countertop Material';
                                    $materialPrice = $item->material_price ?? 0;
                                    
                                    if (!isset($materialsByType[$materialName])) {
                                        $materialsByType[$materialName] = [
                                            'sqft' => 0,
                                            'price' => $materialPrice,
                                            'cost' => 0
                                        ];
                                    }
                                    
                                    $materialsByType[$materialName]['sqft'] += $sqft;
                                    
                                    // Calculate other costs
                                    if ($item->cooktop_cutout) {
                                        $cooktopCutoutCost += $item->cooktop_cutout * $project->factor_cooktop_cutout;
                                    }
                                    
                                    if ($item->sink_cutout) {
                                        $sinkCutoutCost += $item->sink_cutout * $project->factor_sink_cutout;
                                    }
                                    
                                    if ($item->polished_edge_length) {
                                        $polishedLF = inchesToLinearFeet($item->polished_edge_length);
                                        $polishedEdgesCost += $project->calculateEdgePolishCost($polishedLF);
                                    }
                                    
                                    if ($item->miter_edge_length) {
                                        $miterLF = inchesToLinearFeet($item->miter_edge_length);
                                        $miterEdgesCost += $project->calculateMiterCost($miterLF);
                                    }
                                }
                                
                                // Calculate costs for each material group
                                foreach ($materialsByType as $name => &$material) {
                                    // Apply waste factor to material cost only
                                    $materialCostWithWaste = $material['sqft'] * $material['price'] * (1 + ($project->factor_waste / 100));
                                    
                                    // Calculate fabrication, installation and template costs (no waste factor)
                                    $fabricationCost = $project->calculateFabricationCost($material['sqft']);
                                    $installationCost = $project->calculateInstallationCost($material['sqft']);
                                    $templateCost = $project->calculateTemplateCost($material['sqft']);
                                    
                                    // Calculate base cost
                                    $baseCost = $materialCostWithWaste + $fabricationCost + $installationCost + $templateCost;
                                    
                                    // Add overhead
                                    $overhead = $project->calculateOverhead($baseCost);
                                    
                                    // Add profit
                                    $profit = $project->calculateProfit($baseCost + $overhead);
                                    
                                    // Set the total cost including overhead and profit
                                    $material['cost'] = $baseCost + $overhead + $profit;
                                }
                                
                                // Calculate overhead and profit for other costs
                                $otherCosts = $cooktopCutoutCost + $sinkCutoutCost + $polishedEdgesCost + $miterEdgesCost;
                                
                                if ($otherCosts > 0) {
                                    $otherCostsOverhead = $project->calculateOverhead($otherCosts);
                                    $otherCostsProfit = $project->calculateProfit($otherCosts + $otherCostsOverhead);
                                    
                                    // Add overhead and profit to each additional cost
                                    $cooktopCutoutTotal = $cooktopCutoutCost > 0 ? ($cooktopCutoutCost + 
                                        ($cooktopCutoutCost / $otherCosts) * ($otherCostsOverhead + $otherCostsProfit)) : 0;
                                        
                                    $sinkCutoutTotal = $sinkCutoutCost > 0 ? ($sinkCutoutCost + 
                                        ($sinkCutoutCost / $otherCosts) * ($otherCostsOverhead + $otherCostsProfit)) : 0;
                                        
                                    $polishedEdgesTotal = $polishedEdgesCost > 0 ? ($polishedEdgesCost + 
                                        ($polishedEdgesCost / $otherCosts) * ($otherCostsOverhead + $otherCostsProfit)) : 0;
                                        
                                    $miterEdgesTotal = $miterEdgesCost > 0 ? ($miterEdgesCost + 
                                        ($miterEdgesCost / $otherCosts) * ($otherCostsOverhead + $otherCostsProfit)) : 0;
                                } else {
                                    $cooktopCutoutTotal = 0;
                                    $sinkCutoutTotal = 0;
                                    $polishedEdgesTotal = 0;
                                    $miterEdgesTotal = 0;
                                }
                                
                                // Calculate total for this area
                                $typeTotal = array_sum(array_column($materialsByType, 'cost')) + 
                                            $cooktopCutoutTotal + $sinkCutoutTotal + 
                                            $polishedEdgesTotal + $miterEdgesTotal;
                                
                                // Get addons for this area type
                                $areaAddons = $addons->where('type', $type);
                                $areaAddonTotal = 0;
                            @endphp
                            
                            <div class="mb-8">
                                <h3 class="text-lg font-medium mb-2">{{ $type }}</h3>
                                
                                @foreach($materialsByType as $name => $material)
                                    <div class="flex justify-between mb-1">
                                        <span>1 - {{ number_format($material['sqft'], 2) }} Sq. ft. {{ $name }}</span>
                                        <span>${{ number_format($material['cost'], 2) }}</span>
                                    </div>
                                @endforeach
                                
                                <!-- Cooktop cut out if applicable -->
                                @if($cooktopCutoutCost > 0)
                                    <div class="flex justify-between mb-1">
                                        <span>{{ $items->sum('cooktop_cutout') }} - Cooktop cut out</span>
                                        <span>${{ number_format($cooktopCutoutTotal, 2) }}</span>
                                    </div>
                                @endif
                                
                                <!-- Sink cut out if applicable -->
                                @if($sinkCutoutCost > 0)
                                    <div class="flex justify-between mb-1">
                                        <span>{{ $items->sum('sink_cutout') }} - Sink cut out with polished edges</span>
                                        <span>${{ number_format($sinkCutoutTotal, 2) }}</span>
                                    </div>
                                @endif
                                
                                <!-- Polished edges if applicable -->
                                @if($polishedEdgesCost > 0)
                                    @php
                                        $totalPolishedLF = inchesToLinearFeet($items->sum('polished_edge_length'));
                                    @endphp
                                    <div class="flex justify-between mb-1">
                                        <span>{{ number_format($totalPolishedLF, 2) }} LF - Polished edges</span>
                                        <span>${{ number_format($polishedEdgesTotal, 2) }}</span>
                                    </div>
                                @endif
                                
                                <!-- Miter edges if applicable -->
                                @if($miterEdgesCost > 0)
                                    @php
                                        $totalMiterLF = inchesToLinearFeet($items->sum('miter_edge_length'));
                                    @endphp
                                    <div class="flex justify-between mb-1">
                                        <span>{{ number_format($totalMiterLF, 2) }} LF - Miter edges</span>
                                        <span>${{ number_format($miterEdgesTotal, 2) }}</span>
                                    </div>
                                @endif
                                
                                <!-- Addons for this area -->
                                @foreach($areaAddons as $addon)
                                    @php
                                        $addonTotal = 0;
                                    @endphp
                                    
                                    <!-- Sink Details -->
                                    @if($addon->sink_model || $addon->sink_name)
                                        @php
                                            $sinkTotal = ($addon->sink_price ?? 0) * ($addon->sink_quantity ?? 1);
                                            $addonTotal += $sinkTotal;
                                            
                                            // Build sink description
                                            $sinkDescription = [];
                                            if($addon->sink_quantity && $addon->sink_quantity > 1) {
                                                $sinkDescription[] = $addon->sink_quantity;
                                            } else {
                                                $sinkDescription[] = '1';
                                            }
                                            
                                            if($addon->sink_name) {
                                                $sinkDescription[] = $addon->sink_name;
                                            }
                                            
                                            if($addon->sink_model) {
                                                $sinkDescription[] = $addon->sink_model;
                                            }
                                        @endphp
                                        <div class="flex justify-between mb-1">
                                            <span>{{ implode(' - ', $sinkDescription) }}</span>
                                            <span>${{ number_format($sinkTotal, 2) }}</span>
                                        </div>
                                    @endif
                                    
                                    <!-- Bracket Details -->
                                    @if($addon->bracket_model || $addon->bracket_name)
                                        @php
                                            $bracketTotal = ($addon->bracket_price ?? 0) * ($addon->bracket_quantity ?? 1);
                                            $addonTotal += $bracketTotal;
                                        @endphp
                                        <div class="flex justify-between mb-1">
                                            <span>{{ $addon->bracket_quantity ?? 1 }} - {{ $addon->bracket_name ?? $addon->bracket_model }}</span>
                                            <span>${{ number_format($bracketTotal, 2) }}</span>
                                        </div>
                                    @endif
                                    
                                    <!-- Edge Service -->
                                    @if($addon->edge && $addon->edge_type)
                                        @php
                                            // Calculate polished edge linear feet for this area type only
                                            $polishedLinearFeet = 0;
                                            if (isset($takeoffsByType[$type])) {
                                                foreach($takeoffsByType[$type] as $takeoff) {
                                                    $polishedLinearFeet += inchesToLinearFeet($takeoff->polished_edge_length ?? 0);
                                                }
                                            }
                                            $edgeTotalCost = ($addon->edge_price ?? 0) * $polishedLinearFeet;
                                            $addonTotal += $edgeTotalCost;
                                        @endphp
                                        <div class="flex justify-between mb-1">
                                            <span>{{ number_format($polishedLinearFeet, 2) }} LF - {{ $addon->edge_type }} Edge @ ${{ number_format($addon->edge_price ?? 0, 2) }}/LF</span>
                                            <span>${{ number_format($edgeTotalCost, 2) }}</span>
                                        </div>
                                    @endif
                                    
                                    <!-- Plumbing Service -->
                                    @if($addon->plumbing)
                                        <div class="flex justify-between mb-1">
                                            <span>Plumbing Services</span>
                                            <span>${{ number_format($addon->plumbing_price ?? 0, 2) }}</span>
                                        </div>
                                        @php $addonTotal += $addon->plumbing_price ?? 0; @endphp
                                    @endif
                                    
                                    <!-- Demo Service -->
                                    @if($addon->demo)
                                        <div class="flex justify-between mb-1">
                                            <span>Demo Service</span>
                                            <span>${{ number_format($addon->demo_price ?? 0, 2) }}</span>
                                        </div>
                                        @php $addonTotal += $addon->demo_price ?? 0; @endphp
                                    @endif
                                    
                                    <!-- Vein Exact Match Service -->
                                    @if($addon->vein_exact_match)
                                        <div class="flex justify-between mb-1">
                                            <span>Vein Exact Match</span>
                                            <span>${{ number_format($addon->vein_exact_match_price ?? 0, 2) }}</span>
                                        </div>
                                        @php $addonTotal += $addon->vein_exact_match_price ?? 0; @endphp
                                    @endif
                                    
                                    <!-- Electrical Cutout Service -->
                                    @if($addon->electrical_cutout)
                                        @php
                                            $electricalUnitPrice = ($addon->electrical_cutout_price ?? 0);
                                            $electricalTotalCost = $electricalUnitPrice * ($addon->electrical_cutout_quantity ?? 1);
                                            $addonTotal += $electricalTotalCost;
                                        @endphp
                                        <div class="flex justify-between mb-1">
                                            <span>{{ $addon->electrical_cutout_quantity ?? 1 }} - Electrical Cutout(s) @ ${{ number_format($electricalUnitPrice, 2) }} each</span>
                                            <span>${{ number_format($electricalTotalCost, 2) }}</span>
                                        </div>
                                    @endif
                                    
                                    @php
                                        $areaAddonTotal += $addonTotal;
                                    @endphp
                                @endforeach
                                
                                @php
                                    $typeTotal += $areaAddonTotal;
                                    $grandTotal += $typeTotal;
                                @endphp
                                
                                <!-- Subtotal for this area -->
                                <div class="flex justify-between font-semibold mt-2 border-t pt-2">
                                    <span>Subtotal</span>
                                    <span>${{ number_format($typeTotal, 2) }}</span>
                                </div>
                            </div>
                        @endforeach
                        
                        <!-- Addons not associated with specific areas -->
                        @php
                            $unassignedAddons = $addons->whereNotIn('type', $takeoffsByType->keys());
                            $unassignedAddonTotal = 0;
                        @endphp
                        
                        @if($unassignedAddons->count() > 0)
                            <div class="mb-8">
                                <h3 class="text-lg font-medium mb-2">Additional Items</h3>
                                
                                @foreach($unassignedAddons as $addon)
                                    @php
                                        $addonSubtotal = 0;
                                    @endphp
                                    
                                    <!-- Sink Details -->
                                    @if($addon->sink_model || $addon->sink_name)
                                        @php
                                            $sinkTotal = ($addon->sink_price ?? 0) * ($addon->sink_quantity ?? 1);
                                            $addonSubtotal += $sinkTotal;
                                            
                                            // Build sink description
                                            $sinkDescription = [];
                                            if($addon->sink_quantity && $addon->sink_quantity > 1) {
                                                $sinkDescription[] = $addon->sink_quantity;
                                            } else {
                                                $sinkDescription[] = '1';
                                            }
                                            
                                            if($addon->sink_name) {
                                                $sinkDescription[] = $addon->sink_name;
                                            }
                                            
                                            if($addon->sink_model) {
                                                $sinkDescription[] = $addon->sink_model;
                                            }
                                        @endphp
                                        <div class="flex justify-between mb-1">
                                            <span>{{ implode(' - ', $sinkDescription) }}</span>
                                            <span>${{ number_format($sinkTotal, 2) }}</span>
                                        </div>
                                    @endif
                                    
                                    <!-- Bracket Details -->
                                    @if($addon->bracket_model || $addon->bracket_name)
                                        @php
                                            $bracketTotal = ($addon->bracket_price ?? 0) * ($addon->bracket_quantity ?? 1);
                                            $addonSubtotal += $bracketTotal;
                                        @endphp
                                        <div class="flex justify-between mb-1">
                                            <span>{{ $addon->bracket_quantity ?? 1 }} - {{ $addon->bracket_name ?? $addon->bracket_model }}</span>
                                            <span>${{ number_format($bracketTotal, 2) }}</span>
                                        </div>
                                    @endif
                                    
                                    <!-- Services -->
                                    @if($addon->edge && $addon->edge_type)
                                        @php
                                            // For unassigned addons, we can't calculate LF from takeoffs
                                            // So we'll need to use a stored LF value or default to 0
                                            // You may need to add an edge_linear_feet field to your addons table
                                            $edgeLinearFeet = $addon->edge_linear_feet ?? 0; // Add this field or calculate differently
                                            $edgeTotalCost = ($addon->edge_price ?? 0) * $edgeLinearFeet;
                                            $addonSubtotal += $edgeTotalCost;
                                        @endphp
                                        <div class="flex justify-between mb-1">
                                            <span>{{ number_format($edgeLinearFeet, 2) }} LF - {{ $addon->edge_type }} Edge @ ${{ number_format($addon->edge_price ?? 0, 2) }}/LF</span>
                                            <span>${{ number_format($edgeTotalCost, 2) }}</span>
                                        </div>
                                    @endif
                                    
                                    @if($addon->plumbing)
                                        <div class="flex justify-between mb-1">
                                            <span>Plumbing Services</span>
                                            <span>${{ number_format($addon->plumbing_price ?? 0, 2) }}</span>
                                        </div>
                                        @php $addonSubtotal += $addon->plumbing_price ?? 0; @endphp
                                    @endif
                                    
                                    @if($addon->demo)
                                        <div class="flex justify-between mb-1">
                                            <span>Demo Service</span>
                                            <span>${{ number_format($addon->demo_price ?? 0, 2) }}</span>
                                        </div>
                                        @php $addonSubtotal += $addon->demo_price ?? 0; @endphp
                                    @endif
                                    
                                    @if($addon->vein_exact_match)
                                        <div class="flex justify-between mb-1">
                                            <span>Vein Exact Match</span>
                                            <span>${{ number_format($addon->vein_exact_match_price ?? 0, 2) }}</span>
                                        </div>
                                        @php $addonSubtotal += $addon->vein_exact_match_price ?? 0; @endphp
                                    @endif
                                    
                                    @if($addon->electrical_cutout)
                                        @php
                                            $electricalUnitPrice = ($addon->electrical_cutout_price ?? 0);
                                            $electricalTotalCost = $electricalUnitPrice * ($addon->electrical_cutout_quantity ?? 1);
                                            $addonSubtotal += $electricalTotalCost;
                                        @endphp
                                        <div class="flex justify-between mb-1">
                                            <span>{{ $addon->electrical_cutout_quantity ?? 1 }} - Electrical Cutout(s) @ ${{ number_format($electricalUnitPrice, 2) }} each</span>
                                            <span>${{ number_format($electricalTotalCost, 2) }}</span>
                                        </div>
                                    @endif
                                    
                                    @php
                                        $unassignedAddonTotal += $addonSubtotal;
                                    @endphp
                                @endforeach
                                
                                <div class="flex justify-between font-semibold mt-2 border-t pt-2">
                                    <span>Subtotal</span>
                                    <span>${{ number_format($unassignedAddonTotal, 2) }}</span>
                                </div>
                            </div>
                            
                            @php
                                $grandTotal += $unassignedAddonTotal;
                            @endphp
                        @endif
                        
                        <!-- Final total -->
                        <div class="border-t-2 border-gray-300 pt-4 mt-8">
                            <div class="flex justify-between text-lg font-bold">
                                <span>Total</span>
                                <span>${{ number_format($grandTotal, 2) }}</span>
                            </div>
                            
                            <!-- Deposit info -->
                            <div class="flex justify-between text-sm mt-2">
                                <span>Deposit paid with ck# {{ $project->deposit_check_number ?? '____' }} on {{ $project->deposit_date ? $project->deposit_date->format('m/d/y') : '___/___/___' }}</span>
                                <span>${{ number_format($project->deposit_amount ?? 0, 2) }}</span>
                            </div>
                            
                            <div class="flex justify-between font-bold mt-2">
                                <span>Balance Due</span>
                                <span>${{ number_format($grandTotal - ($project->deposit_amount ?? 0), 2) }}</span>
                            </div>
                        </div>
                        
                        <!-- Terms and conditions -->
                        <div class="mt-8 text-xs text-gray-600">
                            <p class="mb-2">Please review the drawing details with your Sales Consultant and then sign and date to acknowledge final contract price for the work to be performed as described above.</p>
                            
                            <ul class="list-disc list-inside space-y-1">
                                <li>Please note all appliances, sinks, and faucets with accessories must be present at time of installation. A minimum charge of $250.00 will be assessed for any return to job site to complete the project. (NO EXCEPTIONS!)</li>
                                <li>If homeowner cancels the job after the template there will be a template fee of $250 that the homeowner is obligated to pay.</li>
                                <li>Unless stated otherwise, this quote does not include a sink, sink strainer, plumbing services.</li>
                                <li>The sinks that is provided by Artelye do not include drain assembly or strainer.</li>
                                <li>Please disconnect plumbing prior to the scheduled tear-out and installation date.</li>
                                <li>Artelye does not provide any electrical services, nor can move, disconnect, or reconnect any appliances.</li>
                                <li>Installs outside of a 30-mile radius are subject to fuel/labor surcharge.</li>
                            </ul>
                            
                            <p class="mt-4 font-medium">GENERAL NOTES:</p>
                            <p>Artelye Countertops reserves the right to change seam location(s) after template, where we feel necessary, in order to fabricate the stone selected.</p>
                            
                            <p class="mt-4">Please feel free to contact us with any questions or concerns that you may have. Thank you for your business.</p>
                            
                            <div class="mt-8 flex justify-between items-center">
                                <div>
                                    <p>APPROVED SIGNATURE:_________________________</p>
                                    <p class="text-xs">{{ $project->seller_contact ?? "Seller Contact" }}</p>
                                </div>
                                <div>
                                    <p>DATE:_______________</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
        <footer class="bg-white border-t mt-auto">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <div class="text-center text-sm text-gray-500">
                    &copy; {{ date('Y') }} Artelye Countertops. All rights reserved.
                </div>
            </div>
        </footer>
    </div>
</body>
</html>