@props(['id' => null, 'model' => null])

<label class="mb-auto inline-flex cursor-pointer items-center">
    <input type="checkbox" id="{{ $id }}" {{ $attributes->merge(['wire:model' => $model]) }}
        class="peer sr-only">
    <div
        class="peer relative h-6 w-11 rounded-full bg-gray-200 after:absolute after:start-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-sky-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-sky-300 rtl:peer-checked:after:-translate-x-full dark:border-sky-600 dark:bg-gray-700 dark:peer-focus:ring-sky-800">
    </div>
</label>
