<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Place Takeoffs') }} - {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">All Place Takeoffs</h3>
                        <div class="flex space-x-2">
                            <a href="{{ route('projects.show', $project) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Back to Project
                            </a>
                            <a href="{{ route('projects.takeoffs.create', $project) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Add Place Takeoffs
                            </a>
                            @if($placeTakeoffs->count() > 0)
                                <form method="POST" action="{{ route('projects.takeoffs.destroy', $project) }}" onsubmit="return confirm('Are you sure you want to delete all place takeoffs for this project?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                                        Delete All Takeoffs
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    @if($placeTakeoffs->count() > 0)
                        <div class="space-y-8">
                            @foreach($placeTakeoffs as $placeTakeoff)
                                <div class="bg-white shadow overflow-hidden sm:rounded-lg border">
                                    <div class="px-4 py-5 sm:px-6 bg-gray-50">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                            {{ $placeTakeoff->place }}
                                        </h3>
                                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                            Created on {{ $placeTakeoff->created_at->format('F d, Y') }}
                                        </p>
                                    </div>

                                    <div class="border-t border-gray-200">
                                        <div class="px-4 py-5 sm:px-6">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                                <!-- Top Details -->
                                                @if($placeTakeoff->tops->count() > 0)
                                                    <div class="bg-blue-50 p-4 rounded-lg">
                                                        <h4 class="text-md font-medium text-gray-900 mb-2">Top Details</h4>
                                                        <dl class="grid grid-cols-2 gap-x-4 gap-y-2">
                                                            @foreach($placeTakeoff->tops->first()->getAttributes() as $attribute => $value)
                                                                @if(!in_array($attribute, ['id', 'place_takeoff_id', 'created_at', 'updated_at']) && $value)
                                                                    <dt class="text-sm font-medium text-gray-500">{{ ucwords(str_replace('_', ' ', $attribute)) }}</dt>
                                                                    <dd class="text-sm text-gray-900">{{ $value }}</dd>
                                                                @endif
                                                            @endforeach
                                                        </dl>
                                                    </div>
                                                @endif

                                                <!-- Backsplash Details -->
                                                @if($placeTakeoff->backsplashes->count() > 0)
                                                    <div class="bg-green-50 p-4 rounded-lg">
                                                        <h4 class="text-md font-medium text-gray-900 mb-2">Backsplash Details</h4>
                                                        <dl class="grid grid-cols-2 gap-x-4 gap-y-2">
                                                            @foreach($placeTakeoff->backsplashes->first()->getAttributes() as $attribute => $value)
                                                                @if(!in_array($attribute, ['id', 'place_takeoff_id', 'created_at', 'updated_at']) && $value)
                                                                    <dt class="text-sm font-medium text-gray-500">{{ ucwords(str_replace('_', ' ', $attribute)) }}</dt>
                                                                    <dd class="text-sm text-gray-900">{{ $value }}</dd>
                                                                @endif
                                                            @endforeach
                                                        </dl>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            No place takeoffs found for this project. <a href="{{ route('projects.takeoffs.create', $project) }}" class="text-indigo-600 hover:text-indigo-900">Add one now</a>.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>