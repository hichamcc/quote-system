<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pricing Factors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('pricing-factors.update') }}" class="space-y-6">
                        @csrf
                        @method('PUT')

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
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <x-input 
                                                    id="residential_{{ $code }}" 
                                                    name="residential_{{ $code }}" 
                                                    type="number" 
                                                    step="0.01" 
                                                    class="w-full"
                                                    :value="old('residential_' . $code, $pricingFactor->{'residential_' . $code})" 
                                                />
                                                @error('residential_' . $code)
                                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <x-input 
                                                    id="contractor_{{ $code }}" 
                                                    name="contractor_{{ $code }}" 
                                                    type="number" 
                                                    step="0.01" 
                                                    class="w-full"
                                                    :value="old('contractor_' . $code, $pricingFactor->{'contractor_' . $code})" 
                                                />
                                                @error('contractor_' . $code)
                                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                                @enderror
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="flex justify-end space-x-3 mt-6">
                            <a href="{{ route('pricing-factors.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Cancel
                            </a>
                            
                            <x-button type="submit">
                                Update Pricing Factors
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>