{{-- resources/views/pricing-factors/edit.blade.php --}}
<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pricing Factors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('pricing-factors.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-1">
                                <h3 class="text-lg font-medium text-gray-900">Pricing Factor</h3>
                                <p class="mt-1 text-sm text-gray-600">
                                    Update your pricing factors for both residential and contractor customers.
                                </p>
                            </div>

                            <div class="md:col-span-2">
                                <div class="grid grid-cols-1 gap-6">
                                    {{-- Main Pricing Factors --}}
                                    @foreach($factorNames as $code => $name)
                                        @if(!in_array($code, ['vein_exact_match', 'electrical_cutout', 'demo']))
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 border border-gray-200 rounded-lg">
                                                <div class="md:col-span-2">
                                                    <h4 class="text-md font-medium text-gray-700 mb-2">{{ $name }}</h4>
                                                </div>
                                                
                                                <div>
                                                    <x-label for="residential_{{ $code }}">
                                                        Residential {{ in_array($code, ['overhead', 'waste', 'profit']) ? '(%)' : '($)' }}
                                                    </x-label>
                                                    <x-input 
                                                        id="residential_{{ $code }}" 
                                                        name="residential_{{ $code }}" 
                                                        type="number" 
                                                        step="{{ in_array($code, ['overhead', 'waste', 'profit']) ? '0.01' : '0.01' }}"
                                                        :value="old('residential_' . $code, $pricingFactor->{'residential_' . $code})" 
                                                        required 
                                                    />
                                                    @error('residential_' . $code)
                                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div>
                                                    <x-label for="contractor_{{ $code }}">
                                                        Contractor {{ in_array($code, ['overhead', 'waste', 'profit']) ? '(%)' : '($)' }}
                                                    </x-label>
                                                    <x-input 
                                                        id="contractor_{{ $code }}" 
                                                        name="contractor_{{ $code }}" 
                                                        type="number" 
                                                        step="0.01"
                                                        :value="old('contractor_' . $code, $pricingFactor->{'contractor_' . $code})" 
                                                        required 
                                                    />
                                                    @error('contractor_' . $code)
                                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                    {{-- Service Prices Section --}}
                                    <div class="border-t border-gray-200 pt-6">
                                        <h3 class="text-lg font-medium text-gray-900 mb-4">Additional Service Prices</h3>
                                        
                                        @foreach(\App\Models\PricingFactor::getServicePrices() as $code => $name)
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 border border-gray-200 rounded-lg mb-4">
                                                <div class="md:col-span-2">
                                                    <h4 class="text-md font-medium text-gray-700 mb-2">{{ $name }}</h4>
                                                </div>
                                                
                                                <div>
                                                    <x-label for="residential_{{ $code }}">Residential ($)</x-label>
                                                    <x-input 
                                                        id="residential_{{ $code }}" 
                                                        name="residential_{{ $code }}" 
                                                        type="number" 
                                                        step="0.01"
                                                        :value="old('residential_' . $code, $pricingFactor->{'residential_' . $code} ?? 0)" 
                                                        required 
                                                    />
                                                    @error('residential_' . $code)
                                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div>
                                                    <x-label for="contractor_{{ $code }}">Contractor ($)</x-label>
                                                    <x-input 
                                                        id="contractor_{{ $code }}" 
                                                        name="contractor_{{ $code }}" 
                                                        type="number" 
                                                        step="0.01"
                                                        :value="old('contractor_' . $code, $pricingFactor->{'contractor_' . $code} ?? 0)" 
                                                        required 
                                                    />
                                                    @error('contractor_' . $code)
                                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 pt-6 border-t border-gray-200">
                            <a href="{{ route('pricing-factors.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-3">
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