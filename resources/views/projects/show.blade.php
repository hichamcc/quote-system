<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('projects.index') }}" class="text-indigo-600 hover:text-indigo-900">
                            &larr; Back to Projects
                        </a>
                    </div>

                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    {{ $project->name }}
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                    Project details and information
                                </p>
                            </div>
                            <div>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $project->date_accepted ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $project->date_accepted ? 'Accepted on ' . $project->date_accepted->format('M d, Y') : 'Pending' }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-200">
                            <div class="grid grid-cols-2 gap-4 p-6">
                                <div>
                                    <dl>
                                        <!-- Left Column -->
                                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-lg mb-4">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Client
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $project->user->name }}
                                            </dd>
                                        </div>
                                        
                                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-lg mb-4">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Customer
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $project->customer }}
                                            </dd>
                                        </div>
                                        
                                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-lg mb-4">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Email address
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $project->email }}
                                            </dd>
                                        </div>
                                        
                                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-lg mb-4">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Phone
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $project->phone ?? 'Not specified' }}
                                            </dd>
                                        </div>
                                        
                                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-lg mb-4">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Attention
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $project->attention ?? 'Not specified' }}
                                            </dd>
                                        </div>
                                        
                                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-lg mb-4">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Address
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 whitespace-pre-line">
                                                {{ $project->address ?? 'Not specified' }}
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                                
                                <div>
                                    <dl>
                                        <!-- Right Column -->
                                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-lg mb-4">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Architect
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $project->architect ?? 'Not specified' }}
                                            </dd>
                                        </div>
                                        
                                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-lg mb-4">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Bid Date
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $project->bid_date ? $project->bid_date->format('F d, Y') : 'Not specified' }}
                                            </dd>
                                        </div>
                                        
                                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-lg mb-4">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Plan Date
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $project->plan_date ? $project->plan_date->format('F d, Y') : 'Not specified' }}
                                            </dd>
                                        </div>
                                        
                                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-lg mb-4">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Created at
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $project->created_at->format('F d, Y \a\t h:i A') }}
                                            </dd>
                                        </div>
                                        
                                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-lg mb-4">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Last updated
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $project->updated_at->format('F d, Y \a\t h:i A') }}
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                            
                            <!-- Project Attachments Section - Full width -->
                            <div class="px-6 pb-6">
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-lg">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Attachments
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        @if($project->attachments->count() > 0)
                                            <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                                @foreach($project->attachments as $attachment)
                                                    <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                                        <div class="w-0 flex-1 flex items-center">
                                                            @php
                                                                $extension = pathinfo($attachment->original_filename, PATHINFO_EXTENSION);
                                                                $iconClass = 'fas fa-file';
                                                                
                                                                if (in_array($extension, ['pdf'])) {
                                                                    $iconClass = 'fas fa-file-pdf';
                                                                } elseif (in_array($extension, ['doc', 'docx'])) {
                                                                    $iconClass = 'fas fa-file-word';
                                                                } elseif (in_array($extension, ['xls', 'xlsx'])) {
                                                                    $iconClass = 'fas fa-file-excel';
                                                                } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                                                                    $iconClass = 'fas fa-file-image';
                                                                }
                                                            @endphp
                                                            <span class="flex-shrink-0 h-5 w-5">
                                                                <i class="{{ $iconClass }} text-gray-500"></i>
                                                            </span>
                                                            <span class="ml-2 flex-1 w-0 truncate">
                                                                {{ $attachment->original_filename }}
                                                                @if($attachment->description)
                                                                    <span class="text-gray-500 ml-1">- {{ $attachment->description }}</span>
                                                                @endif
                                                                <span class="text-xs text-gray-400 ml-2">{{ number_format($attachment->size / 1024, 2) }} KB</span>
                                                            </span>
                                                        </div>
                                                        <div class="ml-4 flex-shrink-0">
                                                            <a href="{{ Storage::url($attachment->path) }}" target="_blank" class="font-medium text-indigo-600 hover:text-indigo-500">
                                                                show file
                                                            </a>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-gray-500">No attachments uploaded</span>
                                        @endif
                                    </dd>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Place Takeoffs Section -->
                    <div class="mt-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Place Takeoffs</h3>
                            @if($project->placeTakeoffs->count() > 0)
                            <div>
                               
                                <a href="{{ route('projects.takeoffs.create', $project) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Add Takeoffs
                                </a>
                            </div> 
                              
                            @else
                                <a href="{{ route('projects.takeoffs.create', $project) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Add Takeoffs
                                </a>
                            @endif
                        </div>
                        
                        <!-- Takeoff summary -->
                        @if($project->placeTakeoffs->count() > 0)
                            <div class="bg-white shadow  sm:rounded-lg">
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Place</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Material</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Area</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Piece #</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Length</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Width</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Polished Edge</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Miter Edge</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sink C/O</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cooktop C/O</th>
                                                <th scope="col" class="hidden px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($project->placeTakeoffs as $placeTakeoff)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $placeTakeoff->place }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $placeTakeoff->material_name ?? 'N/A' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $placeTakeoff->supplier ?? 'N/A' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $placeTakeoff->area ?? 'N/A' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $placeTakeoff->piece_number ?? 'N/A' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $placeTakeoff->length ?? 'N/A' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $placeTakeoff->width ?? 'N/A' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $placeTakeoff->polished_edge_length ?? 'N/A' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $placeTakeoff->miter_edge_length ?? 'N/A' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $placeTakeoff->sink_cutout ?? '0' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $placeTakeoff->cooktop_cutout ?? '0' }}</td>
                                                    <td class="hidden px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <div class="flex space-x-2 ">
                                                           
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-4 text-gray-500 bg-gray-100 rounded">
                                No takeoffs added yet. 
                                <a href="{{ route('projects.takeoffs.create', $project) }}" class="text-blue-600 hover:text-indigo-900">
                                    Add place takeoffs
                                </a> 
                                to specify materials and dimensions for this project.
                            </div>
                        @endif
                    </div>

                    <!-- Calculations Summary Section -->
<div class="mt-8">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-medium text-gray-900">Material Calculations</h3>
    </div>
    
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <!-- Calculation Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Area</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Area SQFT</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Polished Edge LNFT</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Miter Edge LNFT</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sink C/O</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cooktop C/O</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                            $roomTypes = $project->placeTakeoffs->pluck('type')->unique()->filter();
                            $kitchenItems = $project->placeTakeoffs->where('type', 'Kitchen');
                            $bath2Items = $project->placeTakeoffs->where('type', 'Bathroom');
                            $masterBathItems = $project->placeTakeoffs->where('type', 'Master Bath');
                            $commonAreaItems = $project->placeTakeoffs->where('type', 'Common Area');
                            
                            // Helper function to calculate square feet
                            function calculateSqft($length, $width) {
                                return ($length && $width) ? ($length * $width / 144) : 0;
                            }
                            
                            // Helper function to convert inches to linear feet
                            function inchesToLinearFeet($inches) {
                                return $inches ? ($inches / 12) : 0;
                            }
                        @endphp
                        
                        <!-- Kitchen Rows -->
                        @foreach($kitchenItems as $index => $item)
                            <tr class="{{ $index % 2 === 0 ? 'bg-yellow-50' : 'bg-yellow-100' }}">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    KITCHEN {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format(calculateSqft($item->length, $item->width), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format(inchesToLinearFeet($item->polished_edge_length), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format(inchesToLinearFeet($item->miter_edge_length), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $item->sink_cutout ?? 0 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $item->cooktop_cutout ?? 0 }}
                                </td>
                            </tr>
                        @endforeach
                        
                        @if($kitchenItems->count() > 0)
                            <tr class="bg-yellow-200 font-bold">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    KITCHEN TOTAL
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    {{ number_format($kitchenItems->sum(function($item) { 
                                        return calculateSqft($item->length, $item->width);
                                    }), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    {{ number_format($kitchenItems->sum(function($item) { 
                                        return inchesToLinearFeet($item->polished_edge_length);
                                    }), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    {{ number_format($kitchenItems->sum(function($item) { 
                                        return inchesToLinearFeet($item->miter_edge_length);
                                    }), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    {{ $kitchenItems->sum('sink_cutout') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    {{ $kitchenItems->sum('cooktop_cutout') }}
                                </td>
                            </tr>
                        @endif

                        <!-- Bathroom Rows -->
                        @foreach($bath2Items as $index => $item)
                            <tr class="{{ $index % 2 === 0 ? 'bg-blue-50' : 'bg-blue-100' }}">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    BATH {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format(calculateSqft($item->length, $item->width), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format(inchesToLinearFeet($item->polished_edge_length), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format(inchesToLinearFeet($item->miter_edge_length), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $item->sink_cutout ?? 0 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $item->cooktop_cutout ?? 0 }}
                                </td>
                            </tr>
                        @endforeach
                        
                        @if($bath2Items->count() > 0)
                            <tr class="bg-blue-200 font-bold">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    BATH TOTAL
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    {{ number_format($bath2Items->sum(function($item) { 
                                        return calculateSqft($item->length, $item->width);
                                    }), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    {{ number_format($bath2Items->sum(function($item) { 
                                        return inchesToLinearFeet($item->polished_edge_length);
                                    }), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    {{ number_format($bath2Items->sum(function($item) { 
                                        return inchesToLinearFeet($item->miter_edge_length);
                                    }), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    {{ $bath2Items->sum('sink_cutout') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    {{ $bath2Items->sum('cooktop_cutout') }}
                                </td>
                            </tr>
                        @endif

                        <!-- Master Bath Rows -->
                        @foreach($masterBathItems as $index => $item)
                            <tr class="{{ $index % 2 === 0 ? 'bg-purple-50' : 'bg-purple-100' }}">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    MASTER BATH {{ $index === 0 ? '' : ($index + 1) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format(calculateSqft($item->length, $item->width), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format(inchesToLinearFeet($item->polished_edge_length), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format(inchesToLinearFeet($item->miter_edge_length), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $item->sink_cutout ?? 0 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $item->cooktop_cutout ?? 0 }}
                                </td>
                            </tr>
                        @endforeach
                        
                        @if($masterBathItems->count() > 0)
                            <tr class="bg-purple-200 font-bold">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    MASTER BATH TOTAL
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    {{ number_format($masterBathItems->sum(function($item) { 
                                        return calculateSqft($item->length, $item->width);
                                    }), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    {{ number_format($masterBathItems->sum(function($item) { 
                                        return inchesToLinearFeet($item->polished_edge_length);
                                    }), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    {{ number_format($masterBathItems->sum(function($item) { 
                                        return inchesToLinearFeet($item->miter_edge_length);
                                    }), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    {{ $masterBathItems->sum('sink_cutout') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    {{ $masterBathItems->sum('cooktop_cutout') }}
                                </td>
                            </tr>
                        @endif

                        <!-- Common Area Rows if any -->
                        @foreach($commonAreaItems as $index => $item)
                            <tr class="{{ $index % 2 === 0 ? 'bg-green-50' : 'bg-green-100' }}">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    COMMON AREA {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format(calculateSqft($item->length, $item->width), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format(inchesToLinearFeet($item->polished_edge_length), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format(inchesToLinearFeet($item->miter_edge_length), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $item->sink_cutout ?? 0 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $item->cooktop_cutout ?? 0 }}
                                </td>
                            </tr>
                        @endforeach
                        
                        @if($commonAreaItems->count() > 0)
                            <tr class="bg-green-200 font-bold">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    COMMON AREA TOTAL
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    {{ number_format($commonAreaItems->sum(function($item) { 
                                        return calculateSqft($item->length, $item->width);
                                    }), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    {{ number_format($commonAreaItems->sum(function($item) { 
                                        return inchesToLinearFeet($item->polished_edge_length);
                                    }), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    {{ number_format($commonAreaItems->sum(function($item) { 
                                        return inchesToLinearFeet($item->miter_edge_length);
                                    }), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    {{ $commonAreaItems->sum('sink_cutout') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                    {{ $commonAreaItems->sum('cooktop_cutout') }}
                                </td>
                            </tr>
                        @endif
                        
                        <!-- Grand Total -->
                        <tr class="bg-gray-200 font-bold">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                GRAND TOTAL
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                {{ number_format($project->placeTakeoffs->sum(function($item) { 
                                    return calculateSqft($item->length, $item->width);
                                }), 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                {{ number_format($project->placeTakeoffs->sum(function($item) { 
                                    return inchesToLinearFeet($item->polished_edge_length);
                                }), 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                {{ number_format($project->placeTakeoffs->sum(function($item) { 
                                    return inchesToLinearFeet($item->miter_edge_length);
                                }), 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                {{ $project->placeTakeoffs->sum('sink_cutout') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                {{ $project->placeTakeoffs->sum('cooktop_cutout') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Formula Legend -->
            <div class="mt-4 p-3 border rounded-md bg-gray-50">
                <h4 class="text-sm font-medium text-gray-700 mb-2">Calculation Formulas:</h4>
                <ul class="text-xs text-gray-600 space-y-1">
                    <li><span class="font-medium">Area SQFT</span> = (Length × Width) / 144</li>
                    <li><span class="font-medium">Polished Edge LNFT</span> = Polished Edge Length / 12</li>
                    <li><span class="font-medium">Miter Edge LNFT</span> = Miter Edge Length / 12</li>
                </ul>
            </div>
        </div>
    </div>
</div>



                    <!-- Sinks Section -->
                    <div class="mt-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Sinks</h3>
                            @if($project->sinks->count() > 0)
                            <div>
                              
                                <a href="{{ route('projects.sinks.create', $project) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Add Sinks
                                </a>
                            </div>
                              
                            @else
                                <a href="{{ route('projects.sinks.create', $project) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Add Sinks
                                </a>
                            @endif
                        </div>
                        
                        <!-- Sink summary -->
                        @if($project->sinks->count() > 0)
                            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sink Area</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Brand</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Model</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price ($)</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total ($)</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($project->sinks as $sink)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $sink->sink_area }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $sink->brand }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $sink->model }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($sink->price, 2) }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $sink->quantity }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($sink->price * $sink->quantity, 2) }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <div class="flex space-x-2">
                                                            <a href="{{ route('projects.sinks.edit', ['project' => $project->id, 'sink' => $sink->id]) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                            <form method="POST" action="{{ route('projects.sinks.destroy_single', ['project' => $project->id, 'sink' => $sink->id]) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this sink?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <!-- Summary row with total -->
                                            <tr class="bg-gray-50">
                                                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-right">Total:</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                                    ${{ number_format($project->sinks->sum(function($sink) { return $sink->price * $sink->quantity; }), 2) }}
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-4 text-gray-500 bg-gray-100 rounded">
                                No sinks added yet. 
                                <a href="{{ route('projects.sinks.create', $project) }}" class="text-indigo-600 hover:text-indigo-900">
                                    Add sinks
                                </a> 
                                to specify sink details for this project.
                            </div>
                        @endif
                    </div>


                    <div class="mt-8 flex space-x-3">
                        <a href="{{ route('projects.edit', $project) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Edit Project
                        </a>
                        
                        <form method="POST" action="{{ route('projects.destroy', $project) }}" onsubmit="return confirm('Are you sure you want to delete this project? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Delete Project
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>