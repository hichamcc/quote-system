<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Place Takeoffs') }} - {{ $project->name }}
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

                    <form method="POST" action="{{ route('projects.takeoffs.store', $project) }}" class="space-y-6">
                        @csrf

                        <div id="takeoff-container">
                            <!-- Template for a single takeoff -->
                            <div class="takeoff-item border rounded-lg p-4 mb-6">
                                <div class="mb-4">
                                    <h3 class="text-lg font-medium text-gray-900">Place Takeoff #1</h3>
                                </div>

                                <!-- Place details -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <!-- AMG Job Number -->
                                    <div>
                                        <x-label for="amg_job_numbers_0">AMG Job #</x-label>
                                        <x-input id="amg_job_numbers_0" name="amg_job_numbers[]" :value="old('amg_job_numbers.0')" />
                                        @error('amg_job_numbers.0')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Place Type -->
                                    <div>
                                        <x-label for="types_0">Section Type</x-label>
                                        <select id="types_0" name="types[]" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                                            <option value="">Select a type</option>
                                            @foreach($areaTypes as $areaType)
                                                <option value="{{ $areaType->name }}" {{ old('types.0') == $areaType->name ? 'selected' : '' }}>
                                                    {{ $areaType->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('types.0')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Material Details -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <!-- Material Name -->
                                    <div>
                                        <x-label for="material_name_0">Material Name</x-label>
                                        <x-input id="material_name_0" name="material_name[]" :value="old('material_name.0')" />
                                        @error('material_name.0')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Material Price -->
                                    <div>
                                        <x-label for="material_price_0">Material Price ($)</x-label>
                                        <x-input id="material_price_0" name="material_price[]" type="number" step="0.01" :value="old('material_price.0')" />
                                        @error('material_price.0')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Supplier -->
                                    <div>
                                        <x-label for="supplier_0">Supplier</x-label>
                                        <x-input id="supplier_0" name="supplier[]" :value="old('supplier.0')" />
                                        @error('supplier.0')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Area -->
                                    <div>
                                        <x-label for="area_0">Area</x-label>
                                        <x-input id="area_0" name="area[]" :value="old('area.0')" />
                                        @error('area.0')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Piece Number -->
                                    <div>
                                        <x-label for="piece_number_0">Piece #</x-label>
                                        <x-input id="piece_number_0" name="piece_number[]" :value="old('piece_number.0')" />
                                        @error('piece_number.0')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Dimensions -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <!-- Length -->
                                    <div>
                                        <x-label for="length_0">Length</x-label>
                                        <x-input id="length_0" name="length[]" type="number" step="0.01" :value="old('length.0')" />
                                        @error('length.0')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Width -->
                                    <div>
                                        <x-label for="width_0">Width</x-label>
                                        <x-input id="width_0" name="width[]" type="number" step="0.001" :value="old('width.0')" />
                                        @error('width.0')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Polished Edge Length -->
                                    <div>
                                        <x-label for="polished_edge_length_0">Polished Edge Length</x-label>
                                        <x-input id="polished_edge_length_0" name="polished_edge_length[]" type="number" step="0.01" :value="old('polished_edge_length.0')" />
                                        @error('polished_edge_length.0')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Miter Edge Length -->
                                    <div>
                                        <x-label for="miter_edge_length_0">Miter Edge Length</x-label>
                                        <x-input id="miter_edge_length_0" name="miter_edge_length[]" type="number" step="0.01" :value="old('miter_edge_length.0')" />
                                        @error('miter_edge_length.0')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Cutouts -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <!-- Sink Cutout -->
                                    <div>
                                        <x-label for="sink_cutout_0">Sink Cutout</x-label>
                                        <x-input id="sink_cutout_0" name="sink_cutout[]" type="number" :value="old('sink_cutout.0')" />
                                        @error('sink_cutout.0')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Cooktop Cutout -->
                                    <div>
                                        <x-label for="cooktop_cutout_0">Cooktop Cutout</x-label>
                                        <x-input id="cooktop_cutout_0" name="cooktop_cutout[]" type="number" :value="old('cooktop_cutout.0')" />
                                        @error('cooktop_cutout.0')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <div class="space-x-2">
                                <button type="button" id="add-takeoff" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    + Add Another Section 
                                </button>
                                
                                <button type="button" id="duplicate-takeoff" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Duplicate Last Entry
                                </button>
                            </div>
                            
                            <x-button type="submit">
                                Save All Place Takeoffs
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add new takeoff
            let takeoffCount = 1;
            
            document.getElementById('add-takeoff').addEventListener('click', function() {
                addNewTakeoff();
            });
            
            document.getElementById('duplicate-takeoff').addEventListener('click', function() {
                duplicateLastTakeoff();
            });
            
            function addNewTakeoff(valuesToCopy = null) {
                takeoffCount++;
                const template = document.querySelector('.takeoff-item').cloneNode(true);
                
                // Update all IDs and names
                template.querySelector('h3').textContent = `Place Takeoff #${takeoffCount}`;
                
                // Update AMG Job Number input
                const jobNumberInput = template.querySelector('[id^="amg_job_numbers_"]');
                jobNumberInput.id = `amg_job_numbers_${takeoffCount-1}`;
                jobNumberInput.name = `amg_job_numbers[]`;
                jobNumberInput.value = valuesToCopy ? valuesToCopy.amgJobNumber : '';

                // Update place type select
                const typeSelect = template.querySelector('[id^="types_"]');
                typeSelect.id = `types_${takeoffCount-1}`;
                typeSelect.name = `types[]`;
                
                if (valuesToCopy && valuesToCopy.type) {
                    // Find and select the option with matching value
                    Array.from(typeSelect.options).forEach(option => {
                        if (option.value === valuesToCopy.type) {
                            option.selected = true;
                        } else {
                            option.selected = false;
                        }
                    });
                } else {
                    typeSelect.selectedIndex = 0;
                }
                
                // Update all other input fields
                const inputFields = [
                    'material_name', 'material_price', 'supplier', 'area', 'piece_number',
                    'length', 'width', 'polished_edge_length', 'miter_edge_length',
                    'sink_cutout', 'cooktop_cutout'
                ];
                
                inputFields.forEach(function(field) {
                    const input = template.querySelector(`#${field}_0`);
                    if (input) {
                        input.id = `${field}_${takeoffCount-1}`;
                        input.name = `${field}[]`;
                        
                        // If we have values to copy, set them for the specific fields
                        if (valuesToCopy && valuesToCopy[field]) {
                            input.value = valuesToCopy[field];
                        } else {
                            input.value = '';
                        }
                    }
                });
                
                // Add the new takeoff to the container
                document.getElementById('takeoff-container').appendChild(template);
            }
            
            function duplicateLastTakeoff() {
                // Get the last takeoff element
                const takeoffs = document.querySelectorAll('.takeoff-item');
                if (takeoffs.length === 0) return;
                
                const lastTakeoff = takeoffs[takeoffs.length - 1];
                
                // Extract the values we want to copy
                const valuesToCopy = {
                    amgJobNumber: lastTakeoff.querySelector('[id^="amg_job_numbers_"]').value,
                    type: lastTakeoff.querySelector('[id^="types_"]').value,
                    material_name: lastTakeoff.querySelector('[id^="material_name_"]').value,
                    material_price: lastTakeoff.querySelector('[id^="material_price_"]').value,
                    supplier: lastTakeoff.querySelector('[id^="supplier_"]').value,
                    area: lastTakeoff.querySelector('[id^="area_"]').value
                };
                
                // Add a new takeoff with the copied values
                addNewTakeoff(valuesToCopy);
            }
        });
    </script>
</x-layouts.app>