<div>
    <div class="mb-4 flex flex-row items-center justify-between">
        @if ($signsData->isEmpty())
            <x-ui.p>У вас не добавлено ни одной подписи.</x-ui.p>
        @endif
        <x-button wire:click="showAddNewSignModal()">Добавить</x-button>
    </div>

    @foreach ($signsData as $item)
        <div class="mb-3 overflow-hidden bg-white p-8 shadow-md sm:rounded-lg dark:bg-gray-800">

            <div class="flex flex-row items-center justify-between gap-4">
                <div class="flex flex-col justify-between">
                    <div class="flex flex-row items-center justify-start gap-2 pb-3">
                        <x-ui.p>Характер работы или должность:</x-ui.p>
                        <x-ui.p class="font-semibold">{{ $item->kind }}</x-ui.p>
                    </div>
                    <div class="flex flex-row items-center justify-start gap-2 pb-3">
                        <x-ui.p>Фамилия лица, подписавший документ:</x-ui.p>
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
            <form wire:submit="save" enctype="multipart/form-data">
                @csrf

                <div class="flex flex-col gap-4">
                    <div class="full">
                        <x-label for="kind" value="{{ __('Характер работы или должность*') }}" />
                        <x-input id="kind" wire:model="kind" type="text" required autofocus
                            class="mt-1 block w-full" name="kind" />
                        <div>
                            @error('kind')
                                <x-ui.form-validation-error-message :message="$message" />
                            @enderror
                        </div>
                    </div>
                    <div class="full">
                        <x-label for="surname" value="{{ __('Фамилия лица, подписавший документ*') }}" />
                        <x-input id="surname" wire:model="surname" type="text" required class="mt-1 block w-full"
                            name="surname" />
                        <div>
                            @error('surname')
                                <x-ui.form-validation-error-message :message="$message" />
                            @enderror
                        </div>
                    </div>
                    <div class="full">
                        <x-label for="signImageFile" value="{{ __('Подпись') }}" />
                        <x-input id="signImageFile" wire:model="signImageFile" wire:click="suka()" type="file"
                            accept="image/png, image/jpeg, image/bmp, image/jpg" class="mt-1 block w-full"
                            name="signImageFile" />
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
                <div wire:loading.remove>
                    <x-button wire:click="save()" class="ml-2">
                        {{ __('OK') }}
                    </x-button>
                </div>

                <div wire:loading>
                    <x-button class="ml-2" disabled>
                        {{ __('Подождите...') }}
                    </x-button>
                </div>
            </div>
        </x-slot>
        {{-- <x-slot name="footer">
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

        </x-slot> --}}
    </x-dialog-modal>

    <style>
        input[type=file]::file-selector-button {
            margin-right: 20px;
            border: none;
            background: #1f2937;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            color: #fff;
            cursor: pointer;
            transition: background .2s ease-in-out;
            letter-spacing: .1rem;
            line-height: 1rem;
        }

        input[type=file]::file-selector-button:hover {
            background: #374151;
        }
    </style>

</div>
