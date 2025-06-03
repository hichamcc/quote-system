<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibent text-xl text-gray-800 leading-tight">
            Addon Details - {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <!-- Navigation -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <a href="{{ route('projects.addons.index', $project) }}" class="text-indigo-600 hover:text-indigo-900">
                                &larr; Back to Addons
                            </a>
                        </div>
                        <div class="space-x-2">
                            <a href="{{ route('projects.addons.edit', [$project, $addon]) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:ring focus:ring-yellow-300 disabled:opacity-25 transition">
                                Edit Addon
                            </a>
                            <form action="{{ route('projects.addons.destroy', [$project, $addon]) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this addon?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition">
                                    Delete Addon
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Addon Details -->
                    <div class="space-y-6">
                        
                        <!-- Area Information -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Area Information</h3>
                            <div class="text-sm text-gray-600">
                                <strong>Type/Area:</strong> {{ $addon->type ?: 'Not specified' }}
                            </div>
                        </div>

                        <!-- Sink Details -->
                        @if($addon->sink_name || $addon->sink_model || $addon->sink_price)
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Sink Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                                <div>
                                    <strong>Model:</strong> {{ $addon->sink_model ?: 'Not specified' }}
                                </div>
                                <div>
                                    <strong>Name:</strong> {{ $addon->sink_name ?: 'Not specified' }}
                                </div>
                                <div>
                                    <strong>Quantity:</strong> {{ $addon->sink_quantity ?: 1 }}
                                </div>
                                <div>
                                    <strong>Unit Price:</strong> {{ $addon->sink_price ? '$' . number_format($addon->sink_price, 2) : 'Not specified' }}
                                </div>
                                @if($addon->sink_price && $addon->sink_quantity)
                                <div class="md:col-span-2">
                                    <strong>Total Price:</strong> ${{ number_format($addon->sink_price * $addon->sink_quantity, 2) }}
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Bracket Details -->
                        @if($addon->bracket_name || $addon->bracket_model || $addon->bracket_price)
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Bracket Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                                <div>
                                    <strong>Model:</strong> {{ $addon->bracket_model ?: 'Not specified' }}
                                </div>
                                <div>
                                    <strong>Name:</strong> {{ $addon->bracket_name ?: 'Not specified' }}
                                </div>
                                <div>
                                    <strong>Quantity:</strong> {{ $addon->bracket_quantity ?: 1 }}
                                </div>
                                <div>
                                    <strong>Unit Price:</strong> {{ $addon->bracket_price ? '$' . number_format($addon->bracket_price, 2) : 'Not specified' }}
                                </div>
                                @if($addon->bracket_price && $addon->bracket_quantity)
                                <div class="md:col-span-2">
                                    <strong>Total Price:</strong> ${{ number_format($addon->bracket_price * $addon->bracket_quantity, 2) }}
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Optional Services -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Optional Services</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                
                                <!-- Edge -->
                                <div class="flex items-center justify-between p-3 bg-white rounded border">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            @if($addon->edge)
                                                <div class="h-4 w-4 bg-green-500 rounded-full"></div>
                                            @else
                                                <div class="h-4 w-4 bg-gray-300 rounded-full"></div>
                                            @endif
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Edge</p>
                                            @if($addon->edge && $addon->edge_type)
                                                <p class="text-xs text-gray-500">{{ $addon->edge_type }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        @if($addon->edge)
                                            ${{ number_format($addon->edge_price ?? 0, 2) }}
                                        @else
                                            Not selected
                                        @endif
                                    </div>
                                </div>

                                <!-- Plumbing -->
                                <div class="flex items-center justify-between p-3 bg-white rounded border">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            @if($addon->plumbing)
                                                <div class="h-4 w-4 bg-green-500 rounded-full"></div>
                                            @else
                                                <div class="h-4 w-4 bg-gray-300 rounded-full"></div>
                                            @endif
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Plumbing</p>
                                            @if($addon->plumbing && $addon->plumbing_details)
                                                <p class="text-xs text-gray-500 mt-1">{{ Str::limit($addon->plumbing_details, 50) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        @if($addon->plumbing)
                                            ${{ number_format($addon->plumbing_price ?? 0, 2) }}
                                        @else
                                            Not selected
                                        @endif
                                    </div>
                                </div>

                                <!-- Demo -->
                                <div class="flex items-center justify-between p-3 bg-white rounded border">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            @if($addon->demo)
                                                <div class="h-4 w-4 bg-green-500 rounded-full"></div>
                                            @else
                                                <div class="h-4 w-4 bg-gray-300 rounded-full"></div>
                                            @endif
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Demo</p>
                                        </div>
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        @if($addon->demo)
                                            ${{ number_format($addon->demo_price ?? 0, 2) }}
                                        @else
                                            Not selected
                                        @endif
                                    </div>
                                </div>

                                <!-- Vein Exact Match -->
                                <div class="flex items-center justify-between p-3 bg-white rounded border">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            @if($addon->vein_exact_match)
                                                <div class="h-4 w-4 bg-green-500 rounded-full"></div>
                                            @else
                                                <div class="h-4 w-4 bg-gray-300 rounded-full"></div>
                                            @endif
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Vein Exact Match</p>
                                        </div>
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        @if($addon->vein_exact_match)
                                            ${{ number_format($addon->vein_exact_match_price ?? 0, 2) }}
                                        @else
                                            Not selected
                                        @endif
                                    </div>
                                </div>

                                <!-- Electrical Cutout -->
                                <div class="flex items-center justify-between p-3 bg-white rounded border">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            @if($addon->electrical_cutout)
                                                <div class="h-4 w-4 bg-green-500 rounded-full"></div>
                                            @else
                                                <div class="h-4 w-4 bg-gray-300 rounded-full"></div>
                                            @endif
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Electrical Cutout</p>
                                            @if($addon->electrical_cutout && $addon->electrical_cutout_quantity)
                                                <p class="text-xs text-gray-500">Quantity: {{ $addon->electrical_cutout_quantity }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        @if($addon->electrical_cutout)
                                            ${{ number_format(($addon->electrical_cutout_price ?? 0) * ($addon->electrical_cutout_quantity ?? 1), 2) }}
                                        @else
                                            Not selected
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Plumbing Details (if provided) -->
                        @if($addon->plumbing && $addon->plumbing_details)
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                            <h4 class="text-md font-medium text-blue-900 mb-2">Plumbing Details</h4>
                            <p class="text-sm text-blue-800">{{ $addon->plumbing_details }}</p>
                        </div>
                        @endif

                        <!-- Total Cost -->
                        <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-200">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-medium text-indigo-900">Total Addon Cost</h3>
                                <span class="text-2xl font-bold text-indigo-900">${{ number_format($addon->total_cost, 2) }}</span>
                            </div>
                        </div>

                        <!-- Timestamps -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Record Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                                <div>
                                    <strong>Created:</strong> {{ $addon->created_at->format('M j, Y g:i A') }}
                                </div>
                                <div>
                                    <strong>Last Updated:</strong> {{ $addon->updated_at->format('M j, Y g:i A') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>