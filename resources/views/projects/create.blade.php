<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('projects.index') }}" class="text-indigo-600 hover:text-indigo-900">
                            &larr; Back to Projects
                        </a>
                    </div>

                    <form method="POST" action="{{ route('projects.store') }}" class="space-y-6" enctype="multipart/form-data">
                        @csrf

                        <!-- Project Name -->
                        <div class="mt-4">
                            <x-label for="name">Project Name</x-label>
                            <x-input id="name" type="text" name="name" :value="old('name')" required />
                            @error('name')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Customer -->
                        <div class="mt-4">
                            <x-label for="customer">Customer</x-label>
                            <x-input id="customer" type="text" name="customer" :value="old('customer')" required />
                            @error('customer')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <x-label for="email">Email</x-label>
                            <x-input id="email" type="email" name="email" :value="old('email')" required />
                            @error('email')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mt-4">
                            <x-label for="phone">Phone</x-label>
                            <x-input id="phone" type="text" name="phone" :value="old('phone')" />
                            @error('phone')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Attention -->
                        <div class="mt-4">
                            <x-label for="attention">Attention</x-label>
                            <x-input id="attention" type="text" name="attention" :value="old('attention')" />
                            @error('attention')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="mt-4">
                            <x-label for="address">Address</x-label>
                            <x-textarea id="address" name="address">{{ old('address') }}</x-textarea>
                            @error('address')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Architect -->
                        <div class="mt-4">
                            <x-label for="architect">Architect</x-label>
                            <x-input id="architect" type="text" name="architect" :value="old('architect')" />
                            @error('architect')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Dates Section -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                            <!-- Bid Date -->
                            <div>
                                <x-label for="bid_date">Bid Date</x-label>
                                <x-input id="bid_date" type="date" name="bid_date" :value="old('bid_date')" />
                                @error('bid_date')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Plan Date -->
                            <div>
                                <x-label for="plan_date">Plan Date</x-label>
                                <x-input id="plan_date" type="date" name="plan_date" :value="old('plan_date')" />
                                @error('plan_date')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Date Accepted -->
                            <div>
                                <x-label for="date_accepted">Date Accepted</x-label>
                                <x-input id="date_accepted" type="date" name="date_accepted" :value="old('date_accepted')" />
                                @error('date_accepted')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Attachments Section -->
                        <div class="mt-6">
                            <h3 class="text-lg font-medium text-gray-900">Project Attachments</h3>
                            <p class="text-sm text-gray-500 mb-4">Upload relevant files for this project</p>
                            
                            <div class="space-y-4" id="attachments-container">
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 border p-4 rounded">
                                    <div class="md:col-span-3">
                                        <x-label for="attachments[]">File</x-label>
                                        <input type="file" name="attachments[]" id="attachments" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                    </div>
                                    <div>
                                        <x-label for="descriptions[]">Description</x-label>
                                        <x-input type="text" name="descriptions[]" placeholder="Optional description" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-2">
                                <button type="button" id="add-more-attachments" class="text-sm text-indigo-600 hover:text-indigo-900">
                                    + Add Another Attachment
                                </button>
                            </div>
                            
                            @error('attachments.*')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-button type="submit">
                                Create Project
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for adding more attachment fields -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addMoreBtn = document.getElementById('add-more-attachments');
            const container = document.getElementById('attachments-container');
            
            addMoreBtn.addEventListener('click', function() {
                const newRow = document.createElement('div');
                newRow.className = 'grid grid-cols-1 md:grid-cols-4 gap-4 border p-4 rounded mt-2';
                newRow.innerHTML = `
                    <div class="md:col-span-3">
                        <label class="block font-medium text-sm text-gray-700">File</label>
                        <input type="file" name="attachments[]" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Description</label>
                        <input type="text" name="descriptions[]" placeholder="Optional description" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    </div>
                `;
                container.appendChild(newRow);
            });
        });
    </script>
</x-layouts.app>