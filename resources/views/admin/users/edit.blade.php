<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('admin.users.index') }}" class="text-indigo-600 hover:text-indigo-900">
                            &larr; Back to Users
                        </a>
                    </div>

                    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div>
                            <x-label for="name">Name</x-label>
                            <x-input id="name" type="text" name="name" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                            @error('name')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="email">Email</x-label>
                            <x-input id="email" type="email" name="email" :value="old('email', $user->email)" required autocomplete="username" />
                            @error('email')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div class="mt-4">
                            <x-label for="role">Role</x-label>
                            <x-select id="role" name="role">
                                <option value="estimator" {{ (old('role', $user->role) == 'estimator') ? 'selected' : '' }}>Estimator</option>
                                <option value="admin" {{ (old('role', $user->role) == 'admin') ? 'selected' : '' }}>Admin</option>
                            </x-select>
                            @error('role')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-label for="password">Password</x-label>
                            <x-input id="password" type="password" name="password" autocomplete="new-password" />
                            <p class="text-sm text-gray-500 mt-1">Leave blank to keep current password</p>
                            @error('password')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-label for="password_confirmation">Confirm Password</x-label>
                            <x-input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" />
                            @error('password_confirmation')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button type="submit">
                                Update User
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>