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

                    <div class="mt-4 flex space-x-3">
                        <button id="show-summary-btn" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Show Summary
                        </button>
                        
                        <a href="{{ route('project.generate-pdf', $project->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Generate PDF
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
                                                Created by
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $project->user->name }}
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
                                                Type
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $project->project_type }}
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
                                        
                                    </dl>
                                </div>
                                
                                <div>
                                    <dl>
                                        <!-- Right Column -->
                                        
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
                                                Address
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 whitespace-pre-line">
                                                {{ $project->address ?? 'Not specified' }}
                                            </dd>
                                        </div>
                                        
                                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-lg mb-4">
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
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">AMG Job#</th>
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
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($project->placeTakeoffs as $placeTakeoff)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $placeTakeoff->amg_job_number }}</td>
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
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <div class="flex space-x-2 ">
                                                            <a href="{{ route('projects.takeoffs.edit', ['project' => $project->id, 'takeoff' => $placeTakeoff->id]) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                            <form method="POST" action="{{ route('projects.takeoffs.destroy_single', ['project' => $project->id, 'takeoff' => $placeTakeoff->id]) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this sink?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                            </form>
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
                                                // Helper functions
                                                function calculateSqft($length, $width) {
                                                    return ($length && $width) ? ($length * $width / 144) : 0;
                                                }
                                                
                                                function inchesToLinearFeet($inches) {
                                                    return $inches ? ($inches / 12) : 0;
                                                }
                                                
                                                // Get all takeoffs grouped by type
                                                $takeoffsByType = $project->placeTakeoffs->groupBy('type');
                                                
                                                // Type color mapping (can be extended for new types)
                                                $typeColors = [
                                                    'Kitchen' => ['row' => 'bg-yellow-50', 'altRow' => 'bg-yellow-100', 'total' => 'bg-yellow-200'],
                                                    'Bathroom' => ['row' => 'bg-blue-50', 'altRow' => 'bg-blue-100', 'total' => 'bg-blue-200'],
                                                    'Master Bath' => ['row' => 'bg-purple-50', 'altRow' => 'bg-purple-100', 'total' => 'bg-purple-200'],
                                                    'Common Area' => ['row' => 'bg-green-50', 'altRow' => 'bg-green-100', 'total' => 'bg-green-200'],
                                                    // Default colors for any new types
                                                    'default' => ['row' => 'bg-gray-50', 'altRow' => 'bg-gray-100', 'total' => 'bg-gray-200']
                                                ];
                                                
                                                function getColors($type, $typeColors) {
                                                    return $typeColors[$type] ?? $typeColors['default'];
                                                }
                                            @endphp
                                            
                                            @foreach($takeoffsByType as $type => $items)
                                                <!-- Individual items of this type -->
                                                @foreach($items as $index => $item)
                                                    @php 
                                                        $colors = getColors($type, $typeColors);
                                                        $bgClass = $index % 2 === 0 ? $colors['row'] : $colors['altRow'];
                                                    @endphp
                                                    
                                                    <tr class="{{ $bgClass }}">
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                            {{ $type }} {{ $items->count() > 1 ? ($index + 1) : '' }}
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
                                                
                                                <!-- Total row for this type -->
                                                @if($items->count() > 0)
                                                    @php $colors = getColors($type, $typeColors); @endphp
                                                    <tr class="{{ $colors['total'] }} font-bold">
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                                            {{ strtoupper($type) }} TOTAL
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                                            {{ number_format($items->sum(function($item) { 
                                                                return calculateSqft($item->length, $item->width);
                                                            }), 2) }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                                            {{ number_format($items->sum(function($item) { 
                                                                return inchesToLinearFeet($item->polished_edge_length);
                                                            }), 2) }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                                            {{ number_format($items->sum(function($item) { 
                                                                return inchesToLinearFeet($item->miter_edge_length);
                                                            }), 2) }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                                            {{ $items->sum('sink_cutout') }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                                            {{ $items->sum('cooktop_cutout') }}
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            
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
                                <div class="hidden mt-4 p-3 border rounded-md bg-gray-50">
                                    <h4 class="text-sm font-medium text-gray-700 mb-2">Calculation Formulas:</h4>
                                    <ul class="text-xs text-gray-600 space-y-1">
                                        <li><span class="font-medium">Area SQFT</span> = (Length × Width) / 144</li>
                                        <li><span class="font-medium">Polished Edge LNFT</span> = Polished Edge Length / 12</li>
                                        <li><span class="font-medium">Miter Edge LNFT</span> = Miter Edge Length / 12</li>
                                    </ul>
                                </div>
                                
                                <!-- Materials Usage Summary -->
                                @if($project->placeTakeoffs->count() > 0 && $project->placeTakeoffs->whereNotNull('material_name')->count() > 0)
                                    <div class="mt-6">
                                        <h4 class="text-sm font-medium text-gray-700 mb-2">Materials Usage Summary:</h4>
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Material</th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total SQFT</th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Areas Used</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $materialGroups = $project->placeTakeoffs
                                                            ->whereNotNull('material_name')
                                                            ->groupBy('material_name');
                                                    @endphp
                                                    
                                                    @foreach($materialGroups as $materialName => $items)
                                                        <tr class="{{ $loop->index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                                {{ $materialName }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                {{ $items->pluck('supplier')->unique()->filter()->implode(', ') ?: 'N/A' }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                {{ number_format($items->sum(function($item) { 
                                                                    return calculateSqft($item->length, $item->width);
                                                                }), 2) }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                {{ $items->pluck('type')->unique()->implode(', ') }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Pricing Calculation Section -->
                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Project Pricing Calculation</h3>
                        
                        @php
                         
                            
                            // Get all takeoffs grouped by type
                            $takeoffsByType = $project->placeTakeoffs->groupBy('type');
                            
                            // Initialize totals
                            $totalSqft = 0;
                            $totalMaterialCost = 0;
                            $totalFabricationCost = 0;
                            $totalEdgePolishCost = 0;
                            $totalMiterCost = 0;
                            $totalSinkCutoutCost = 0;
                            $totalCooktopCutoutCost = 0;
                            $totalTemplateCost = 0;
                            $totalInstallationCost = 0;
                            $totalOverhead = 0;
                            // Arrays to store calculations by type
                            $calculations = [];
                        @endphp

                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:p-6">
                               <!-- Pricing Calculation Table with Overhead Column -->
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Area</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SQFT</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Material</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fabrication</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Edge Polish</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Miter</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sink C/O</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cooktop C/O</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Template</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Install</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Overhead</th>
                                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($takeoffsByType as $type => $takeoffs)
                                            @php
                                                $typeTotalSqft = 0;
                                                $typeTotalMaterialCost = 0;
                                                $typeTotalFabricationCost = 0;
                                                $typeTotalEdgePolishCost = 0;
                                                $typeTotalMiterCost = 0;
                                                $typeTotalSinkCutoutCost = 0;
                                                $typeTotalCooktopCutoutCost = 0;
                                                $typeTotalTemplateCost = 0;
                                                $typeTotalInstallationCost = 0;
                                                
                                                foreach($takeoffs as $takeoff) {
                                                    $sqft = calculateSqft($takeoff->length, $takeoff->width);
                                                    $typeTotalSqft += $sqft;
                                                    
                                                    $materialCost = $sqft * $project->calculateSqftCost($takeoff->material_price ?? 0);
                                                    $typeTotalMaterialCost += $materialCost;
                                                    
                                                    $fabricationCost = $project->calculateFabricationCost($sqft);
                                                    $typeTotalFabricationCost += $fabricationCost;
                                                    
                                                    $edgePolishCost = $project->calculateEdgePolishCost(inchesToLinearFeet($takeoff->polished_edge_length));
                                                    $typeTotalEdgePolishCost += $edgePolishCost;
                                                    
                                                    $miterCost = $project->calculateMiterCost(inchesToLinearFeet($takeoff->miter_edge_length));
                                                    $typeTotalMiterCost += $miterCost;
                                                    
                                                    $sinkCutoutCost = $project->calculateSinkCutoutCost($takeoff->sink_cutout ?? 0);
                                                    $typeTotalSinkCutoutCost += $sinkCutoutCost;
                                                    
                                                    $cooktopCutoutCost = $project->calculateCooktopCutoutCost($takeoff->cooktop_cutout ?? 0);
                                                    $typeTotalCooktopCutoutCost += $cooktopCutoutCost;
                                                    
                                                    $templateCost = $project->calculateTemplateCost($sqft);
                                                    $typeTotalTemplateCost += $templateCost;
                                                    
                                                    $installationCost = $project->calculateInstallationCost($sqft);
                                                    $typeTotalInstallationCost += $installationCost;
                                                }
                                                
                                                $typeSubtotal = $typeTotalMaterialCost + $typeTotalFabricationCost + $typeTotalEdgePolishCost + 
                                                            $typeTotalMiterCost + $typeTotalSinkCutoutCost + $typeTotalCooktopCutoutCost + 
                                                            $typeTotalTemplateCost + $typeTotalInstallationCost;
                                                    
                                                // Calculate overhead for this type
                                                $typeOverhead = $project->calculateOverhead($typeSubtotal);
                                                
                                                // Calculate total cost (subtotal + overhead)
                                                $typeTotalCost = $typeSubtotal + $typeOverhead;
                                                    
                                                // Add to global totals
                                                $totalSqft += $typeTotalSqft;
                                                $totalMaterialCost += $typeTotalMaterialCost;
                                                $totalFabricationCost += $typeTotalFabricationCost;
                                                $totalEdgePolishCost += $typeTotalEdgePolishCost;
                                                $totalMiterCost += $typeTotalMiterCost;
                                                $totalSinkCutoutCost += $typeTotalSinkCutoutCost;
                                                $totalCooktopCutoutCost += $typeTotalCooktopCutoutCost;
                                                $totalTemplateCost += $typeTotalTemplateCost;
                                                $totalInstallationCost += $typeTotalInstallationCost;
                                                $totalOverhead += $typeOverhead;
                                                
                                                // Store calculations for this type
                                                $calculations[$type] = [
                                                    'sqft' => $typeTotalSqft,
                                                    'material' => $typeTotalMaterialCost,
                                                    'fabrication' => $typeTotalFabricationCost,
                                                    'edge_polish' => $typeTotalEdgePolishCost,
                                                    'miter' => $typeTotalMiterCost,
                                                    'sink_cutout' => $typeTotalSinkCutoutCost,
                                                    'cooktop_cutout' => $typeTotalCooktopCutoutCost,
                                                    'template' => $typeTotalTemplateCost,
                                                    'installation' => $typeTotalInstallationCost,
                                                    'subtotal' => $typeSubtotal,
                                                    'overhead' => $typeOverhead,
                                                    'total_cost' => $typeTotalCost
                                                ];
                                            @endphp
                                            <tr class="{{ $loop->index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $type }}</td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($typeTotalSqft, 2) }}</td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($typeTotalMaterialCost, 2) }}</td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($typeTotalFabricationCost, 2) }}</td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($typeTotalEdgePolishCost, 2) }}</td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($typeTotalMiterCost, 2) }}</td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($typeTotalSinkCutoutCost, 2) }}</td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($typeTotalCooktopCutoutCost, 2) }}</td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($typeTotalTemplateCost, 2) }}</td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($typeTotalInstallationCost, 2) }}</td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($typeSubtotal, 2) }}</td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($typeOverhead, 2) }}</td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900">${{ number_format($typeTotalCost, 2) }}</td>
                                            </tr>
                                        @endforeach
                                        
                                        @php
                                            $subtotal = $totalMaterialCost + $totalFabricationCost + $totalEdgePolishCost + 
                                                    $totalMiterCost + $totalSinkCutoutCost + $totalCooktopCutoutCost + 
                                                    $totalTemplateCost + $totalInstallationCost;
                                                    
                                            $overhead = $project->calculateOverhead($subtotal);
                                            $totalCost = $subtotal + $overhead;
                                            $profit = $project->calculateProfit($totalCost);
                                            $total = $totalCost + $profit;
                                            
                                            // Add sink prices from sinks table
                                            $totalSinkPrice = $project->sinks->sum(function($sink) {
                                                return $sink->price * $sink->quantity;
                                            });
                                            
                                            $grandTotal = $total + $totalSinkPrice;
                                        @endphp
                                        
                                        <!-- Totals Row -->
                                        <tr class="bg-gray-200">
                                            <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900">TOTALS</td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900">{{ number_format($totalSqft, 2) }}</td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900">${{ number_format($totalMaterialCost, 2) }}</td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900">${{ number_format($totalFabricationCost, 2) }}</td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900">${{ number_format($totalEdgePolishCost, 2) }}</td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900">${{ number_format($totalMiterCost, 2) }}</td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900">${{ number_format($totalSinkCutoutCost, 2) }}</td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900">${{ number_format($totalCooktopCutoutCost, 2) }}</td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900">${{ number_format($totalTemplateCost, 2) }}</td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900">${{ number_format($totalInstallationCost, 2) }}</td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900">${{ number_format($subtotal, 2) }}</td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900">${{ number_format($overhead, 2) }}</td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900">${{ number_format($totalCost, 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>


                                <!-- Price Per SQFT Analysis Cards -->
                                <div class="mt-8">
                                    <h4 class="text-md font-medium text-gray-900 mb-4">Price Analysis by Area Type</h4>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        @php
                                            // Define a color palette that we can cycle through for different types
                                            $colorPalette = [
                                                ['bg' => 'bg-yellow-50', 'header' => 'bg-yellow-200'],
                                                ['bg' => 'bg-blue-50', 'header' => 'bg-blue-200'],
                                                ['bg' => 'bg-purple-50', 'header' => 'bg-purple-200'],
                                                ['bg' => 'bg-green-50', 'header' => 'bg-green-200'],
                                                ['bg' => 'bg-indigo-50', 'header' => 'bg-indigo-200'],
                                                ['bg' => 'bg-red-50', 'header' => 'bg-red-200'],
                                                ['bg' => 'bg-orange-50', 'header' => 'bg-orange-200'],
                                                ['bg' => 'bg-teal-50', 'header' => 'bg-teal-200'],
                                                ['bg' => 'bg-pink-50', 'header' => 'bg-pink-200'],
                                                // Add more colors as needed
                                            ];
                                            
                                            // Keep track of which types have been assigned colors
                                            $typeColorMap = [];
                                            $colorIndex = 0;
                                        @endphp
                                        
                                        @foreach($calculations as $type => $calc)
                                            @php
                                                // Skip if no square footage
                                                if ($calc['sqft'] <= 0) continue;
                                                
                                                // Calculate price per square foot
                                                $pricePerSqft = $calc['total_cost'] / $calc['sqft'];
                                                
                                                // Calculate profit for this area
                                                $areaProfit = $project->calculateProfit($calc['total_cost']);
                                                
                                                // Calculate price per square foot with profit
                                                $pricePerSqftWithProfit = ($calc['total_cost'] + $areaProfit) / $calc['sqft'];
                                                
                                                // Assign a color to this type if it doesn't have one yet
                                                if (!isset($typeColorMap[$type])) {
                                                    $typeColorMap[$type] = $colorPalette[$colorIndex % count($colorPalette)];
                                                    $colorIndex++;
                                                }
                                                
                                                $cardColor = $typeColorMap[$type]['bg'];
                                                $headerColor = $typeColorMap[$type]['header'];
                                            @endphp
                                            
                                            <div class="rounded-lg shadow overflow-hidden">
                                                <div class="{{ $headerColor }} px-4 py-2">
                                                    <h5 class="font-medium text-gray-900">{{ $type }}</h5>
                                                </div>
                                                <div class="{{ $cardColor }} p-4">
                                                    <div class="space-y-3">
                                                        <div>
                                                            <p class="text-sm text-gray-600">Total Area:</p>
                                                            <p class="text-lg font-semibold">{{ number_format($calc['sqft'], 2) }} SQFT</p>
                                                        </div>
                                                        
                                                        <div class="border-t pt-3">
                                                            <p class="text-sm text-gray-600">Cost Breakdown:</p>
                                                            <div class="grid grid-cols-2 gap-2 mt-2">
                                                                <div class="text-right">
                                                                    <p class="text-xs text-gray-500">Subtotal:</p>
                                                                </div>
                                                                <div>
                                                                    <p class="text-xs font-medium">${{ number_format($calc['subtotal'], 2) }}</p>
                                                                </div>
                                                                
                                                                <div class="text-right">
                                                                    <p class="text-xs text-gray-500">Overhead ({{ $project->factor_overhead }}%):</p>
                                                                </div>
                                                                <div>
                                                                    <p class="text-xs font-medium">${{ number_format($calc['overhead'], 2) }}</p>
                                                                </div>
                                                                
                                                                <div class="text-right">
                                                                    <p class="text-xs text-gray-500">Total Cost:</p>
                                                                </div>
                                                                <div>
                                                                    <p class="text-xs font-medium">${{ number_format($calc['total_cost'], 2) }}</p>
                                                                </div>
                                                                
                                                                <div class="text-right">
                                                                    <p class="text-xs text-gray-500">Profit ({{ $project->factor_profit }}%):</p>
                                                                </div>
                                                                <div>
                                                                    <p class="text-xs font-medium">${{ number_format($areaProfit, 2) }}</p>
                                                                </div>
                                                                
                                                                <div class="text-right">
                                                                    <p class="text-xs text-gray-500">Total with Profit:</p>
                                                                </div>
                                                                <div>
                                                                    <p class="text-xs font-medium">${{ number_format($calc['total_cost'] + $areaProfit, 2) }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="border-t pt-3 grid grid-cols-2 gap-4">
                                                            <div>
                                                                <p class="text-sm text-gray-600 mb-1">Price per SQFT:</p>
                                                                <p class="text-xl font-bold text-indigo-600">${{ number_format($pricePerSqft, 2) }}</p>
                                                                <p class="text-xs text-gray-500">Total Cost / SQFT</p>
                                                            </div>
                                                            
                                                            <div>
                                                                <p class="text-sm text-gray-600 mb-1">Retail Price per SQFT:</p>
                                                                <p class="text-xl font-bold text-green-600">${{ number_format($pricePerSqftWithProfit, 2) }}</p>
                                                                <p class="text-xs text-gray-500">With Profit</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        
                                        <!-- Overall Project Card -->
                                        @php
                                            // Calculate overall project metrics
                                            $overallPricePerSqft = $totalSqft > 0 ? $totalCost / $totalSqft : 0;
                                            $overallPricePerSqftWithProfit = $totalSqft > 0 ? ($totalCost + $profit) / $totalSqft : 0;
                                        @endphp
                                        
                                        <div class="rounded-lg shadow overflow-hidden">
                                            <div class="bg-gray-700 text-white px-4 py-2">
                                                <h5 class="font-medium">PROJECT OVERVIEW</h5>
                                            </div>
                                            <div class="bg-gray-100 p-4">
                                                <div class="space-y-3">
                                                    <div>
                                                        <p class="text-sm text-gray-600">Total Project Area:</p>
                                                        <p class="text-lg font-semibold">{{ number_format($totalSqft, 2) }} SQFT</p>
                                                    </div>
                                                    
                                                    <div class="border-t pt-3">
                                                        <p class="text-sm text-gray-600">Project Pricing:</p>
                                                        <div class="grid grid-cols-2 gap-2 mt-2">
                                                            <div class="text-right">
                                                                <p class="text-xs text-gray-500">Total Cost:</p>
                                                            </div>
                                                            <div>
                                                                <p class="text-xs font-medium">${{ number_format($totalCost, 2) }}</p>
                                                            </div>
                                                            
                                                            <div class="text-right">
                                                                <p class="text-xs text-gray-500">With Profit:</p>
                                                            </div>
                                                            <div>
                                                                <p class="text-xs font-medium">${{ number_format($totalCost + $profit, 2) }}</p>
                                                            </div>
                                                            
                                                            <div class="text-right">
                                                                <p class="text-xs text-gray-500">With Sinks:</p>
                                                            </div>
                                                            <div>
                                                                <p class="text-xs font-medium">${{ number_format($grandTotal, 2) }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="border-t pt-3 grid grid-cols-2 gap-4">
                                                        <div>
                                                            <p class="text-sm text-gray-600 mb-1">Average Price per SQFT:</p>
                                                            <p class="text-xl font-bold text-indigo-600">${{ number_format($overallPricePerSqft, 2) }}</p>
                                                            <p class="text-xs text-gray-500">Total Cost / SQFT</p>
                                                        </div>
                                                        
                                                        <div>
                                                            <p class="text-sm text-gray-600 mb-1">Retail Price per SQFT:</p>
                                                            <p class="text-xl font-bold text-green-600">${{ number_format($overallPricePerSqftWithProfit, 2) }}</p>
                                                            <p class="text-xs text-gray-500">With Profit</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Final Calculation Summary -->
                                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-8">
                                    <div class="col-span-2 hidden">
                                        <h4 class="text-md font-medium text-gray-900 mb-2">Calculation Factors ({{ ucfirst($project->project_type) }})</h4>
                                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                                            <div class="p-3 bg-gray-50 rounded">
                                                <span class="text-sm text-gray-600">Fabrication:</span>
                                                <p class="font-medium">${{ $project->factor_fabrication }}</p>
                                            </div>
                                            <div class="p-3 bg-gray-50 rounded">
                                                <span class="text-sm text-gray-600">Edge Polish:</span>
                                                <p class="font-medium">${{ $project->factor_edge_polish }}</p>
                                            </div>
                                            <div class="p-3 bg-gray-50 rounded">
                                                <span class="text-sm text-gray-600">Miter:</span>
                                                <p class="font-medium">${{ $project->factor_miter }}</p>
                                            </div>
                                            <div class="p-3 bg-gray-50 rounded">
                                                <span class="text-sm text-gray-600">Sink C/O:</span>
                                                <p class="font-medium">${{ $project->factor_sink_cutout }}</p>
                                            </div>
                                            <div class="p-3 bg-gray-50 rounded">
                                                <span class="text-sm text-gray-600">Cooktop C/O:</span>
                                                <p class="font-medium">${{ $project->factor_cooktop_cutout }}</p>
                                            </div>
                                            <div class="p-3 bg-gray-50 rounded">
                                                <span class="text-sm text-gray-600">Template:</span>
                                                <p class="font-medium">${{ $project->factor_template }}</p>
                                            </div>
                                            <div class="p-3 bg-gray-50 rounded">
                                                <span class="text-sm text-gray-600">Installation:</span>
                                                <p class="font-medium">${{ $project->factor_installation }}</p>
                                            </div>
                                            <div class="p-3 bg-gray-50 rounded">
                                                <span class="text-sm text-gray-600">Waste:</span>
                                                <p class="font-medium">{{ $project->factor_waste }}%</p>
                                            </div>
                                            <div class="p-3 bg-gray-50 rounded">
                                                <span class="text-sm text-gray-600">Overhead:</span>
                                                <p class="font-medium">{{ $project->factor_overhead }}%</p>
                                            </div>
                                            <div class="p-3 bg-gray-50 rounded">
                                                <span class="text-sm text-gray-600">Profit:</span>
                                                <p class="font-medium">{{ $project->factor_profit }}%</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <h4 class="text-md font-medium text-gray-900 mb-2">Final Price</h4>
                                        <div class="bg-gray-50 rounded p-4">
                                            <div class="flex justify-between border-b py-2">
                                                <span>Subtotal:</span>
                                                <span>${{ number_format($subtotal, 2) }}</span>
                                            </div>
                                            <div class="flex justify-between border-b py-2">
                                                <span>Overhead ({{ $project->factor_overhead }}%):</span>
                                                <span>${{ number_format($overhead, 2) }}</span>
                                            </div>
                                            <div class="flex justify-between border-b py-2">
                                                <span>Total Cost:</span>
                                                <span>${{ number_format($totalCost, 2) }}</span>
                                            </div>
                                            <div class="flex justify-between border-b py-2">
                                                <span>Profit ({{ $project->factor_profit }}%):</span>
                                                <span>${{ number_format($profit, 2) }}</span>
                                            </div>
                                            <div class="flex justify-between border-b py-2">
                                                <span>Sinks:</span>
                                                <span>${{ number_format($totalSinkPrice, 2) }}</span>
                                            </div>
                                            <div class="flex justify-between font-bold text-lg py-2">
                                                <span>GRAND TOTAL:</span>
                                                <span>${{ number_format($grandTotal, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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


    <!-- Summary Modal -->
<div id="summary-modal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-5xl w-full mx-4 max-h-screen overflow-y-auto">
        <div class="px-6 py-4 border-b flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-900">Project Summary</h3>
            <button id="close-modal" class="text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6" id="summary-content">
            <!-- Summary content will be loaded here -->
        </div>
    </div>
</div>

<!-- Modal Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('summary-modal');
        const showBtn = document.getElementById('show-summary-btn');
        const closeBtn = document.getElementById('close-modal');
        const summaryContent = document.getElementById('summary-content');
        
        showBtn.addEventListener('click', function() {
            // Show loading indicator
            summaryContent.innerHTML = '<div class="flex justify-center"><svg class="animate-spin h-8 w-8 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg></div>';
            
            // Show modal
            modal.classList.remove('hidden');
            
            // Fetch summary content
            fetch('{{ route('projects.summary-content', $project) }}')
                .then(response => response.text())
                .then(html => {
                    summaryContent.innerHTML = html;
                })
                .catch(error => {
                    summaryContent.innerHTML = '<div class="text-red-500">Error loading summary. Please try again.</div>';
                    console.error('Error:', error);
                });
        });
        
        closeBtn.addEventListener('click', function() {
            modal.classList.add('hidden');
        });
        
        // Close modal when clicking outside
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });
</script>
</x-layouts.app>