<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Конструктор информационно-удостоверяющих листов для экспертизы') }}
        </h2> --}}
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
            @livewire('iul-form-component')
        </div>
    </div>
</x-app-layout>
