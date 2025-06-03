<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pricing Factors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- Success Message --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Main Pricing Factors --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Current Pricing Factors</h3>
                        <a href="{{ route('pricing-factors.edit') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Edit Pricing Factors
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Pricing Factor
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Residential
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Contractor
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($factorNames as $code => $name)
                                    <tr class="{{ $loop->index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if(in_array($code, ['overhead', 'waste', 'profit']))
                                                {{ $pricingFactor->{'residential_' . $code} }}%
                                            @else
                                                ${{ $pricingFactor->{'residential_' . $code} }}
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if(in_array($code, ['overhead', 'waste', 'profit']))
                                                {{ $pricingFactor->{'contractor_' . $code} }}%
                                            @else
                                                ${{ $pricingFactor->{'contractor_' . $code} }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Edge Types Section --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Edge Types & Pricing</h3>
                        <button onclick="toggleForm('edge-type-form')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add Edge Type
                        </button>
                    </div>

                    {{-- Edge Type Form --}}
                    <div id="edge-type-form" class="hidden mb-6 p-4 bg-gray-50 rounded-lg">
                        <form method="POST" action="{{ route('pricing-factors.edge-types.store') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @csrf
                            <div>
                                <x-label for="edge_name">Name</x-label>
                                <x-input id="edge_name" name="name" :value="old('name')" required />
                                @error('name')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <x-label for="edge_price">Price ($)</x-label>
                                <x-input id="edge_price" name="price" type="number" step="0.01" :value="old('price')" required />
                                @error('price')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="flex items-end">
                                <x-button type="submit">Add Edge Type</x-button>
                            </div>
                        </form>
                    </div>

                    {{-- Edge Types Table --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($edgeTypes as $edgeType)
                                    <tr id="edge-row-{{ $edgeType->id }}">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <span class="view-mode">{{ $edgeType->name }}</span>
                                            <input type="text" class="edit-mode hidden rounded-md shadow-sm border-gray-300" value="{{ $edgeType->name }}" data-field="name">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <span class="view-mode">${{ number_format($edgeType->price, 2) }}</span>
                                            <input type="number" step="0.01" class="edit-mode hidden rounded-md shadow-sm border-gray-300" value="{{ $edgeType->price }}" data-field="price">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button onclick="editRow('edge', {{ $edgeType->id }})" class="view-mode text-indigo-600 hover:text-indigo-900 mr-4">Edit</button>
                                            <button onclick="saveRow('edge', {{ $edgeType->id }}, '{{ route('pricing-factors.edge-types.update', $edgeType) }}')" class="edit-mode hidden text-green-600 hover:text-green-900 mr-2">Save</button>
                                            <button onclick="cancelEdit('edge', {{ $edgeType->id }})" class="edit-mode hidden text-gray-600 hover:text-gray-900 mr-4">Cancel</button>
                                            <form method="POST" action="{{ route('pricing-factors.edge-types.destroy', $edgeType) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <script>
        function toggleForm(formId) {
            const form = document.getElementById(formId);
            form.classList.toggle('hidden');
        }

        function editRow(type, id) {
            const row = document.getElementById(`${type}-row-${id}`);
            const viewElements = row.querySelectorAll('.view-mode');
            const editElements = row.querySelectorAll('.edit-mode');
            
            viewElements.forEach(el => el.classList.add('hidden'));
            editElements.forEach(el => el.classList.remove('hidden'));
        }

        function cancelEdit(type, id) {
            const row = document.getElementById(`${type}-row-${id}`);
            const viewElements = row.querySelectorAll('.view-mode');
            const editElements = row.querySelectorAll('.edit-mode');
            
            viewElements.forEach(el => el.classList.remove('hidden'));
            editElements.forEach(el => el.classList.add('hidden'));
        }

        function saveRow(type, id, url) {
            const row = document.getElementById(`${type}-row-${id}`);
            const inputs = row.querySelectorAll('.edit-mode input, .edit-mode select');
            
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('_method', 'PUT');
            
            inputs.forEach(input => {
                const field = input.dataset.field;
                if (input.type === 'checkbox') {
                    formData.append(field, input.checked ? '1' : '0');
                } else {
                    formData.append(field, input.value);
                }
            });

            fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error updating record');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating record');
            });
        }
    </script>
</x-layouts.app>