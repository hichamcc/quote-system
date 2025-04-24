<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Project') }}
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

                    <form method="POST" action="{{ route('projects.update', $project) }}" class="space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Project Name -->
                        <div class="mt-4">
                            <x-label for="name">Project Name</x-label>
                            <x-input id="name" type="text" name="name" :value="old('name', $project->name)" required />
                            @error('name')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Customer -->
                        <div class="mt-4">
                            <x-label for="customer">Customer</x-label>
                            <x-input id="customer" type="text" name="customer" :value="old('customer', $project->customer)" required />
                            @error('customer')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <x-label for="email">Email</x-label>
                            <x-input id="email" type="email" name="email" :value="old('email', $project->email)" required />
                            @error('email')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mt-4">
                            <x-label for="phone">Phone</x-label>
                            <x-input id="phone" type="text" name="phone" :value="old('phone', $project->phone)" />
                            @error('phone')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Attention -->
                        <div class="mt-4">
                            <x-label for="attention">Attention</x-label>
                            <x-input id="attention" type="text" name="attention" :value="old('attention', $project->attention)" />
                            @error('attention')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="mt-4">
                            <x-label for="address">Address</x-label>
                            <x-textarea id="address" name="address">{{ old('address', $project->address) }}</x-textarea>
                            @error('address')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Architect -->
                        <div class="mt-4">
                            <x-label for="architect">Architect</x-label>
                            <x-input id="architect" type="text" name="architect" :value="old('architect', $project->architect)" />
                            @error('architect')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Dates Section -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                            <!-- Bid Date -->
                            <div>
                                <x-label for="bid_date">Bid Date</x-label>
                                <x-input id="bid_date" type="date" name="bid_date" :value="old('bid_date', $project->bid_date ? $project->bid_date->format('Y-m-d') : '')" />
                                @error('bid_date')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Plan Date -->
                            <div>
                                <x-label for="plan_date">Plan Date</x-label>
                                <x-input id="plan_date" type="date" name="plan_date" :value="old('plan_date', $project->plan_date ? $project->plan_date->format('Y-m-d') : '')" />
                                @error('plan_date')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Date Accepted -->
                            <div>
                                <x-label for="date_accepted">Date Accepted</x-label>
                                <x-input id="date_accepted" type="date" name="date_accepted" :value="old('date_accepted', $project->date_accepted ? $project->date_accepted->format('Y-m-d') : '')" />
                                @error('date_accepted')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Existing Attachments Section -->
                        @if($project->attachments->count() > 0)
                            <div class="mt-6">
                                <h3 class="text-lg font-medium text-gray-900">Existing Attachments</h3>
                                <div class="mt-2 space-y-2">
                                    @foreach($project->attachments as $attachment)
                                        <div class="flex items-center justify-between p-3 border rounded">
                                            <div class="flex items-center space-x-3">
                                                <div class="flex-shrink-0">
                                                    @php
                                                        $extension = pathinfo($attachment->original_filename, PATHINFO_EXTENSION);
                                                        $iconClass = 'fas fa-file';
                                                        
                                                        if (in_array($extension, ['pdf'])) {
                                                            $iconClass = 'fas fa-file-pdf';
                                                        } elseif (in_array($extension, ['doc', 'docx'])) {
                                                            $iconClass = 'fas fa-file-word';
                                                        } elseif (in_array($extension, ['xls', 'xlsx'])) {
                                                            $iconClass = 'fas fa-file-excel';
                                                        } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                                                            $iconClass = 'fas fa-file-image';
                                                        }
                                                    @endphp
                                                    <i class="{{ $iconClass }} text-gray-500 text-xl"></i>
                                                </div>
                                                <div>
                                                    <a href="{{ Storage::url($attachment->path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 font-medium">
                                                        {{ $attachment->original_filename }}
                                                    </a>
                                                    @if($attachment->description)
                                                        <p class="text-sm text-gray-500">{{ $attachment->description }}</p>
                                                    @endif
                                                    <p class="text-xs text-gray-400">{{ number_format($attachment->size / 1024, 2) }} KB</p>
                                                </div>
                                            </div>
                                            <div class="flex space-x-2">
                                                <div class="flex items-center">
                                                    <input type="checkbox" id="delete_attachment_{{ $attachment->id }}" name="delete_attachments[]" value="{{ $attachment->id }}" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                                                    <label for="delete_attachment_{{ $attachment->id }}" class="ml-2 text-sm text-red-600">
                                                        Delete
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- New Attachments Section -->
                        <div class="mt-6">
                            <h3 class="text-lg font-medium text-gray-900">Add New Attachments</h3>
                            <p class="text-sm text-gray-500 mb-4">Upload additional files for this project</p>
                            
                            <div class="space-y-4" id="attachments-container">
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 border p-4 rounded">
                                    <div class="md:col-span-3">
                                        <x-label for="attachments[]">File</x-label>
                                        <input type="file" name="attachments[]" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
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
                                Update Project
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