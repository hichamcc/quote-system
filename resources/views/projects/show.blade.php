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

                            
                            @if($project->share_token)
                                <button 
                                    type="button" 
                                    onclick="copyToClipboard('{{ route('shared.summary', $project->share_token) }}')"
                                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-green-300 disabled:opacity-25 transition"
                                    id="share-button"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                    </svg>
                                    Copy Share Link
                                </button>
                            @else
                                <form action="{{ route('project.generate-share-link', $project->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button 
                                        type="submit" 
                                        class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-green-300 disabled:opacity-25 transition"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                        </svg>
                                        Create Share Link
                                    </button>
                                </form>
                            @endif
                        </div>

                        <script>
                            function copyToClipboard(text) {
                                navigator.clipboard.writeText(text).then(function() {
                                    const button = document.getElementById('share-button');
                                    const originalText = button.innerHTML;
                                    
                                    button.innerHTML = `
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Copied!
                                    `;
                                    
                                    setTimeout(function() {
                                        button.innerHTML = originalText;
                                    }, 2000);
                                });
                            }
                        </script>
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
                    <div class="mt-8 p-2">
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
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Material</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
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
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $placeTakeoff->type ?? 'N/A' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $placeTakeoff->material_name ?? 'N/A' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $placeTakeoff->supplier ?? 'N/A' }}</td>
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
                    <div class="hidden mt-8">
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

                <!-- Addons Section -->
                <div class="mt-8 p-2">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Addons</h3>
                        @if($project->addons->count() > 0)
                        <div>
                            <a href="{{ route('projects.addons.create', $project) }}" class="inline-flex items-center px-3 py-2 text-xs font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Add Addons
                            </a>
                        </div>
                        @else
                            <a href="{{ route('projects.addons.create', $project) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Add Addons
                            </a>
                        @endif
                    </div>
                    
                    <!-- Addons summary -->
                    @if($project->addons->count() > 0)
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type/Area</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sink</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bracket</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Options</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($project->addons as $addon)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $addon->type ?: 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    @if($addon->sink_name || $addon->sink_model || $addon->sink_price)
                                                        <div>
                                                            @if($addon->sink_name)
                                                                <div class="font-medium">{{ $addon->sink_name }}</div>
                                                            @endif
                                                            @if($addon->sink_model)
                                                                <div class="text-xs text-gray-500">{{ $addon->sink_model }}</div>
                                                            @endif
                                                            @if($addon->sink_quantity && $addon->sink_quantity > 1)
                                                                <div class="text-xs text-blue-600">Qty: {{ $addon->sink_quantity }}</div>
                                                            @endif
                                                            @if($addon->sink_price)
                                                                <div class="text-xs text-green-600">${{ number_format($addon->sink_price * ($addon->sink_quantity ?? 1), 2) }}</div>
                                                            @endif
                                                        </div>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    @if($addon->bracket_name || $addon->bracket_model || $addon->bracket_price)
                                                        <div>
                                                            @if($addon->bracket_name)
                                                                <div class="font-medium">{{ $addon->bracket_name }}</div>
                                                            @endif
                                                            @if($addon->bracket_model)
                                                                <div class="text-xs text-gray-500">{{ $addon->bracket_model }}</div>
                                                            @endif
                                                            @if($addon->bracket_quantity && $addon->bracket_quantity > 1)
                                                                <div class="text-xs text-blue-600">Qty: {{ $addon->bracket_quantity }}</div>
                                                            @endif
                                                            @if($addon->bracket_price)
                                                                <div class="text-xs text-green-600">${{ number_format($addon->bracket_price * ($addon->bracket_quantity ?? 1), 2) }}</div>
                                                            @endif
                                                        </div>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-900">
                                                    <div class="space-y-1">
                                                        @if($addon->edge)
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                Edge {{ $addon->edge_type ? '(' . $addon->edge_type . ')' : '' }}: ${{ number_format($addon->edge_price ?? 0, 2) }}/LF
                                                            </span>
                                                        @endif
                                                        @if($addon->plumbing)
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                                Plumbing: ${{ number_format($addon->plumbing_price ?? 0, 2) }}
                                                                @if($addon->plumbing_details)
                                                                    <span class="ml-1" title="{{ $addon->plumbing_details }}">ℹ️</span>
                                                                @endif
                                                            </span>
                                                        @endif
                                                        @if($addon->demo)
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                                Demo: ${{ number_format($addon->demo_price ?? 0, 2) }}
                                                            </span>
                                                        @endif
                                                        @if($addon->vein_exact_match)
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                                Vein Match: ${{ number_format($addon->vein_exact_match_price ?? 0, 2) }}
                                                            </span>
                                                        @endif
                                                        @if($addon->electrical_cutout)
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                                {{ $addon->electrical_cutout_quantity }} Electrical: ${{ number_format($addon->electrical_cutout_price ?? 0, 2) }}/unit
                                                            </span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <div class="flex space-x-2">
                                                        <a href="{{ route('projects.addons.show', [$project, $addon]) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                                        <a href="{{ route('projects.addons.edit', [$project, $addon]) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                                        <form method="POST" action="{{ route('projects.addons.destroy', [$project, $addon]) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this addon?');">
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
                            No addons added yet. 
                            <a href="{{ route('projects.addons.create', $project) }}" class="text-indigo-600 hover:text-indigo-900">
                                Add addons
                            </a> 
                            to specify additional components and services for this project.
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
            <!-- Pricing Calculation Section -->
            <div class="mt-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Project Pricing Calculation</h3>
                
                @php
                    // Get all takeoffs grouped by type
                    $takeoffsByType = $project->placeTakeoffs->groupBy('type');
                    
                    // Get all addons grouped by type
                    $addonsByType = $project->addons->groupBy('type');
                    
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
                    $totalProfit = 0;
                    $totalAddonsCost = 0;
                    
                    // Arrays to store calculations by type
                    $calculations = [];
                    
                    // Get customer type for pricing calculations
                    $customerType = $project->customer_type ?? 'residential';
                @endphp

                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <!-- Pricing Calculation Table -->
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
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profit</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Addons</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($takeoffsByType as $type => $takeoffs)
                                    @php
                                        // Calculate core service costs for this type
                                        $typeData = [
                                            'sqft' => 0,
                                            'material' => 0,
                                            'fabrication' => 0,
                                            'edge_polish' => 0,
                                            'miter' => 0,
                                            'sink_cutout' => 0,
                                            'cooktop_cutout' => 0,
                                            'template' => 0,
                                            'installation' => 0,
                                            'addons' => 0
                                        ];
                                        
                                        // Process takeoffs for this type
                                        foreach($takeoffs as $takeoff) {
                                            $sqft = calculateSqft($takeoff->length, $takeoff->width);
                                            $typeData['sqft'] += $sqft;
                                            $typeData['material'] += $sqft * $project->calculateSqftCost($takeoff->material_price ?? 0);
                                            $typeData['fabrication'] += $project->calculateFabricationCost($sqft);
                                            $typeData['edge_polish'] += $project->calculateEdgePolishCost(inchesToLinearFeet($takeoff->polished_edge_length));
                                            $typeData['miter'] += $project->calculateMiterCost(inchesToLinearFeet($takeoff->miter_edge_length));
                                            $typeData['sink_cutout'] += $project->calculateSinkCutoutCost($takeoff->sink_cutout ?? 0);
                                            $typeData['cooktop_cutout'] += $project->calculateCooktopCutoutCost($takeoff->cooktop_cutout ?? 0);
                                            $typeData['template'] += $project->calculateTemplateCost($sqft);
                                            $typeData['installation'] += $project->calculateInstallationCost($sqft);
                                        }
                                        
                                        // Calculate addons for this type
                                        if (isset($addonsByType[$type])) {
                                            foreach($addonsByType[$type] as $addon) {
                                                $addonCost = 0;
                                                
                                                // Add sink costs
                                                $addonCost += ($addon->sink_price ?? 0) * ($addon->sink_quantity ?? 1);
                                                
                                                // Add bracket costs
                                                $addonCost += ($addon->bracket_price ?? 0) * ($addon->bracket_quantity ?? 1);
                                                
                                                // Add edge costs - multiply by polished edge linear feet only for this area type
                                                if ($addon->edge && ($addon->edge_price ?? 0) > 0) {
                                                    $polishedLinearFeet = 0;
                                                    foreach($takeoffs as $takeoff) {
                                                        $polishedLinearFeet += inchesToLinearFeet($takeoff->polished_edge_length ?? 0);
                                                    }
                                                    $addonCost += ($addon->edge_price ?? 0) * $polishedLinearFeet;
                                                }
                                                
                                                // Add other service costs
                                                $addonCost += ($addon->demo_price ?? 0);
                                                $addonCost += ($addon->vein_exact_match_price ?? 0);
                                                $addonCost += ($addon->electrical_cutout_price ?? 0) * ($addon->electrical_cutout_quantity ?? 1);
                                                $addonCost += ($addon->plumbing_price ?? 0);
                                                
                                                $typeData['addons'] += $addonCost;
                                            }
                                        }
                                        
                                        // Calculate core services subtotal
                                        $typeData['subtotal'] = $typeData['material'] + $typeData['fabrication'] + $typeData['edge_polish'] + 
                                                            $typeData['miter'] + $typeData['sink_cutout'] + $typeData['cooktop_cutout'] + 
                                                            $typeData['template'] + $typeData['installation'];
                                        
                                        // Calculate overhead on core services
                                        $typeData['overhead'] = $project->calculateOverhead($typeData['subtotal']);
                                        
                                        // Calculate profit on core services + overhead
                                        $typeData['profit'] = $project->calculateProfit($typeData['subtotal'] + $typeData['overhead']);
                                        
                                        // Calculate final total
                                        $typeData['total'] = $typeData['subtotal'] + $typeData['overhead'] + $typeData['profit'] + $typeData['addons'];
                                        
                                        // Add to global totals
                                        $totalSqft += $typeData['sqft'];
                                        $totalMaterialCost += $typeData['material'];
                                        $totalFabricationCost += $typeData['fabrication'];
                                        $totalEdgePolishCost += $typeData['edge_polish'];
                                        $totalMiterCost += $typeData['miter'];
                                        $totalSinkCutoutCost += $typeData['sink_cutout'];
                                        $totalCooktopCutoutCost += $typeData['cooktop_cutout'];
                                        $totalTemplateCost += $typeData['template'];
                                        $totalInstallationCost += $typeData['installation'];
                                        $totalOverhead += $typeData['overhead'];
                                        $totalProfit += $typeData['profit'];
                                        $totalAddonsCost += $typeData['addons'];
                                        
                                        // Store calculations for this type
                                        $calculations[$type] = $typeData;
                                    @endphp
                                    
                                    <tr class="{{ $loop->index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $type }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($typeData['sqft'], 2) }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($typeData['material'], 2) }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($typeData['fabrication'], 2) }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($typeData['edge_polish'], 2) }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($typeData['miter'], 2) }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($typeData['sink_cutout'], 2) }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($typeData['cooktop_cutout'], 2) }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($typeData['template'], 2) }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($typeData['installation'], 2) }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($typeData['subtotal'], 2) }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($typeData['overhead'], 2) }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-green-600">${{ number_format($typeData['profit'], 2) }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-blue-600">${{ number_format($typeData['addons'], 2) }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900">${{ number_format($typeData['total'], 2) }}</td>
                                    </tr>
                                @endforeach
                                
                                @php
                                    // Calculate project totals
                                    $coreSubtotal = $totalMaterialCost + $totalFabricationCost + $totalEdgePolishCost + 
                                                $totalMiterCost + $totalSinkCutoutCost + $totalCooktopCutoutCost + 
                                                $totalTemplateCost + $totalInstallationCost;
                                    $projectTotal = $coreSubtotal + $totalOverhead + $totalProfit + $totalAddonsCost;
                                @endphp
                                
                                <!-- Project Totals Row -->
                                <tr class="bg-gray-200 font-bold">
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
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900">${{ number_format($coreSubtotal, 2) }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900">${{ number_format($totalOverhead, 2) }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-green-600">${{ number_format($totalProfit, 2) }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-blue-600">${{ number_format($totalAddonsCost, 2) }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900">${{ number_format($projectTotal, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Price Analysis by Area Type -->
                        <div class="mt-8">
                            <h4 class="text-md font-medium text-gray-900 mb-4">Price Analysis by Area Type</h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @php
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
                                    ];
                                    
                                    $colorIndex = 0;
                                @endphp
                                
                                @foreach($calculations as $type => $calc)
                                    @if($calc['sqft'] > 0)
                                        @php
                                            $colors = $colorPalette[$colorIndex++ % count($colorPalette)];
                                            $corePrice = ($calc['subtotal'] + $calc['overhead'] + $calc['profit']) / $calc['sqft'];
                                            $totalPrice = $calc['total'] / $calc['sqft'];
                                        @endphp
                                        
                                        <div class="rounded-lg shadow overflow-hidden">
                                            <div class="{{ $colors['header'] }} px-4 py-2">
                                                <h5 class="font-medium text-gray-900">{{ $type }}</h5>
                                            </div>
                                            <div class="{{ $colors['bg'] }} p-4">
                                                <div class="space-y-3">
                                                    <div>
                                                        <p class="text-sm text-gray-600">Total Area:</p>
                                                        <p class="text-lg font-semibold">{{ number_format($calc['sqft'], 2) }} SQFT</p>
                                                    </div>
                                                    
                                                    <div class="border-t pt-3">
                                                        <p class="text-sm text-gray-600">Cost Breakdown:</p>
                                                        <div class="grid grid-cols-2 gap-2 mt-2 text-xs">
                                                            <div class="text-right text-gray-500">Core Services:</div>
                                                            <div class="font-medium">${{ number_format($calc['subtotal'], 2) }}</div>
                                                            
                                                            <div class="text-right text-gray-500">Overhead:</div>
                                                            <div class="font-medium">${{ number_format($calc['overhead'], 2) }}</div>
                                                            
                                                            <div class="text-right text-gray-500">Profit:</div>
                                                            <div class="font-medium text-green-600">${{ number_format($calc['profit'], 2) }}</div>
                                                            
                                                            <div class="text-right text-blue-600">Addons:</div>
                                                            <div class="font-medium text-blue-600">${{ number_format($calc['addons'], 2) }}</div>
                                                            
                                                            <div class="text-right text-gray-500">Total:</div>
                                                            <div class="font-medium">${{ number_format($calc['total'], 2) }}</div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Addons Details -->
                                                    @if(isset($addonsByType[$type]) && count($addonsByType[$type]) > 0)
                                                        <div class="border-t pt-3">
                                                            <p class="text-sm text-blue-600 mb-2">Addons Details:</p>
                                                            <div class="space-y-1 max-h-20 overflow-y-auto">
                                                                @foreach($addonsByType[$type] as $addon)
                                                                    <div class="text-xs bg-blue-100 rounded px-2 py-1">
                                                                        @if($addon->sink_name)
                                                                            <div>Sink: {{ $addon->sink_name }} 
                                                                                @if($addon->sink_quantity > 1)({{ $addon->sink_quantity }}x)@endif - 
                                                                                <span class="text-blue-600">${{ number_format(($addon->sink_price ?? 0) * ($addon->sink_quantity ?? 1), 2) }}</span>
                                                                            </div>
                                                                        @endif
                                                                        @if($addon->bracket_name)
                                                                            <div>Bracket: {{ $addon->bracket_name }} 
                                                                                @if($addon->bracket_quantity > 1)({{ $addon->bracket_quantity }}x)@endif - 
                                                                                <span class="text-blue-600">${{ number_format(($addon->bracket_price ?? 0) * ($addon->bracket_quantity ?? 1), 2) }}</span>
                                                                            </div>
                                                                        @endif
                                                                        @if($addon->edge)
                                                                            @php
                                                                                // Calculate polished edge linear feet for this area type only
                                                                                $polishedLinearFeet = 0;
                                                                                if (isset($takeoffsByType[$type])) {
                                                                                    foreach($takeoffsByType[$type] as $takeoff) {
                                                                                        $polishedLinearFeet += inchesToLinearFeet($takeoff->polished_edge_length ?? 0);
                                                                                    }
                                                                                }
                                                                                $edgeTotalCost = ($addon->edge_price ?? 0) * $polishedLinearFeet;
                                                                            @endphp
                                                                            <div>Edge ({{ $addon->edge_type }}): {{ number_format($polishedLinearFeet, 2) }} LF × ${{ number_format($addon->edge_price ?? 0, 2) }} = <span class="text-blue-600">${{ number_format($edgeTotalCost, 2) }}</span></div>
                                                                        @endif
                                                                        @if($addon->demo)
                                                                            <div>Demo: <span class="text-blue-600">${{ number_format($addon->demo_price ?? 0, 2) }}</span></div>
                                                                        @endif
                                                                        @if($addon->vein_exact_match)
                                                                            <div>Vein Match: <span class="text-blue-600">${{ number_format($addon->vein_exact_match_price ?? 0, 2) }}</span></div>
                                                                        @endif
                                                                        @if($addon->electrical_cutout)
                                                                            <div>Electrical ({{ $addon->electrical_cutout_quantity }}x): {{ $addon->electrical_cutout_quantity }} × ${{ number_format(($addon->electrical_cutout_price ?? 0) ) }} = <span class="text-blue-600">${{ number_format(($addon->electrical_cutout_price ?? 0) * ($addon->electrical_cutout_quantity ?? 1), 2) }}</span></div>
                                                                        @endif
                                                                        @if($addon->plumbing)
                                                                            <div>Plumbing: <span class="text-blue-600">${{ number_format($addon->plumbing_price ?? 0, 2) }}</span></div>
                                                                        @endif
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                    
                                                    <div class="border-t pt-3 grid grid-cols-2 gap-4">
                                                        <div>
                                                            <p class="text-sm text-gray-600 mb-1">Core Price/SQFT:</p>
                                                            <p class="text-xl font-bold text-indigo-600">${{ number_format($corePrice, 2) }}</p>
                                                            <p class="text-xs text-gray-500">Base + OH + Profit</p>
                                                        </div>
                                                        
                                                        <div>
                                                            <p class="text-sm text-gray-600 mb-1">Total Price/SQFT:</p>
                                                            <p class="text-xl font-bold text-green-600">${{ number_format($totalPrice, 2) }}</p>
                                                            <p class="text-xs text-gray-500">Including Addons</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                
                                <!-- Overall Project Card -->
                                @php
                                    $overallCorePrice = $totalSqft > 0 ? ($coreSubtotal + $totalOverhead + $totalProfit) / $totalSqft : 0;
                                    $overallTotalPrice = $totalSqft > 0 ? $projectTotal / $totalSqft : 0;
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
                                                <div class="grid grid-cols-2 gap-2 mt-2 text-xs">
                                                    <div class="text-right text-gray-500">Core Services:</div>
                                                    <div class="font-medium">${{ number_format($coreSubtotal, 2) }}</div>
                                                    
                                                    <div class="text-right text-gray-500">Overhead:</div>
                                                    <div class="font-medium">${{ number_format($totalOverhead, 2) }}</div>
                                                    
                                                    <div class="text-right text-gray-500">Profit:</div>
                                                    <div class="font-medium text-green-600">${{ number_format($totalProfit, 2) }}</div>
                                                    
                                                    <div class="text-right text-blue-600">Addons:</div>
                                                    <div class="font-medium text-blue-600">${{ number_format($totalAddonsCost, 2) }}</div>
                                                    
                                                    <div class="text-right text-gray-500">Final Total:</div>
                                                    <div class="font-medium">${{ number_format($projectTotal, 2) }}</div>
                                                </div>
                                            </div>
                                            
                                            <div class="border-t pt-3 grid grid-cols-2 gap-4">
                                                <div>
                                                    <p class="text-sm text-gray-600 mb-1">Core Price/SQFT:</p>
                                                    <p class="text-xl font-bold text-indigo-600">${{ number_format($overallCorePrice, 2) }}</p>
                                                    <p class="text-xs text-gray-500">Base + OH + Profit</p>
                                                </div>
                                                
                                                <div>
                                                    <p class="text-sm text-gray-600 mb-1">Total Price/SQFT:</p>
                                                    <p class="text-xl font-bold text-green-600">${{ number_format($overallTotalPrice, 2) }}</p>
                                                    <p class="text-xs text-gray-500">Including Addons</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Final Pricing Summary -->
                        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="col-span-2">
                                <h4 class="text-md font-medium text-gray-900 mb-4">Addons Summary</h4>
                                <div class="bg-blue-50 rounded-lg p-4">
                                    @php
                                        $addonCategories = [
                                            'sinks' => 0,
                                            'brackets' => 0,
                                            'edge_services' => 0,
                                            'other_services' => 0
                                        ];
                                        
                                        foreach($project->addons as $addon) {
                                            $addonCategories['sinks'] += ($addon->sink_price ?? 0) * ($addon->sink_quantity ?? 1);
                                            $addonCategories['brackets'] += ($addon->bracket_price ?? 0) * ($addon->bracket_quantity ?? 1);
                                            
                                            // Calculate edge services with correct linear feet pricing
                                            if ($addon->edge && ($addon->edge_price ?? 0) > 0) {
                                                // Find the area type for this addon and calculate polished edge LF
                                                $addonAreaType = $addon->type;
                                                $polishedLinearFeet = 0;
                                                
                                                if (isset($takeoffsByType[$addonAreaType])) {
                                                    foreach($takeoffsByType[$addonAreaType] as $takeoff) {
                                                        $polishedLinearFeet += inchesToLinearFeet($takeoff->polished_edge_length ?? 0);
                                                    }
                                                }
                                                
                                                $addonCategories['edge_services'] += ($addon->edge_price ?? 0) * $polishedLinearFeet;
                                            }
                                            
                                            $addonCategories['other_services'] += ($addon->demo_price ?? 0) + 
                                                                                ($addon->vein_exact_match_price ?? 0) + 
                                                                                (($addon->electrical_cutout_price ?? 0) * ($addon->electrical_cutout_quantity ?? 1)) + 
                                                                                ($addon->plumbing_price ?? 0);
                                        }
                                    @endphp
                                    
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="p-3 bg-white rounded border-l-4 border-blue-500">
                                            <span class="text-sm text-gray-600">Sinks:</span>
                                            <p class="font-bold text-lg">${{ number_format($addonCategories['sinks'], 2) }}</p>
                                        </div>
                                        
                                        <div class="p-3 bg-white rounded border-l-4 border-green-500">
                                            <span class="text-sm text-gray-600">Brackets:</span>
                                            <p class="font-bold text-lg">${{ number_format($addonCategories['brackets'], 2) }}</p>
                                        </div>
                                        
                                        <div class="p-3 bg-white rounded border-l-4 border-purple-500">
                                            <span class="text-sm text-gray-600">Edge Services:</span>
                                            <p class="font-bold text-lg">${{ number_format($addonCategories['edge_services'], 2) }}</p>
                                        </div>
                                        
                                        <div class="p-3 bg-white rounded border-l-4 border-orange-500">
                                            <span class="text-sm text-gray-600">Other Services:</span>
                                            <p class="font-bold text-lg">${{ number_format($addonCategories['other_services'], 2) }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 p-3 bg-blue-200 rounded">
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm font-medium text-blue-900">Total Addons:</span>
                                            <span class="text-xl font-bold text-blue-900">${{ number_format($totalAddonsCost, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <h4 class="text-md font-medium text-gray-900 mb-2">Final Project Price</h4>
                                <div class="bg-gray-50 rounded p-4">
                                    <div class="flex justify-between border-b py-2">
                                        <span>Core Services:</span>
                                        <span>${{ number_format($coreSubtotal, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between border-b py-2">
                                        <span>Overhead ({{ $project->factor_overhead }}%):</span>
                                        <span>${{ number_format($totalOverhead, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between border-b py-2">
                                        <span>Profit ({{ $project->factor_profit }}%):</span>
                                        <span class="text-green-600">${{ number_format($totalProfit, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between border-b py-2">
                                        <span class="text-blue-600">Addons/Sinks:</span>
                                        <span class="text-blue-600">${{ number_format($totalAddonsCost, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between font-bold text-lg py-2 bg-green-100 rounded px-2">
                                        <span>FINAL TOTAL:</span>
                                        <span class="text-green-600">${{ number_format($projectTotal, 2) }}</span>
                                    </div>
                                    
                                    <!-- Price per SQFT Summary -->
                                    <div class="mt-4 pt-4 border-t">
                                        <div class="grid grid-cols-2 gap-4 text-center">
                                            <div class="bg-indigo-100 rounded p-3">
                                                <p class="text-xs text-indigo-600 mb-1">Core/SQFT</p>
                                                <p class="text-lg font-bold text-indigo-800">${{ number_format($overallCorePrice, 2) }}</p>
                                            </div>
                                            <div class="bg-green-100 rounded p-3">
                                                <p class="text-xs text-green-600 mb-1">Total/SQFT</p>
                                                <p class="text-lg font-bold text-green-800">${{ number_format($overallTotalPrice, 2) }}</p>
                                            </div>
                                        </div>
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