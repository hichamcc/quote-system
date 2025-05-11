@extends('components.layouts.print')

@section('title', 'Project Summary - ' . $project->name)

@section('content')
    <!-- Header with Company Info -->
    <div class="header">
        <div class="company-info">
            <h2 style="font-size: 18pt; margin-bottom: 5px;">{{ config('app.name') }} Countertops</h2>
            <p>123 Business Street</p>
            <p>City, State 12345</p>
            <p>Tel: (123) 456-7890</p>
        </div>
        <div class="document-title">
            <h3 style="font-size: 16pt; color: #4338ca; margin-bottom: 5px;">Final Price After Template</h3>
            <p>Quote Date: {{ now()->format('m/d/Y') }}</p>
        </div>
    </div>
    
    <!-- Quote Info -->
    <div class="quote-info">
        <div class="quote-info-left">
            <p><strong>Quote Name:</strong> {{ $project->name }}</p>
            <p><strong>Client:</strong> {{ $project->customer }}</p>
           
        </div>
        <div class="quote-info-right">
            <p><strong>Job Number:</strong> {{ $project->id }}</p>
            <p><strong>Project Type:</strong> {{ ucfirst($project->project_type) }}</p>
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
            $typeTotal = 0;
            $typeSqft = 0;
            
            foreach($items as $item) {
                $sqft = calculateSqft($item->length, $item->width);
                $typeSqft += $sqft;
                
                // Calculate costs using project pricing factors
                $materialCost = $sqft * $project->calculateSqftCost($item->material_price ?? 0);
                $fabricationCost = $project->calculateFabricationCost($sqft);
                $edgePolishCost = $project->calculateEdgePolishCost(inchesToLinearFeet($item->polished_edge_length));
                $miterCost = $project->calculateMiterCost(inchesToLinearFeet($item->miter_edge_length));
                $sinkCutoutCost = $project->calculateSinkCutoutCost($item->sink_cutout ?? 0);
                $cooktopCutoutCost = $project->calculateCooktopCutoutCost($item->cooktop_cutout ?? 0);
                $templateCost = $project->calculateTemplateCost($sqft);
                $installationCost = $project->calculateInstallationCost($sqft);
                
                $subtotal = $materialCost + $fabricationCost + $edgePolishCost + $miterCost + 
                           $sinkCutoutCost + $cooktopCutoutCost + $templateCost + $installationCost;
                           
                $overhead = $project->calculateOverhead($subtotal);
                $profit = $project->calculateProfit($subtotal + $overhead);
                $itemTotal = $subtotal + $overhead + $profit;
                
                $typeTotal += $itemTotal;
            }
            
            $grandTotal += $typeTotal;
        @endphp
        
        <div class="area-section">
            <h3 class="area-header">{{ $type }} </h3>
            
            @foreach($items as $item)
                @php
                    $sqft = calculateSqft($item->length, $item->width);
                @endphp
                <div class="line-item">
                    <span>1 - {{ number_format($sqft, 2) }} Sq. ft. {{ $item->material_name ?? 'Countertop Material' }}</span>
                    <span>${{ number_format($sqft * ($item->material_price ?? 0) * (1 + ($project->factor_waste / 100)), 2) }}</span>
                </div>
            @endforeach
            
            <!-- Sink details if available for this area -->
            @foreach($sinks->where('sink_area', $type) as $sink)
                <div class="line-item">
                    <span>{{ $sink->quantity }} - {{ $sink->model }} {{ $sink->brand }}</span>
                    <span>${{ number_format($sink->price * $sink->quantity, 2) }}</span>
                </div>
            @endforeach
            
            <!-- Other standard line items -->
            @if($items->sum('sink_cutout') > 0)
                <div class="line-item">
                    <span>{{ $items->sum('sink_cutout') }} - Sink cut out with polished edges</span>
                    <span>${{ number_format($items->sum('sink_cutout') * $project->factor_sink_cutout, 2) }}</span>
                </div>
            @endif
            
            @if($items->sum('cooktop_cutout') > 0)
                <div class="line-item">
                    <span>{{ $items->sum('cooktop_cutout') }} - Cooktop cut out</span>
                    <span>${{ number_format($items->sum('cooktop_cutout') * $project->factor_cooktop_cutout, 2) }}</span>
                </div>
            @endif
            
            <!-- Faucet holes if any -->
            <div class="line-item">
                <span>1 - Faucet holes with 4" spread</span>
                <span>$0.00</span>
            </div>
            
            <!-- Edge detail -->
            <div class="line-item">
                <span>1 - Edge Detail - Eased</span>
                <span>$0.00</span>
            </div>
            
            <!-- Subtotal for this area -->
            <div class="subtotal">
                <span>Subtotal</span>
                <span>${{ number_format($typeTotal, 2) }}</span>
            </div>
        </div>
    @endforeach
    
    <!-- Add sink costs not associated with specific areas -->
    @php
        $unassignedSinks = $sinks->whereNotIn('sink_area', $takeoffsByType->keys());
        $sinkTotal = $unassignedSinks->sum(function($sink) {
            return $sink->price * $sink->quantity;
        });
        $grandTotal += $sinkTotal;
    @endphp
    
    @if($unassignedSinks->count() > 0)
        <div class="area-section">
            <h3 class="area-header">Additional Sinks</h3>
            
            @foreach($unassignedSinks as $sink)
                <div class="line-item">
                    <span>{{ $sink->quantity }} - {{ $sink->model }} {{ $sink->brand }}</span>
                    <span>${{ number_format($sink->price * $sink->quantity, 2) }}</span>
                </div>
            @endforeach
            
            <div class="subtotal">
                <span>Subtotal</span>
                <span>${{ number_format($sinkTotal, 2) }}</span>
            </div>
        </div>
    @endif
    
    <!-- Final total -->
    <div class="grand-total">
        <div class="total-row">
            <span>Total</span>
            <span>${{ number_format($grandTotal, 2) }}</span>
        </div>
        
        <!-- Deposit info if needed -->
        <div class="deposit-row">
            <span>Deposit paid with ck# _____ on ___/___/___</span>
            <span>$_______</span>
        </div>
        
        <div class="balance-row">
            <span>Balance Due</span>
            <span>${{ number_format($grandTotal, 2) }}</span>
        </div>
    </div>
    
    <!-- Terms and conditions -->
    <div class="terms">
        <p>Please review the drawing details with your Sales Consultant and then sign and date to acknowledge final contract price for the work to be performed as described above.</p>
        
        <ul>
            <li>Please note all appliances, sinks, and faucets with accessories must be present at time of installation. A minimum charge of $250.00 will be assessed for any return to job site to complete the project. (NO EXCEPTIONS!)</li>
            <li>If homeowner cancels the job after the template there will be a template fee of $250 that the homeowner is obligated to pay.</li>
            <li>Unless stated otherwise, this quote does not include a sink, sink strainer, plumbing services.</li>
            <li>The sink that is provided by us does not include drain assembly or strainer.</li>
            <li>Please discuss if plumbing prior to the scheduled tear-out and installation date.</li>
            <li>We do not provide any electrical services, nor can move, disconnect, or reconnect any appliances.</li>
            <li>Installs outside of a 30-mile radius are subject to fuel/labor surcharge.</li>
        </ul>
        
        <p style="margin-top: 15px;"><strong>GENERAL NOTES:</strong><br>
        We reserve the right to change seam location(s) after template, where we feel necessary, in order to fabricate the stone specified.</p>
        
        <p style="margin-top: 15px;">Please feel free to contact us with any questions or concerns that you may have. Thank you for your business.</p>
        
        <div class="signature-area">
            <div>
                <p>APPROVED SIGNATURE:_________________________</p>
                <p style="font-size: 9pt; margin-top: 5px;">Buyer's Name</p>
                <p style="font-size: 9pt;">Seller Contact</p>
            </div>
            <div>
                <p>DATE:_______________</p>
            </div>
        </div>
        
        <div class="page-number">Page 1 of 1</div>
    </div>
@endsection