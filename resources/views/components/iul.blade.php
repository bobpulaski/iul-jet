<div class="p-6">
    <form>
        <x-form-section>
            <x-form-label for="name" value="Name" />
            <x-input id="name" class="block mt-1 w-full" type="text" wire:model.defer="name" />
    </x-form>
    <x-button>Close</x-button>
</div>
