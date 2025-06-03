<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Addon - {{ $project->name }}
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

                    <form method="POST" action="{{ route('projects.addons.update', [$project, $addon]) }}" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <!-- Type/Area Section -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Area Information</h3>
                            <div>
                                <x-label for="type">Type/Area</x-label>
                                <select id="type" name="type" class="bg-white p-1 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                                    <option value="">Select a type</option>
                                    @foreach($areaTypes as $areaType)
                                        <option value="{{ $areaType->name }}" {{ old('type', $addon->type) == $areaType->name ? 'selected' : '' }}>
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
                                    <x-input id="sink_model" name="sink_model" :value="old('sink_model', $addon->sink_model)" />
                                    @error('sink_model')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <x-label for="sink_name">Sink Name</x-label>
                                    <x-input id="sink_name" name="sink_name" :value="old('sink_name', $addon->sink_name)" />
                                    @error('sink_name')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <x-label for="sink_quantity">Quantity</x-label>
                                    <x-input id="sink_quantity" name="sink_quantity" type="number" min="1" :value="old('sink_quantity', $addon->sink_quantity)" />
                                    @error('sink_quantity')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <x-label for="sink_price">Sink Price ($)</x-label>
                                    <x-input id="sink_price" name="sink_price" type="number" step="0.01" :value="old('sink_price', $addon->sink_price)" />
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
                                    <x-input id="bracket_model" name="bracket_model" :value="old('bracket_model', $addon->bracket_model)" />
                                    @error('bracket_model')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <x-label for="bracket_name">Bracket Name</x-label>
                                    <x-input id="bracket_name" name="bracket_name" :value="old('bracket_name', $addon->bracket_name)" />
                                    @error('bracket_name')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <x-label for="bracket_quantity">Quantity</x-label>
                                    <x-input id="bracket_quantity" name="bracket_quantity" type="number" min="1" :value="old('bracket_quantity', $addon->bracket_quantity)" />
                                    @error('bracket_quantity')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <x-label for="bracket_price">Bracket Price ($)</x-label>
                                    <x-input id="bracket_price" name="bracket_price" type="number" step="0.01" :value="old('bracket_price', $addon->bracket_price)" />
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
                                        <input id="edge" name="edge" type="checkbox" value="1" {{ (old('edge', $addon->edge)) ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" onchange="toggleEdgeFields()">
                                        <label for="edge" class="ml-2 block text-sm text-gray-900 font-medium">Edge</label>
                                    </div>
                                    <div id="edge_fields" class="ml-6 space-y-3" style="display: {{ (old('edge', $addon->edge)) ? 'block' : 'none' }};">
                                        <div>
                                            <x-label for="edge_type">Edge Type</x-label>
                                            <select id="edge_type" name="edge_type" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                                                <option value="">Select edge type</option>
                                                <option value="Straight" {{ old('edge_type', $addon->edge_type) == 'Straight' ? 'selected' : '' }}>Straight</option>
                                                <option value="Bullnose" {{ old('edge_type', $addon->edge_type) == 'Bullnose' ? 'selected' : '' }}>Bullnose</option>
                                                <option value="Beveled" {{ old('edge_type', $addon->edge_type) == 'Beveled' ? 'selected' : '' }}>Beveled</option>
                                                <option value="Ogee" {{ old('edge_type', $addon->edge_type) == 'Ogee' ? 'selected' : '' }}>Ogee</option>
                                                <option value="Eased" {{ old('edge_type', $addon->edge_type) == 'Eased' ? 'selected' : '' }}>Eased</option>
                                                <option value="Waterfall" {{ old('edge_type', $addon->edge_type) == 'Waterfall' ? 'selected' : '' }}>Waterfall</option>
                                                <option value="Laminated" {{ old('edge_type', $addon->edge_type) == 'Laminated' ? 'selected' : '' }}>Laminated</option>
                                            </select>
                                            @error('edge_type')
                                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div>
                                            <x-label for="edge_price">Edge Price ($)</x-label>
                                            <x-input id="edge_price" name="edge_price" type="number" step="0.01" :value="old('edge_price', $addon->edge_price)" />
                                            @error('edge_price')
                                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Plumbing -->
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <input id="plumbing" name="plumbing" type="checkbox" value="1" {{ (old('plumbing', $addon->plumbing)) ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" onchange="togglePlumbingFields()">
                                        <label for="plumbing" class="ml-2 block text-sm text-gray-900 font-medium">Plumbing</label>
                                    </div>
                                    <div id="plumbing_fields" class="ml-6 space-y-3" style="display: {{ (old('plumbing', $addon->plumbing)) ? 'block' : 'none' }};">
                                        <div>
                                            <x-label for="plumbing_details">Plumbing Details</x-label>
                                            <textarea id="plumbing_details" name="plumbing_details" rows="3" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" placeholder="Describe plumbing work required...">{{ old('plumbing_details', $addon->plumbing_details) }}</textarea>
                                            @error('plumbing_details')
                                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div>
                                            <x-label for="plumbing_price">Plumbing Price ($)</x-label>
                                            <x-input id="plumbing_price" name="plumbing_price" type="number" step="0.01" :value="old('plumbing_price', $addon->plumbing_price)" />
                                            @error('plumbing_price')
                                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Demo -->
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <input id="demo" name="demo" type="checkbox" value="1" {{ (old('demo', $addon->demo)) ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" onchange="togglePriceField('demo')">
                                        <label for="demo" class="ml-2 block text-sm text-gray-900 font-medium">Demo</label>
                                    </div>
                                    <div id="demo_price_field" class="ml-6" style="display: {{ (old('demo', $addon->demo)) ? 'block' : 'none' }};">
                                        <x-label for="demo_price">Demo Price ($)</x-label>
                                        <x-input id="demo_price" name="demo_price" type="number" step="0.01" :value="old('demo_price', $addon->demo_price)" />
                                        @error('demo_price')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Vein Exact Match -->
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <input id="vein_exact_match" name="vein_exact_match" type="checkbox" value="1" {{ (old('vein_exact_match', $addon->vein_exact_match)) ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" onchange="togglePriceField('vein_exact_match')">
                                        <label for="vein_exact_match" class="ml-2 block text-sm text-gray-900 font-medium">Vein Exact Match</label>
                                    </div>
                                    <div id="vein_exact_match_price_field" class="ml-6" style="display: {{ (old('vein_exact_match', $addon->vein_exact_match)) ? 'block' : 'none' }};">
                                        <x-label for="vein_exact_match_price">Vein Exact Match Price ($)</x-label>
                                        <x-input id="vein_exact_match_price" name="vein_exact_match_price" type="number" step="0.01" :value="old('vein_exact_match_price', $addon->vein_exact_match_price)" />
                                        @error('vein_exact_match_price')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Electrical Cutout -->
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <input id="electrical_cutout" name="electrical_cutout" type="checkbox" value="1" {{ (old('electrical_cutout', $addon->electrical_cutout)) ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" onchange="toggleElectricalFields()">
                                        <label for="electrical_cutout" class="ml-2 block text-sm text-gray-900 font-medium">Electrical Cutout</label>
                                    </div>
                                    <div id="electrical_fields" class="ml-6 space-y-3" style="display: {{ (old('electrical_cutout', $addon->electrical_cutout)) ? 'block' : 'none' }};">
                                        <div>
                                            <x-label for="electrical_cutout_quantity">Quantity</x-label>
                                            <x-input id="electrical_cutout_quantity" name="electrical_cutout_quantity" type="number" min="1" :value="old('electrical_cutout_quantity', $addon->electrical_cutout_quantity)" />
                                            @error('electrical_cutout_quantity')
                                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div>
                                            <x-label for="electrical_cutout_price">Electrical Cutout Price ($)</x-label>
                                            <x-input id="electrical_cutout_price" name="electrical_cutout_price" type="number" step="0.01" :value="old('electrical_cutout_price', $addon->electrical_cutout_price)" />
                                            @error('electrical_cutout_price')
                                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <x-button type="submit">
                                Update Addon
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
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
            } else {
                fieldsDiv.style.display = 'none';
                document.getElementById('electrical_cutout_quantity').value = '1';
                document.getElementById('electrical_cutout_price').value = '';
            }
        }
        
        function togglePriceField(fieldName) {
            const checkbox = document.getElementById(fieldName);
            const priceField = document.getElementById(fieldName + '_price_field');
            
            if (checkbox.checked) {
                priceField.style.display = 'block';
            } else {
                priceField.style.display = 'none';
                const priceInput = document.getElementById(fieldName + '_price');
                if (priceInput) {
                    priceInput.value = '';
                }
            }
        }
    </script>
</x-layouts.app>