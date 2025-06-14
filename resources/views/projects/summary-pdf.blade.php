<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->name }} - Summary</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }
        .summary-document {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .header-left {
            float: left;
            width: 50%;
        }
        .header-right {
            float: right;
            width: 50%;
            text-align: right;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        h2 {
            font-size: 20px;
            margin: 0 0 5px 0;
        }
        h3 {
            font-size: 16px;
            margin: 0 0 5px 0;
            color: #444;
        }
        h4 {
            font-size: 14px;
            margin: 15px 0 5px 0;
        }
        p {
            margin: 0 0 5px 0;
        }
        .quote-info {
            background-color: #f8f8f8;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .quote-info-grid {
            display: flex;
            justify-content: space-between;
        }
        .quote-info-left {
            float: left;
            width: 50%;
        }
        .quote-info-right {
            float: right;
            width: 50%;
            text-align: right;
        }
        .area-section {
            margin-bottom: 25px;
        }
        .line-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .line-item-left {
            float: left;
            width: 70%;
        }
        .line-item-right {
            float: right;
            width: 30%;
            text-align: right;
        }
        .subtotal {
            border-top: 1px solid #ddd;
            padding-top: 5px;
            margin-top: 10px;
            font-weight: bold;
        }
        .grand-total {
            border-top: 2px solid #333;
            padding-top: 10px;
            margin-top: 20px;
            font-weight: bold;
            font-size: 14px;
        }
        .terms {
            margin-top: 30px;
            font-size: 10px;
        }
        .terms ul {
            padding-left: 20px;
            margin: 10px 0;
        }
        .terms li {
            margin-bottom: 5px;
        }
        .signature {
            margin-top: 30px;
        }
        .signature-line {
            margin-top: 40px;
            border-top: 1px solid #999;
            padding-top: 5px;
            width: 250px;
            display: inline-block;
        }
        .page-number {
            text-align: right;
            margin-top: 20px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="summary-document">
        <!-- Header with Company Info -->
        <div class="header clearfix">
            <div class="header-left">
                <h2>Artelye Countertops</h2>
                <p>{{ $project->address ?? '123 Business Street' }}</p>
                <p>Tel: {{ $project->phone ?? '(123) 456-7890' }}</p>
            </div>
            <div class="header-right">
                <h3>Final Price After Template</h3>
                <p>Quote Date: {{ $project->created_at->format('m/d/Y') ?? now()->format('m/d/Y') }}</p>
            </div>
        </div>
        
        <!-- Quote Info -->
        <div class="quote-info clearfix">
            <div class="quote-info-grid">
                <div class="quote-info-left">
                    <p><strong>Quote Name:</strong> {{ $project->name }}</p>
                    <p><strong>Client:</strong> {{ $project->customer }}</p>
                    @if(isset($project->showroom))
                    <p><strong>Showroom:</strong> {{ $project->showroom }}</p>
                    @endif
                </div>
                <div class="quote-info-right">
                    <p><strong>Job Number:</strong> {{ $project->id }}</p>
                    @if(isset($project->amg_job_number))
                    <p><strong>AMG Job Number:</strong> {{ $project->amg_job_number }}</p>
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
            
            <div class="area-section">
                <h4>{{ $type }}</h4>
                
                @foreach($materialsByType as $name => $material)
                    <div class="line-item clearfix">
                        <div class="line-item-left">1 - {{ number_format($material['sqft'], 2) }} Sq. ft. {{ $name }}</div>
                        <div class="line-item-right">${{ number_format($material['cost'], 2) }}</div>
                    </div>
                @endforeach
                
                <!-- Cooktop cut out if applicable -->
                @if($cooktopCutoutCost > 0)
                    <div class="line-item clearfix">
                        <div class="line-item-left">{{ $items->sum('cooktop_cutout') }} - Cooktop cut out</div>
                        <div class="line-item-right">${{ number_format($cooktopCutoutTotal, 2) }}</div>
                    </div>
                @endif
                
                <!-- Sink cut out if applicable -->
                @if($sinkCutoutCost > 0)
                    <div class="line-item clearfix">
                        <div class="line-item-left">{{ $items->sum('sink_cutout') }} - Sink cut out with polished edges</div>
                        <div class="line-item-right">${{ number_format($sinkCutoutTotal, 2) }}</div>
                    </div>
                @endif
                
                <!-- Polished edges if applicable -->
                @if($polishedEdgesCost > 0)
                    @php
                        $totalPolishedLF = inchesToLinearFeet($items->sum('polished_edge_length'));
                    @endphp
                    <div class="line-item clearfix">
                        <div class="line-item-left">{{ number_format($totalPolishedLF, 2) }} LF - Polished edges</div>
                        <div class="line-item-right">${{ number_format($polishedEdgesTotal, 2) }}</div>
                    </div>
                @endif
                
                <!-- Miter edges if applicable -->
                @if($miterEdgesCost > 0)
                    @php
                        $totalMiterLF = inchesToLinearFeet($items->sum('miter_edge_length'));
                    @endphp
                    <div class="line-item clearfix">
                        <div class="line-item-left">{{ number_format($totalMiterLF, 2) }} LF - Miter edges</div>
                        <div class="line-item-right">${{ number_format($miterEdgesTotal, 2) }}</div>
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
                        <div class="line-item clearfix">
                            <div class="line-item-left">{{ implode(' - ', $sinkDescription) }}</div>
                            <div class="line-item-right">${{ number_format($sinkTotal, 2) }}</div>
                        </div>
                    @endif
                    
                    <!-- Bracket Details -->
                    @if($addon->bracket_model || $addon->bracket_name)
                        @php
                            $bracketTotal = ($addon->bracket_price ?? 0) * ($addon->bracket_quantity ?? 1);
                            $addonTotal += $bracketTotal;
                        @endphp
                        <div class="line-item clearfix">
                            <div class="line-item-left">{{ $addon->bracket_quantity ?? 1 }} - {{ $addon->bracket_name ?? $addon->bracket_model }}</div>
                            <div class="line-item-right">${{ number_format($bracketTotal, 2) }}</div>
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
                        <div class="line-item clearfix">
                            <div class="line-item-left">{{ number_format($polishedLinearFeet, 2) }} LF - {{ $addon->edge_type }} Edge @ ${{ number_format($addon->edge_price ?? 0, 2) }}/LF</div>
                            <div class="line-item-right">${{ number_format($edgeTotalCost, 2) }}</div>
                        </div>
                    @endif
                    
                    <!-- Plumbing Service -->
                    @if($addon->plumbing)
                        <div class="line-item clearfix">
                            <div class="line-item-left">Plumbing Services</div>
                            <div class="line-item-right">${{ number_format($addon->plumbing_price ?? 0, 2) }}</div>
                        </div>
                        @php $addonTotal += $addon->plumbing_price ?? 0; @endphp
                    @endif
                    
                    <!-- Demo Service -->
                    @if($addon->demo)
                        <div class="line-item clearfix">
                            <div class="line-item-left">Demo Service</div>
                            <div class="line-item-right">${{ number_format($addon->demo_price ?? 0, 2) }}</div>
                        </div>
                        @php $addonTotal += $addon->demo_price ?? 0; @endphp
                    @endif
                    
                    <!-- Vein Exact Match Service -->
                    @if($addon->vein_exact_match)
                        <div class="line-item clearfix">
                            <div class="line-item-left">Vein Exact Match</div>
                            <div class="line-item-right">${{ number_format($addon->vein_exact_match_price ?? 0, 2) }}</div>
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
                        <div class="line-item clearfix">
                            <div class="line-item-left">{{ $addon->electrical_cutout_quantity ?? 1 }} - Electrical Cutout(s) @ ${{ number_format($electricalUnitPrice, 2) }} each</div>
                            <div class="line-item-right">${{ number_format($electricalTotalCost, 2) }}</div>
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
                <div class="line-item subtotal clearfix">
                    <div class="line-item-left">Subtotal</div>
                    <div class="line-item-right">${{ number_format($typeTotal, 2) }}</div>
                </div>
            </div>
        @endforeach
        
        <!-- Addons not associated with specific areas -->
        @php
            $unassignedAddons = $addons->whereNotIn('type', $takeoffsByType->keys());
            $unassignedAddonTotal = 0;
        @endphp
        
        @if($unassignedAddons->count() > 0)
            <div class="area-section">
                <h4>Additional Items</h4>
                
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
                        <div class="line-item clearfix">
                            <div class="line-item-left">{{ implode(' - ', $sinkDescription) }}</div>
                            <div class="line-item-right">${{ number_format($sinkTotal, 2) }}</div>
                        </div>
                    @endif
                    
                    <!-- Bracket Details -->
                    @if($addon->bracket_model || $addon->bracket_name)
                        @php
                            $bracketTotal = ($addon->bracket_price ?? 0) * ($addon->bracket_quantity ?? 1);
                            $addonSubtotal += $bracketTotal;
                        @endphp
                        <div class="line-item clearfix">
                            <div class="line-item-left">{{ $addon->bracket_quantity ?? 1 }} - {{ $addon->bracket_name ?? $addon->bracket_model }}</div>
                            <div class="line-item-right">${{ number_format($bracketTotal, 2) }}</div>
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
                        <div class="line-item clearfix">
                            <div class="line-item-left">{{ number_format($edgeLinearFeet, 2) }} LF - {{ $addon->edge_type }} Edge @ ${{ number_format($addon->edge_price ?? 0, 2) }}/LF</div>
                            <div class="line-item-right">${{ number_format($edgeTotalCost, 2) }}</div>
                        </div>
                    @endif
                    
                    @if($addon->plumbing)
                        <div class="line-item clearfix">
                            <div class="line-item-left">Plumbing Services</div>
                            <div class="line-item-right">${{ number_format($addon->plumbing_price ?? 0, 2) }}</div>
                        </div>
                        @php $addonSubtotal += $addon->plumbing_price ?? 0; @endphp
                    @endif
                    
                    @if($addon->demo)
                        <div class="line-item clearfix">
                            <div class="line-item-left">Demo Service</div>
                            <div class="line-item-right">${{ number_format($addon->demo_price ?? 0, 2) }}</div>
                        </div>
                        @php $addonSubtotal += $addon->demo_price ?? 0; @endphp
                    @endif
                    
                    @if($addon->vein_exact_match)
                        <div class="line-item clearfix">
                            <div class="line-item-left">Vein Exact Match</div>
                            <div class="line-item-right">${{ number_format($addon->vein_exact_match_price ?? 0, 2) }}</div>
                        </div>
                        @php $addonSubtotal += $addon->vein_exact_match_price ?? 0; @endphp
                    @endif
                    
                    @if($addon->electrical_cutout)
                        @php
                            $electricalUnitPrice = ($addon->electrical_cutout_price ?? 0);
                            $electricalTotalCost = $electricalUnitPrice * ($addon->electrical_cutout_quantity ?? 1);
                            $addonSubtotal += $electricalTotalCost;
                        @endphp
                        <div class="line-item clearfix">
                            <div class="line-item-left">{{ $addon->electrical_cutout_quantity ?? 1 }} - Electrical Cutout(s) @ ${{ number_format($electricalUnitPrice, 2) }} each</div>
                            <div class="line-item-right">${{ number_format($electricalTotalCost, 2) }}</div>
                        </div>
                    @endif
                    
                    @php
                        $unassignedAddonTotal += $addonSubtotal;
                    @endphp
                @endforeach
                
                <div class="line-item subtotal clearfix">
                    <div class="line-item-left">Subtotal</div>
                    <div class="line-item-right">${{ number_format($unassignedAddonTotal, 2) }}</div>
                </div>
            </div>
            
            @php
                $grandTotal += $unassignedAddonTotal;
            @endphp
        @endif
        
        <!-- Final total -->
        <div class="grand-total">
            <div class="line-item clearfix">
                <div class="line-item-left">Total</div>
                <div class="line-item-right">${{ number_format($grandTotal, 2) }}</div>
            </div>
            
            <!-- Deposit info -->
            <div class="line-item clearfix" style="font-weight: normal; font-size: 12px;">
                <div class="line-item-left">Deposit paid with ck# {{ $project->deposit_check_number ?? '____' }} on {{ $project->deposit_date ? $project->deposit_date->format('m/d/y') : '___/___/___' }}</div>
                <div class="line-item-right">${{ number_format($project->deposit_amount ?? 0, 2) }}</div>
            </div>
            
            <div class="line-item clearfix" style="margin-top: 10px;">
                <div class="line-item-left">Balance Due</div>
                <div class="line-item-right">${{ number_format($grandTotal - ($project->deposit_amount ?? 0), 2) }}</div>
            </div>
        </div>
        
        <!-- Terms and conditions -->
        <div class="terms">
            <p>Please review the drawing details with your Sales Consultant and then sign and date to acknowledge final contract price for the work to be performed as described above.</p>
            
            <ul>
                <li>Please note all appliances, sinks, and faucets with accessories must be present at time of installation. A minimum charge of $250.00 will be assessed for any return to job site to complete the project. (NO EXCEPTIONS!)</li>
                <li>If homeowner cancels the job after the template there will be a template fee of $250 that the homeowner is obligated to pay.</li>
                <li>Unless stated otherwise, this quote does not include a sink, sink strainer, plumbing services.</li>
                <li>The sinks that is provided by Artelye do not include drain assembly or strainer.</li>
                <li>Please disconnect plumbing prior to the scheduled tear-out and installation date.</li>
                <li>Artelye does not provide any electrical services, nor can move, disconnect, or reconnect any appliances.</li>
                <li>Installs outside of a 30-mile radius are subject to fuel/labor surcharge.</li>
            </ul>
            
            <p style="margin-top: 15px;"><strong>GENERAL NOTES:</strong></p>
            <p>Artelye Countertops reserves the right to change seam location(s) after template, where we feel necessary, in order to fabricate the stone selected.</p>
            
            <p style="margin-top: 15px;">Please feel free to contact us with any questions or concerns that you may have. Thank you for your business.</p>
            
            <div class="signature" style="margin-top: 40px;">
                <table width="100%">
                    <tr>
                        <td width="70%">
                            <div>APPROVED SIGNATURE:_________________________</div>
                            <div style="margin-top: 10px; font-size: 10px;">{{ $project->customer ?? "Buyer's Name" }}</div>
                            <div style="font-size: 10px;">{{ $project->seller_contact ?? "Seller Contact" }}</div>
                        </td>
                        <td width="30%" style="text-align: right;">
                            <div>DATE:_______________</div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>