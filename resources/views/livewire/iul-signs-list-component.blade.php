<div>
    <div class="mb-4 flex flex-row items-center justify-between">
        @if ($signsData->isEmpty())
            <x-ui.p>У вас не добавлено ни одной подписи.</x-ui.p>
        @endif
        <x-button wire:click="showAddNewSignModal()">Добавить</x-button>
    </div>

    @foreach ($signsData as $item)
        <div class="mb-3 overflow-hidden bg-white p-8 shadow-md sm:rounded-lg dark:bg-gray-800">

            <div class="flex flex-row justify-between gap-4 items-center">
                <div class="flex flex-col justify-between">
                    <div class="flex flex-row items-center justify-start pb-3 gap-2">
                        <x-ui.p>Характер работы:</x-ui.p>
                        <x-ui.p class="font-semibold">{{ $item->kind }}</x-ui.p>
                    </div>
                    <div class="flex flex-row items-center justify-start pb-3 gap-2">
                        <x-ui.p>ФИО:</x-ui.p>
                        <x-ui.p class="font-semibold">{{ $item->surname }}</x-ui.p>
                    </div>
                </div>
                <div>image</div>
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

                <div class="flex flex-col gap-4">
                    <div class="full">
                        <x-input wire:model="kind" type="text" required autofocus class="mt-1 block w-full"
                            placeholder="Характер работы" />
                        <div>
                            @error('kind')
                                <x-ui.form-validation-error-message :message="$message" />
                            @enderror
                        </div>
                    </div>
                    <div class="full">
                        <x-input wire:model="surname" type="text" required class="mt-1 block w-full"
                            placeholder="Фамилия" />
                        <div>
                            @error('surname')
                                <x-ui.form-validation-error-message :message="$message" />
                            @enderror
                        </div>
                    </div>
                    <div class="full">
                        <x-input wire:model="signImageFile" type="file" class="mt-1 block w-full"
                            placeholder="Подпись" />
                        <div>
                            @error('signImageFile')
                                <x-ui.form-validation-error-message :message="$message" />
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <div>
                <x-secondary-button wire:click="$toggle('isShowAddNewSignModal')" wire:loading.attr="disabled">
                    {{ __('Отмена') }}
                </x-secondary-button>
            </div>
            <div>
                <x-button wire:click="save()" class="ml-2">
                    {{ __('OK') }}
                </x-button>
            </div>

        </x-slot>
    </x-dialog-modal>

</div>
