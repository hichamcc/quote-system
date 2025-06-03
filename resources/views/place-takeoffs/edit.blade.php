<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Place Takeoff') }} - {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('projects.takeoffs.show', $project) }}" class="text-indigo-600 hover:text-indigo-900">
                            &larr; Back to Takeoffs
                        </a>
                    </div>

                    <form method="POST" action="{{ route('projects.takeoffs.update', ['project' => $project->id, 'takeoff' => $placeTakeoff->id]) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="border rounded-lg p-4 mb-6">
                            <!-- Place details -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <!-- AMG Job Number -->
                                <div>
                                    <x-label for="amg_job_number">AMG Job #</x-label>
                                    <x-input id="amg_job_number" name="amg_job_number" :value="old('amg_job_number', $placeTakeoff->amg_job_number)"  />
                                    @error('amg_job_number')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Place Type -->
                                <div>
                                    <x-label for="type">Section Type</x-label>
                                    <select id="type" name="type" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                                        <option value="">Select a type</option>
                                        @foreach($areaTypes as $areaType)
                                            <option value="{{ $areaType->name }}" {{ old('type', $placeTakeoff->type) == $areaType->name ? 'selected' : '' }}>
                                                {{ $areaType->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Material Details -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <!-- Material Name -->
                                <div>
                                    <x-label for="material_name">Material Name</x-label>
                                    <x-input id="material_name" name="material_name" :value="old('material_name', $placeTakeoff->material_name)" />
                                    @error('material_name')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <x-label for="material_price">Material Price ($)</x-label>
                                    <x-input id="material_price" name="material_price" type="number" step="0.01" :value="old('material_price', $placeTakeoff->material_price)" />
                                    @error('material_price')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Supplier -->
                                <div>
                                    <x-label for="supplier">Supplier</x-label>
                                    <x-input id="supplier" name="supplier" :value="old('supplier', $placeTakeoff->supplier)" />
                                    @error('supplier')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Area -->
                                <div>
                                    <x-label for="area">Area</x-label>
                                    <x-input id="area" name="area" :value="old('area', $placeTakeoff->area)" />
                                    @error('area')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Piece Number -->
                                <div>
                                    <x-label for="piece_number">Piece #</x-label>
                                    <x-input id="piece_number" name="piece_number" :value="old('piece_number', $placeTakeoff->piece_number)" />
                                    @error('piece_number')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Dimensions -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <!-- Length -->
                                <div>
                                    <x-label for="length">Length</x-label>
                                    <x-input id="length" name="length" type="number" step="0.01" :value="old('length', $placeTakeoff->length)" />
                                    @error('length')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Width -->
                                <div>
                                    <x-label for="width">Width</x-label>
                                    <x-input id="width" name="width" type="number" step="0.001" :value="old('width', $placeTakeoff->width)" />
                                    @error('width')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Polished Edge Length -->
                                <div>
                                    <x-label for="polished_edge_length">Polished Edge Length</x-label>
                                    <x-input id="polished_edge_length" name="polished_edge_length" type="number" step="0.01" :value="old('polished_edge_length', $placeTakeoff->polished_edge_length)" />
                                    @error('polished_edge_length')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Miter Edge Length -->
                                <div>
                                    <x-label for="miter_edge_length">Miter Edge Length</x-label>
                                    <x-input id="miter_edge_length" name="miter_edge_length" type="number" step="0.01" :value="old('miter_edge_length', $placeTakeoff->miter_edge_length)" />
                                    @error('miter_edge_length')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Cutouts -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <!-- Sink Cutout -->
                                <div>
                                    <x-label for="sink_cutout">Sink Cutout</x-label>
                                    <x-input id="sink_cutout" name="sink_cutout" type="number" :value="old('sink_cutout', $placeTakeoff->sink_cutout)" />
                                    @error('sink_cutout')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Cooktop Cutout -->
                                <div>
                                    <x-label for="cooktop_cutout">Cooktop Cutout</x-label>
                                    <x-input id="cooktop_cutout" name="cooktop_cutout" type="number" :value="old('cooktop_cutout', $placeTakeoff->cooktop_cutout)" />
                                    @error('cooktop_cutout')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('projects.takeoffs.show', $project) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Cancel
                            </a>
                            
                            <x-button type="submit">
                                Update Takeoff
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>