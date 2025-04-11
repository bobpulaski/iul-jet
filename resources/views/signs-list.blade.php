<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-baseline justify-between gap-2">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Подписи') }}
            </h2>
            <p class="text-red-600">Раздел в процессе разработки</p>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @livewire('iul-signs-list-component')
        </div>
    </div>
</x-app-layout>
