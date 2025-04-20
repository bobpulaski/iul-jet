<div>
    <div class="mb-4 flex flex-row items-center justify-between">
        @if ($signsData->isEmpty())
            <x-ui.p>У вас не добавлено ни одной подписи.</x-ui.p>
            <x-button wire:click="showAddNewSignModal()" title="Добавить подпись">Добавить</x-button>
        @else
            <div></div> <!-- Пустой див для заполнения пространства -->
            <x-button wire:click="showAddNewSignModal()" title="Добавить подпись">Добавить</x-button>
        @endif
    </div>

    <div class="mb-3 {{-- overflow-hidden --}} bg-white p-8 shadow-md sm:rounded-lg dark:bg-gray-800">
        <x-ui.table>
            <x-ui.thead>
                <x-ui.th>Характер работы</x-ui.th>
                <x-ui.th>Ф.И.О.</x-ui.th>
                <x-ui.th>Факсимиле</x-ui.th>
                <x-ui.th></x-ui.th>
            </x-ui.thead>
            <tbody>
                @foreach ($signsData as $item)
                    <x-ui.tr>
                        <x-ui.td>
                            <x-ui.p>{{ $item->kind }}</x-ui.p>
                        </x-ui.td>
                        <x-ui.td>
                            <x-ui.p>{{ $item->surname }}</x-ui.p>
                        </x-ui.td>
                        @if (!$item->file_src)
                            <x-ui.td>
                                <x-ui.p>
                                    Нет изображения
                                </x-ui.p>
                            </x-ui.td>
                        @else
                            <x-ui.td>
                                <img class="rounded-md" src="{{ asset('storage/' . $item['file_src']) }}"
                                    alt="Подпись для {{ $item->surname }}" width="75" height="50">
                            </x-ui.td>
                        @endif
                        <x-ui.td class="text-end">
                            <x-ui.dropdown-action class="z-50">
                                <x-slot name="content">
                                    <div class="block px-4 py-2 text-xs text-gray-400 text-left">
                                        {{ __('Действия') }}
                                    </div>

                                    <div class="flex flex-row items-center gap-2">

                                        <x-dropdown-link wire:click="" class="flex items-center cursor-pointer">
                                            <x-ui.icons.edit-icon />
                                            <span class="ml-2">Редактировать</span>
                                        </x-dropdown-link>
                                    </div>

                                    <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                    <x-dropdown-link wire:click="showConfirmingSignDeletion({{ $item->id }})"
                                        wire:loading.attr="disabled"
                                        class="flex items-center cursor-pointer text-red-400">
                                        <x-ui.icons.trash-icon />
                                        <span class="ml-2 text-red-400">Удалить</span>
                                    </x-dropdown-link>
                                </x-slot>
                            </x-ui.dropdown-action>
                        </x-ui.td>
                    </x-ui.tr>
                @endforeach
            </tbody>
        </x-ui.table>


        <x-ui.dialog-modal-for-form wire:model="isShowAddNewSignModal">

            <x-slot name="title">
                <div class="px-6 pt-4">

                    {{ __('Добавление подписи') }}
                </div>
            </x-slot>


            <x-slot name="content">

                <form wire:submit="save">
                    @csrf

                    <div class="flex flex-col gap-4 px-6 py-4">
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
                            <x-label for="surname" value="{{ __('Фамилия лица, подписавшего документ*') }}" />
                            <x-input id="surname" wire:model="surname" type="text" required
                                class="mt-1 block w-full" name="surname" />
                            <div>
                                @error('surname')
                                    <x-ui.form-validation-error-message :message="$message" />
                                @enderror
                            </div>
                        </div>
                        <div class="full">
                            <x-label for="sign-image-file" value="{{ __('Подпись') }}" />
                            <x-input id="sign-image-file" wire:model="signImageFile" wire:click="suka()" type="file"
                                accept="image/png, image/jpeg, image/bmp, image/jpg" class="mt-1 block w-full"
                                name="signImageFile" nullable />
                            <div>
                                {{-- Еще валидирую отдельно и вывожу ошибку JS --}}
                                <p id="error-message" style="color: red; display: none;"></p>


                                @error('signImageFile')
                                    <x-ui.form-validation-error-message :message="$message" />
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div id="footer"
                        class="flex flex-row justify-end px-6 py-4 bg-gray-100 dark:bg-gray-800 text-end mt-4">

                        <div>
                            <x-secondary-button wire:click="$toggle('isShowAddNewSignModal')"
                                wire:loading.attr="disabled">
                                {{ __('Отмена') }}
                            </x-secondary-button>
                        </div>

                        <div>
                            <div wire:loading.remove>
                                <x-button type="submit" class="ml-2">
                                    {{ __('OK') }}
                                </x-button>
                            </div>

                            <div wire:loading>
                                <x-button class="ml-2" disabled>
                                    {{ __('Подождите...') }}
                                </x-button>
                            </div>
                        </div>
                    </div>
                </form>
            </x-slot>

        </x-ui.dialog-modal-for-form>

        <!-- Delete Sign From List Confirmation Modal -->
        <x-dialog-modal wire:model.live="isShowConfirmingSignDeletionModal">
            <x-slot name="title">
                {{ __('Удаление подписи') }}
            </x-slot>
            <x-slot name="content">
                {{ __('Вы действительно хотите удалить подпись?') }}
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('isShowConfirmingSignDeletionModal')"
                    wire:loading.attr="disabled">
                    {{ __('Отмена') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="deleteSign" wire:loading.attr="disabled">
                    {{ __('Удалить') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>


        <script>
            /*  window.onload = function () {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          document.getElementById("sign-image-file").onchange = checkFileSizeAndType;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      };*/
        </script>


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
