<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Sinks') }} - {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('projects.show', $project) }}" class="text-indigo-600 hover:text-indigo-900">
                            &larr; Back to Project
                        </a>
                    </div>

                    <form method="POST" action="{{ route('projects.sinks.store', $project) }}" class="space-y-6">
                        @csrf

                        <div id="sink-container">
                            <!-- Template for a single sink -->
                            <div class="sink-item border rounded-lg p-4 mb-6">
                                <div class="mb-4">
                                    <h3 class="text-lg font-medium text-gray-900">Sink #1</h3>
                                </div>

                                <!-- Sink Area -->
                                <div class="mb-4">
                                    <x-label for="sink_areas_0">Sink Area</x-label>
                                    <x-input id="sink_areas_0" name="sink_areas[]" :value="old('sink_areas.0')" required />
                                    @error('sink_areas.0')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <!-- Brand -->
                                    <div>
                                        <x-label for="brands_0">Brand</x-label>
                                        <x-input id="brands_0" name="brands[]" :value="old('brands.0')" required />
                                        @error('brands.0')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Model -->
                                    <div>
                                        <x-label for="models_0">Model</x-label>
                                        <x-input id="models_0" name="models[]" :value="old('models.0')" required />
                                        @error('models.0')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <!-- Price -->
                                    <div>
                                        <x-label for="prices_0">Price ($)</x-label>
                                        <x-input id="prices_0" name="prices[]" type="number" step="0.01" :value="old('prices.0')" required />
                                        @error('prices.0')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Quantity -->
                                    <div>
                                        <x-label for="quantities_0">Quantity</x-label>
                                        <x-input id="quantities_0" name="quantities[]" type="number" min="1" :value="old('quantities.0', 1)" required />
                                        @error('quantities.0')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <button type="button" id="add-sink" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                + Add Another Sink
                            </button>
                            
                            <x-button type="submit">
                                Save All Sinks
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add new sink
            let sinkCount = 1;
            document.getElementById('add-sink').addEventListener('click', function() {
                sinkCount++;
                const template = document.querySelector('.sink-item').cloneNode(true);
                
                // Update all IDs and names
                template.querySelector('h3').textContent = `Sink #${sinkCount}`;
                
                // Update sink area input
                const sinkAreaInput = template.querySelector('[id^="sink_areas_"]');
                sinkAreaInput.id = `sink_areas_${sinkCount-1}`;
                sinkAreaInput.name = `sink_areas[]`;
                sinkAreaInput.value = '';
                
                // Update all other input fields
                const inputFields = [
                    'brands', 'models', 'prices', 'quantities'
                ];
                
                inputFields.forEach(function(field) {
                    const input = template.querySelector(`#${field}_0`);
                    if (input) {
                        input.id = `${field}_${sinkCount-1}`;
                        input.name = `${field}[]`;
                        input.value = field === 'quantities' ? '1' : '';
                    }
                });
                
                // Add the new sink to the container
                document.getElementById('sink-container').appendChild(template);
            });
        });
    </script>
</x-layouts.app>