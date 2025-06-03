<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Addon to {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <div class="mb-4">
                        <a href="{{ route('projects.addons.index', $project) }}" class="text-indigo-600 hover:text-indigo-900">
                            &larr; Back to Addons
                        </a>
                    </div>

                    <form method="POST" action="{{ route('projects.addons.store', $project) }}" class="space-y-8">
                        @csrf

                        <!-- Type/Area Section -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Area Information</h3>
                            <div>
                                <x-label for="type">Type/Area</x-label>
                                <select id="type" name="type" class="bg-white p-1 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                                    <option value="">Select a type</option>
                                    @foreach($areaTypes as $areaType)
                                        <option value="{{ $areaType->name }}" {{ old('type') == $areaType->name ? 'selected' : '' }}>
                                            {{ $areaType->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Sink Section -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Sink Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-label for="sink_model">Sink Model</x-label>
                                    <x-input id="sink_model" name="sink_model" :value="old('sink_model')" />
                                    @error('sink_model')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <x-label for="sink_name">Sink Name</x-label>
                                    <x-input id="sink_name" name="sink_name" :value="old('sink_name')" />
                                    @error('sink_name')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <x-label for="sink_quantity">Quantity</x-label>
                                    <x-input id="sink_quantity" name="sink_quantity" type="number" min="1" :value="old('sink_quantity', 1)" />
                                    @error('sink_quantity')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <x-label for="sink_price">Sink Price ($)</x-label>
                                    <x-input id="sink_price" name="sink_price" type="number" step="0.01" :value="old('sink_price')" />
                                    @error('sink_price')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Bracket Section -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Bracket Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-label for="bracket_model">Bracket Model</x-label>
                                    <x-input id="bracket_model" name="bracket_model" :value="old('bracket_model')" />
                                    @error('bracket_model')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <x-label for="bracket_name">Bracket Name</x-label>
                                    <x-input id="bracket_name" name="bracket_name" :value="old('bracket_name')" />
                                    @error('bracket_name')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <x-label for="bracket_quantity">Quantity</x-label>
                                    <x-input id="bracket_quantity" name="bracket_quantity" type="number" min="1" :value="old('bracket_quantity', 1)" />
                                    @error('bracket_quantity')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <x-label for="bracket_price">Bracket Price ($)</x-label>
                                    <x-input id="bracket_price" name="bracket_price" type="number" step="0.01" :value="old('bracket_price')" />
                                    @error('bracket_price')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Optional Services Section -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Optional Services</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                
                                <!-- Edge -->
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <input id="edge" name="edge" type="checkbox" value="1" {{ old('edge') ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" onchange="toggleEdgeFields()">
                                        <label for="edge" class="ml-2 block text-sm text-gray-900 font-medium">Edge</label>
                                    </div>
                                    <div id="edge_fields" class="ml-6 space-y-3" style="display: {{ old('edge') ? 'block' : 'none' }};">
                                        <div>
                                            <x-label for="edge_type">Edge Type</x-label>
                                            <select id="edge_type" name="edge_type" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" onchange="updateEdgePrice()">
                                                <option value="">Select edge type</option>
                                                @foreach($edgeTypes as $edgeType)
                                                    <option value="{{ $edgeType->name }}" 
                                                            data-price="{{ $edgeType->price }}"
                                                            {{ old('edge_type') == $edgeType->name ? 'selected' : '' }}>
                                                        {{ $edgeType->name }} - ${{ number_format($edgeType->price, 2) }}/LF
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('edge_type')
                                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div style="display: none;">
                                            <x-input id="edge_price" name="edge_price" type="number" step="0.01" :value="old('edge_price')" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Plumbing -->
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <input id="plumbing" name="plumbing" type="checkbox" value="1" {{ old('plumbing') ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" onchange="togglePlumbingFields()">
                                        <label for="plumbing" class="ml-2 block text-sm text-gray-900 font-medium">Plumbing</label>
                                    </div>
                                    <div id="plumbing_fields" class="ml-6 space-y-3" style="display: {{ old('plumbing') ? 'block' : 'none' }};">
                                        <div>
                                            <x-label for="plumbing_details">Plumbing Details</x-label>
                                            <textarea id="plumbing_details" name="plumbing_details" rows="3" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" placeholder="Describe plumbing work required...">{{ old('plumbing_details') }}</textarea>
                                            @error('plumbing_details')
                                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div>
                                            <x-label for="plumbing_price">Plumbing Price ($)</x-label>
                                            <x-input id="plumbing_price" name="plumbing_price" type="number" step="0.01" :value="old('plumbing_price')" />
                                            @error('plumbing_price')
                                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Demo -->
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <input id="demo" name="demo" type="checkbox" value="1" {{ old('demo') ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" onchange="toggleServicePrice('demo')">
                                        <label for="demo" class="ml-2 block text-sm text-gray-900 font-medium">Demo</label>
                                    </div>
                                    <div id="demo_price_field" style="display: none;">
                                        <x-input id="demo_price" name="demo_price" type="number" step="0.01" 
                                                :value="old('demo_price', $servicePrices['demo'] ?? '')" />
                                    </div>
                                </div>

                                <!-- Vein Exact Match -->
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <input id="vein_exact_match" name="vein_exact_match" type="checkbox" value="1" {{ old('vein_exact_match') ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" onchange="toggleServicePrice('vein_exact_match')">
                                        <label for="vein_exact_match" class="ml-2 block text-sm text-gray-900 font-medium">Vein Exact Match</label>
                                    </div>
                                    <div id="vein_exact_match_price_field" style="display: none;">
                                        <x-input id="vein_exact_match_price" name="vein_exact_match_price" type="number" step="0.01" 
                                                :value="old('vein_exact_match_price', $servicePrices['vein_exact_match'] ?? '')" />
                                    </div>
                                </div>

                                <!-- Electrical Cutout -->
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <input id="electrical_cutout" name="electrical_cutout" type="checkbox" value="1" {{ old('electrical_cutout') ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" onchange="toggleElectricalFields()">
                                        <label for="electrical_cutout" class="ml-2 block text-sm text-gray-900 font-medium">Electrical Cutout</label>
                                    </div>
                                    <div id="electrical_fields" class="ml-6 space-y-3" style="display: {{ old('electrical_cutout') ? 'block' : 'none' }};">
                                        <div>
                                            <x-label for="electrical_cutout_quantity">Quantity</x-label>
                                            <x-input id="electrical_cutout_quantity" name="electrical_cutout_quantity" type="number" min="1" :value="old('electrical_cutout_quantity', 1)" onchange="calculateElectricalPrice()" />
                                            @error('electrical_cutout_quantity')
                                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div style="display: none;">
                                            <x-input id="electrical_unit_price" name="electrical_unit_price" type="number" step="0.01" 
                                                    value="{{ $servicePrices['electrical_cutout'] ?? 0 }}" />
                                        </div>
                                        <div style="display: none;">
                                            <x-input id="electrical_cutout_price" name="electrical_cutout_price" type="number" step="0.01" 
                                                    :value="old('electrical_cutout_price', $servicePrices['electrical_cutout'] ?? '')" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <x-button type="submit">
                                Create Addon
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Service prices from database based on project type
        const servicePrices = {
            demo: {{ $servicePrices['demo'] ?? 0 }},
            vein_exact_match: {{ $servicePrices['vein_exact_match'] ?? 0 }},
            electrical_cutout: {{ $servicePrices['electrical_cutout'] ?? 0 }}
        };

        function toggleEdgeFields() {
            const checkbox = document.getElementById('edge');
            const fieldsDiv = document.getElementById('edge_fields');
            
            if (checkbox.checked) {
                fieldsDiv.style.display = 'block';
            } else {
                fieldsDiv.style.display = 'none';
                document.getElementById('edge_type').value = '';
                document.getElementById('edge_price').value = '';
            }
        }
        
        function updateEdgePrice() {
            const select = document.getElementById('edge_type');
            const priceInput = document.getElementById('edge_price');
            const selectedOption = select.options[select.selectedIndex];
            
            if (selectedOption && selectedOption.dataset.price) {
                priceInput.value = parseFloat(selectedOption.dataset.price).toFixed(2);
            } else {
                priceInput.value = '';
            }
        }
        
        function togglePlumbingFields() {
            const checkbox = document.getElementById('plumbing');
            const fieldsDiv = document.getElementById('plumbing_fields');
            
            if (checkbox.checked) {
                fieldsDiv.style.display = 'block';
            } else {
                fieldsDiv.style.display = 'none';
                document.getElementById('plumbing_details').value = '';
                document.getElementById('plumbing_price').value = '';
            }
        }
        
        function toggleElectricalFields() {
            const checkbox = document.getElementById('electrical_cutout');
            const fieldsDiv = document.getElementById('electrical_fields');
            
            if (checkbox.checked) {
                fieldsDiv.style.display = 'block';
                calculateElectricalPrice();
            } else {
                fieldsDiv.style.display = 'none';
                document.getElementById('electrical_cutout_quantity').value = '1';
                document.getElementById('electrical_cutout_price').value = '';
            }
        }
        
        function calculateElectricalPrice() {
            const quantity = parseInt(document.getElementById('electrical_cutout_quantity').value) || 1;
            const unitPrice = servicePrices.electrical_cutout;
            const totalPrice = (quantity * unitPrice).toFixed(2);
            document.getElementById('electrical_cutout_price').value = totalPrice;
        }
        
        function toggleServicePrice(fieldName) {
            const checkbox = document.getElementById(fieldName);
            const priceInput = document.getElementById(fieldName + '_price');
            
            if (checkbox.checked) {
                if (servicePrices[fieldName]) {
                    priceInput.value = servicePrices[fieldName].toFixed(2);
                }
            } else {
                priceInput.value = '';
            }
        }
    </script>
</x-layouts.app>