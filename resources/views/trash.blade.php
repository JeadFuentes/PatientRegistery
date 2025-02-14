<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Deleted Patients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if (session()->has('message'))
            <div class="mt-2 bg-teal-500 text-sm text-white rounded-lg p-4" role="alert" tabindex="-1" aria-labelledby="hs-solid-color-success-label">
                <span id="hs-solid-color-success-label" class="font-bold">Success</span> {{ session('message') }}.
            </div>
        @endif
        <div class=" sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <livewire:deleted-patient />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>