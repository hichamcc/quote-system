<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Materials Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Material Inventory</h3>
                        <button onclick="toggleForm('material-form')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add Material
                        </button>
                    </div>

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Material Form --}}
                    <div id="material-form" class="hidden mb-6 p-4 bg-gray-50 rounded-lg">
                        <form method="POST" action="{{ route('materials.store') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            @csrf
                            <div>
                                <x-label for="material_name">Material Name</x-label>
                                <x-input id="material_name" name="name" :value="old('name')" required />
                                @error('name')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <x-label for="material_supplier">Supplier</x-label>
                                <x-input id="material_supplier" name="supplier" :value="old('supplier')" required />
                                @error('supplier')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <x-label for="material_price">Price ($)</x-label>
                                <x-input id="material_price" name="price" type="number" step="0.01" :value="old('price')" required />
                                @error('price')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="flex items-end">
                                <x-button type="submit">Add Material</x-button>
                            </div>
                        </form>
                    </div>

                    {{-- Materials Table --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Material Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($materials as $material)
                                    <tr id="material-row-{{ $material->id }}" class="{{ $loop->index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <span class="view-mode">{{ $material->name }}</span>
                                            <input type="text" class="edit-mode hidden rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" value="{{ $material->name }}" data-field="name">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <span class="view-mode">{{ $material->supplier }}</span>
                                            <input type="text" class="edit-mode hidden rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" value="{{ $material->supplier }}" data-field="supplier">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <span class="view-mode">${{ number_format($material->price, 2) }}</span>
                                            <input type="number" step="0.01" class="edit-mode hidden rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" value="{{ $material->price }}" data-field="price">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button onclick="editRow('material', {{ $material->id }})" class="view-mode text-indigo-600 hover:text-indigo-900 mr-4">Edit</button>
                                            <button onclick="saveRow('material', {{ $material->id }}, '{{ route('materials.update', $material) }}')" class="edit-mode hidden text-green-600 hover:text-green-900 mr-2">Save</button>
                                            <button onclick="cancelEdit('material', {{ $material->id }})" class="edit-mode hidden text-gray-600 hover:text-gray-900 mr-4">Cancel</button>
                                            <form method="POST" action="{{ route('materials.destroy', $material) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this material?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            No materials found. Click "Add Material" to create your first one.
                                        </td>
                                    </tr>
                                @endforelse
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
            const inputs = row.querySelectorAll('.edit-mode input');
            
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('_method', 'PUT');
            
            inputs.forEach(input => {
                const field = input.dataset.field;
                formData.append(field, input.value);
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
                    alert('Error updating material');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating material');
            });
        }
    </script>
</x-layouts.app>