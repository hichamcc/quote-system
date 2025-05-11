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
                
                // Calculate cooktop cutout costs
                if ($item->cooktop_cutout) {
                    $cooktopCutoutCost += $item->cooktop_cutout * $project->factor_cooktop_cutout;
                }
                
                // Calculate sink cutout costs
                if ($item->sink_cutout) {
                    $sinkCutoutCost += $item->sink_cutout * $project->factor_sink_cutout;
                }
                
                // Calculate polished edge costs
                if ($item->polished_edge_length) {
                    $polishedLF = inchesToLinearFeet($item->polished_edge_length);
                    $polishedEdgesCost += $project->calculateEdgePolishCost($polishedLF);
                }
                
                // Calculate miter edge costs
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
            
            // Calculate subtotal for this area by adding all costs
            $typeSubtotal = array_sum(array_column($materialsByType, 'cost')) + 
                          $cooktopCutoutCost + $sinkCutoutCost + 
                          $polishedEdgesCost + $miterEdgesCost;
            
            // Calculate overhead and profit for other costs
            $otherCosts = $cooktopCutoutCost + $sinkCutoutCost + $polishedEdgesCost + $miterEdgesCost;
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
                
            // Calculate total for this area
            $typeTotal = array_sum(array_column($materialsByType, 'cost')) + 
                        $cooktopCutoutTotal + $sinkCutoutTotal + 
                        $polishedEdgesTotal + $miterEdgesTotal;
            
            // Add to grand total
            $grandTotal += $typeTotal;
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
            
            <!-- Sink details -->
            @foreach($sinks->where('sink_area', $type) as $sink)
                <div class="flex justify-between mb-1">
                    <span>1 - {{ $sink->gauge ?? '' }} {{ $sink->material ?? '' }} {{ $sink->type ?? '' }} {{ $sink->model ?? '' }} {{ $sink->brand ?? '' }}</span>
                    <span>${{ number_format($sink->price, 2) }}</span>
                </div>
                @php
                    $typeTotal += $sink->price;
                    $grandTotal += $sink->price;
                @endphp
            @endforeach
            
            <!-- Subtotal for this area -->
            <div class="flex justify-between font-semibold mt-2 border-t pt-2">
                <span>Subtotal</span>
                <span>${{ number_format($typeTotal, 2) }}</span>
            </div>
        </div>
    @endforeach
    
    <!-- Add sink costs not associated with specific areas -->
    @php
        $unassignedSinks = $sinks->whereNotIn('sink_area', $takeoffsByType->keys());
        $sinkTotal = $unassignedSinks->sum(function($sink) {
            return $sink->price * ($sink->quantity ?? 1);
        });
        $grandTotal += $sinkTotal;
    @endphp
    
    @if($unassignedSinks->count() > 0)
        <div class="mb-8">
            <h3 class="text-lg font-medium mb-2">Additional Sinks</h3>
            
            @foreach($unassignedSinks as $sink)
                <div class="flex justify-between mb-1">
                    <span>{{ $sink->quantity ?? 1 }} - {{ $sink->model }} {{ $sink->brand }}</span>
                    <span>${{ number_format($sink->price * ($sink->quantity ?? 1), 2) }}</span>
                </div>
            @endforeach
            
            <div class="flex justify-between font-semibold mt-2 border-t pt-2">
                <span>Subtotal</span>
                <span>${{ number_format($sinkTotal, 2) }}</span>
            </div>
        </div>
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
                <p class="text-xs mt-2">{{ $project->customer ?? "Buyer's Name" }}</p>
                <p class="text-xs">{{ $project->seller_contact ?? "Seller Contact" }}</p>
            </div>
            <div>
                <p>DATE:_______________</p>
            </div>
        </div>
    </div>
</div>