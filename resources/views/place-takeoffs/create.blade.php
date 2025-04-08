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

                                <!-- Place Selection -->
                                <div class="mb-4">
                                    <x-label for="places_0">Place</x-label>
                                    <x-select id="places_0" name="places[]" required>
                                        <option value="">Select a place</option>
                                        <option value="Bathroom" {{ old('places.0') == 'Bathroom' ? 'selected' : '' }}>Bathroom</option>
                                        <option value="Kitchen" {{ old('places.0') == 'Kitchen' ? 'selected' : '' }}>Kitchen</option>
                                        <option value="Common Area" {{ old('places.0') == 'Common Area' ? 'selected' : '' }}>Common Area</option>
                                    </x-select>
                                    @error('places.0')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Top Section Toggle -->
                                <div class="mb-4">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="has_top_0" name="has_top[0]" value="1" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" {{ old('has_top.0') ? 'checked' : '' }}>
                                        <label for="has_top_0" class="ml-2 block text-sm text-gray-900">Add Top</label>
                                    </div>
                                </div>

                                <!-- Top Details (Initially Hidden) -->
                                <div id="top_details_0" class="top-details border-l-4 border-indigo-300 pl-4 mb-4 {{ old('has_top.0') ? '' : 'hidden' }}">
                                    <h4 class="font-medium text-gray-900 mb-2">Top Details</h4>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Top Elevation -->
                                        <div>
                                            <x-label for="top_elevation_0">Elevation</x-label>
                                            <x-input id="top_elevation_0" name="top_elevation[0]" :value="old('top_elevation.0')" />
                                        </div>

                                        <!-- Top Detail -->
                                        <div>
                                            <x-label for="top_detail_0">Detail</x-label>
                                            <x-input id="top_detail_0" name="top_detail[0]" :value="old('top_detail.0')" />
                                        </div>

                                        <!-- Top Area -->
                                        <div>
                                            <x-label for="top_area_0">Area</x-label>
                                            <x-input id="top_area_0" name="top_area[0]" :value="old('top_area.0')" />
                                        </div>

                                        <!-- Top Color -->
                                        <div>
                                            <x-label for="top_color_0">Color</x-label>
                                            <x-input id="top_color_0" name="top_color[0]" :value="old('top_color.0')" />
                                        </div>

                                        <!-- Top Supplier Brand -->
                                        <div>
                                            <x-label for="top_supplier_brand_0">Supplier Brand</x-label>
                                            <x-input id="top_supplier_brand_0" name="top_supplier_brand[0]" :value="old('top_supplier_brand.0')" />
                                        </div>

                                        <!-- Top Type -->
                                        <div>
                                            <x-label for="top_type_0">Type</x-label>
                                            <x-input id="top_type_0" name="top_type[0]" :value="old('top_type.0')" />
                                        </div>


                                        <!-- Top unit_qty -->
                                        <div>
                                            <x-label for="top_unit_qty_0">Unit Qty</x-label>
                                            <x-input id="top_unit_qty_0" name="top_unit_qty[0]" type="number" :value="old('top_unit_qty.0')" />
                                        </div>
                                          <!-- Top thickness -->
                                          <div>
                                            <x-label for="top_thickness_0">Thickness</x-label>
                                            <x-input id="top_thickness_0" name="top_thickness[0]" type="number" :value="old('top_thickness.0')" />
                                        </div>
                                          <!-- Top length_inches -->
                                          <div>
                                            <x-label for="top_length_inches_0">Length inches</x-label>
                                            <x-input id="top_length_inches_0" name="top_length_inches[0]" type="number" :value="old('top_length_inches.0')" />
                                        </div>
                                          <!-- Top width_inches -->
                                          <div>
                                            <x-label for="top_width_inches_0">Width inches</x-label>
                                            <x-input id="top_width_inches_0" name="top_width_inches[0]" type="number" :value="old('top_width_inches.0')" />
                                        </div>
                                         <!-- Top polished_edge_inches -->
                                         <div>
                                            <x-label for="top_polished_edge_inches_0">Polished Edge Inches</x-label>
                                            <x-input id="top_polished_edge_inches_0" name="top_polished_edge_inches[0]" type="number" :value="old('top_polished_edge_inches.0')" />
                                        </div>
                                        <!-- Top lmnt_mtr_edge_inches -->
                                        <div>
                                            <x-label for="top_lmnt_mtr_edge_inches_0">LMNT MTR Edge Inches</x-label>
                                            <x-input id="top_lmnt_mtr_edge_inches_0" name="top_lmnt_mtr_edge_inches[0]" type="number" :value="old('top_lmnt_mtr_edge_inches.0')" />
                                        </div>
                                        <!-- Top # of Sinks Per Unit -->
                                        <div>
                                            <x-label for="top_num_of_sinks_per_unit_0"># of Sinks Per Unit</x-label>
                                            <x-input id="top_num_of_sinks_per_unit_0" name="top_num_of_sinks_per_unit[0]" type="number" :value="old('top_num_of_sinks_per_unit.0')" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Backsplash Section Toggle -->
                                <div class="mb-4">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="has_backsplash_0" name="has_backsplash[0]" value="1" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" {{ old('has_backsplash.0') ? 'checked' : '' }}>
                                        <label for="has_backsplash_0" class="ml-2 block text-sm text-gray-900">Add Backsplash</label>
                                    </div>
                                </div>

                                <!-- Backsplash Details (Initially Hidden) -->
                                <div id="backsplash_details_0" class="backsplash-details border-l-4 border-green-300 pl-4 {{ old('has_backsplash.0') ? '' : 'hidden' }}">
                                    <h4 class="font-medium text-gray-900 mb-2">Backsplash Details</h4>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Backsplash Elevation -->
                                        <div>
                                            <x-label for="backsplash_elevation_0">Elevation</x-label>
                                            <x-input id="backsplash_elevation_0" name="backsplash_elevation[0]" :value="old('backsplash_elevation.0')" />
                                        </div>

                                        <!-- Backsplash Detail -->
                                        <div>
                                            <x-label for="backsplash_detail_0">Detail</x-label>
                                            <x-input id="backsplash_detail_0" name="backsplash_detail[0]" :value="old('backsplash_detail.0')" />
                                        </div>

                                        <!-- Backsplash Area -->
                                        <div>
                                            <x-label for="backsplash_area_0">Area</x-label>
                                            <x-input id="backsplash_area_0" name="backsplash_area[0]" :value="old('backsplash_area.0')" />
                                        </div>

                                        <!-- Backsplash Color -->
                                        <div>
                                            <x-label for="backsplash_color_0">Color</x-label>
                                            <x-input id="backsplash_color_0" name="backsplash_color[0]" :value="old('backsplash_color.0')" />
                                        </div>

                                        <!-- Backsplash Supplier Brand -->
                                        <div>
                                            <x-label for="backsplash_supplier_brand_0">Supplier Brand</x-label>
                                            <x-input id="backsplash_supplier_brand_0" name="backsplash_supplier_brand[0]" :value="old('backsplash_supplier_brand.0')" />
                                        </div>

                                        <!-- Backsplash Type -->
                                        <div>
                                            <x-label for="backsplash_type_0">Type</x-label>
                                            <x-input id="backsplash_type_0" name="backsplash_type[0]" :value="old('backsplash_type.0')" />
                                        </div>

                                          <!-- Backsplash unit_qty -->
                                          <div>
                                            <x-label for="backsplash__unit_qty_0">Unit Qty</x-label>
                                            <x-input id="backsplash__unit_qty_0" name="backsplash__unit_qty[0]" type="number" :value="old('backsplash_unit_qty.0')" />
                                        </div>
                                         <!-- backsplash thickness -->
                                         <div>
                                            <x-label for="backsplash_thickness_0">Thickness</x-label>
                                            <x-input id="backsplash_thickness_0" name="backsplash_thickness[0]" type="number" :value="old('backsplash_thickness.0')" />
                                        </div>
                                          <!-- backsplash length_inches -->
                                          <div>
                                            <x-label for="backsplash_length_inches_0">Length inches</x-label>
                                            <x-input id="backsplash_length_inches_0" name="backsplash_length_inches[0]" type="number" :value="old('backsplash_length_inches.0')" />
                                        </div>
                                          <!-- backsplash width_inches -->
                                          <div>
                                            <x-label for="backsplash_width_inches_0">Width inches</x-label>
                                            <x-input id="backsplash_width_inches_0" name="backsplashwidth_inches[0]" type="number" :value="old('backsplash_width_inches.0')" />
                                        </div>
                                         <!-- backsplash polished_edge_inches -->
                                         <div>
                                            <x-label for="backsplash_polished_edge_inches_0">Polished Edge Inches</x-label>
                                            <x-input id="backsplash_polished_edge_inches_0" name="backsplash_polished_edge_inches[0]" type="number" :value="old('backsplash_polished_edge_inches.0')" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <button type="button" id="add-takeoff" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                + Add Another Place Takeoff
                            </button>
                            
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
            // Toggle top details
            document.querySelectorAll('[id^="has_top_"]').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const index = this.id.split('_')[2];
                    const detailsDiv = document.getElementById('top_details_' + index);
                    if (this.checked) {
                        detailsDiv.classList.remove('hidden');
                    } else {
                        detailsDiv.classList.add('hidden');
                    }
                });
            });

            // Toggle backsplash details
            document.querySelectorAll('[id^="has_backsplash_"]').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const index = this.id.split('_')[2];
                    const detailsDiv = document.getElementById('backsplash_details_' + index);
                    if (this.checked) {
                        detailsDiv.classList.remove('hidden');
                    } else {
                        detailsDiv.classList.add('hidden');
                    }
                });
            });

            // Add new takeoff
            let takeoffCount = 1;
            document.getElementById('add-takeoff').addEventListener('click', function() {
                takeoffCount++;
                const template = document.querySelector('.takeoff-item').cloneNode(true);
                
                // Update all IDs and names
                template.querySelector('h3').textContent = `Place Takeoff #${takeoffCount}`;
                
                // Update place select
                const placeSelect = template.querySelector('[id^="places_"]');
                placeSelect.id = `places_${takeoffCount-1}`;
                placeSelect.name = `places[]`;
                placeSelect.selectedIndex = 0;
                
                // Update top checkbox
                const topCheckbox = template.querySelector('[id^="has_top_"]');
                topCheckbox.id = `has_top_${takeoffCount-1}`;
                topCheckbox.name = `has_top[${takeoffCount-1}]`;
                topCheckbox.checked = false;
                
                // Update top details div
                const topDetailsDiv = template.querySelector('[id^="top_details_"]');
                topDetailsDiv.id = `top_details_${takeoffCount-1}`;
                topDetailsDiv.classList.add('hidden');
                
                // Update all top input fields
                template.querySelectorAll('[id^="top_"][id$="_0"]').forEach(function(input) {
                    const fieldName = input.id.replace('_0', '');
                    input.id = `${fieldName}_${takeoffCount-1}`;
                    input.name = `${fieldName}[${takeoffCount-1}]`;
                    input.value = '';
                });
                
                // Update backsplash checkbox
                const backsplashCheckbox = template.querySelector('[id^="has_backsplash_"]');
                backsplashCheckbox.id = `has_backsplash_${takeoffCount-1}`;
                backsplashCheckbox.name = `has_backsplash[${takeoffCount-1}]`;
                backsplashCheckbox.checked = false;
                
                // Update backsplash details div
                const backsplashDetailsDiv = template.querySelector('[id^="backsplash_details_"]');
                backsplashDetailsDiv.id = `backsplash_details_${takeoffCount-1}`;
                backsplashDetailsDiv.classList.add('hidden');
                
                // Update all backsplash input fields
                template.querySelectorAll('[id^="backsplash_"][id$="_0"]').forEach(function(input) {
                    const fieldName = input.id.replace('_0', '');
                    input.id = `${fieldName}_${takeoffCount-1}`;
                    input.name = `${fieldName}[${takeoffCount-1}]`;
                    input.value = '';
                });
                
                // Add event listeners to new elements
                template.querySelector(`#has_top_${takeoffCount-1}`).addEventListener('change', function() {
                    const detailsDiv = document.getElementById(`top_details_${takeoffCount-1}`);
                    if (this.checked) {
                        detailsDiv.classList.remove('hidden');
                    } else {
                        detailsDiv.classList.add('hidden');
                    }
                });
                
                template.querySelector(`#has_backsplash_${takeoffCount-1}`).addEventListener('change', function() {
                    const detailsDiv = document.getElementById(`backsplash_details_${takeoffCount-1}`);
                    if (this.checked) {
                        detailsDiv.classList.remove('hidden');
                    } else {
                        detailsDiv.classList.add('hidden');
                    }
                });
                
                // Add the new takeoff to the container
                document.getElementById('takeoff-container').appendChild(template);
            });
        });
    </script>
</x-layouts.app>