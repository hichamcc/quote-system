<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Addons for {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <!-- Navigation and Actions -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <a href="{{ route('projects.show', $project) }}" class="text-indigo-600 hover:text-indigo-900">
                                &larr; Back to Project
                            </a>
                        </div>
                        <a href="{{ route('projects.addons.create', $project) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition">
                            Add New Addon
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($addons->count() > 0)
                        <!-- Addons Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type/Area</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sink</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bracket</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Options</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($addons as $addon)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $addon->type ?: 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                @if($addon->sink_name || $addon->sink_model)
                                                    <div>
                                                        @if($addon->sink_name)
                                                            <div class="font-medium">{{ $addon->sink_name }}</div>
                                                        @endif
                                                        @if($addon->sink_model)
                                                            <div class="text-xs text-gray-500">{{ $addon->sink_model }}</div>
                                                        @endif
                                                      
                                                            <div class="text-xs text-blue-600">Qty: {{ $addon->sink_quantity }}</div>
                                                     
                                                        @if($addon->sink_price)
                                                            <div class="text-xs text-green-600">${{ number_format($addon->sink_price * ($addon->sink_quantity ?? 1), 2) }}</div>
                                                        @endif
                                                    </div>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                @if($addon->bracket_name || $addon->bracket_model)
                                                    <div>
                                                        @if($addon->bracket_name)
                                                            <div class="font-medium">{{ $addon->bracket_name }}</div>
                                                        @endif
                                                        @if($addon->bracket_model)
                                                            <div class="text-xs text-gray-500">{{ $addon->bracket_model }}</div>
                                                        @endif
                                                        <div class="text-xs text-blue-600">Qty: {{ $addon->bracket_quantity }}</div>
                                                        @if($addon->bracket_price)
                                                            <div class="text-xs text-green-600">${{ number_format($addon->bracket_price  * ($addon->bracket_quantity ?? 1), 2) }}</div>
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
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                                <a href="{{ route('projects.addons.show', [$project, $addon]) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                                <a href="{{ route('projects.addons.edit', [$project, $addon]) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                                <form action="{{ route('projects.addons.destroy', [$project, $addon]) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this addon?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $addons->links() }}
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No addons</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by creating a new addon for this project.</p>
                            <div class="mt-6">
                                <a href="{{ route('projects.addons.create', $project) }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Add First Addon
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>