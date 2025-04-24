<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Sink') }} - {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('projects.sinks.index', $project) }}" class="text-indigo-600 hover:text-indigo-900">
                            &larr; Back to Sinks
                        </a>
                    </div>

                    <form method="POST" action="{{ route('projects.sinks.update', ['project' => $project->id, 'sink' => $sink->id]) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="border rounded-lg p-4 mb-6">
                            <!-- Sink Area -->
                            <div class="mb-4">
                                <x-label for="sink_area">Sink Area</x-label>
                                <x-input id="sink_area" name="sink_area" :value="old('sink_area', $sink->sink_area)" required />
                                @error('sink_area')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <!-- Brand -->
                                <div>
                                    <x-label for="brand">Brand</x-label>
                                    <x-input id="brand" name="brand" :value="old('brand', $sink->brand)" required />
                                    @error('brand')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Model -->
                                <div>
                                    <x-label for="model">Model</x-label>
                                    <x-input id="model" name="model" :value="old('model', $sink->model)" required />
                                    @error('model')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <!-- Price -->
                                <div>
                                    <x-label for="price">Price ($)</x-label>
                                    <x-input id="price" name="price" type="number" step="0.01" :value="old('price', $sink->price)" required />
                                    @error('price')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Quantity -->
                                <div>
                                    <x-label for="quantity">Quantity</x-label>
                                    <x-input id="quantity" name="quantity" type="number" min="1" :value="old('quantity', $sink->quantity)" required />
                                    @error('quantity')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <x-button type="submit">
                                Update Sink
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>