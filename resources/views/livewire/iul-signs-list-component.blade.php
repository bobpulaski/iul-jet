<div>

    <div class="mb-4 flex flex-row items-center justify-between">
        @if ($signsData->isEmpty())
            <x-ui.p>У вас не добавлено ни одной подписи.</x-ui.p>
        @endif
        <x-button wire:click="showAddNewSignModal()">Добавить</x-button>
    </div>

    @foreach ($signsData as $item)
        <div class="mb-3 overflow-hidden bg-white p-8 shadow-md sm:rounded-lg dark:bg-gray-800">
            <div class="flex flex-row items-center justify-between pb-3">
                1
            </div>
        </div>
    @endforeach

    <x-dialog-modal wire:model.live="isShowAddNewSignModal">
        <x-slot name="title">
            {{ __('Добавление подписи') }}
        </x-slot>
        <x-slot name="content">
            <form wire:submit="start">
                @csrf
                <div class="md:full basis-4/12">
                    <x-input type="text" class="mb-8 block w-full" placeholder="Характер работы" />
                </div>
                <div class="md:full basis-5/12">
                    <x-input type="text" class="mb-8 block w-full" placeholder="Фамилия" />
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('isShowAddNewSignModal')" wire:loading.attr="disabled">
                {{ __('Отмена') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

</div>