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

                    <form method="POST" action="{{ route('projects.update', $project) }}" class="space-y-6">
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
</x-layouts.app>