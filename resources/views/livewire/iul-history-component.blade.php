<div>

    @if ($historyData->isEmpty())
        <x-ui.p>Записей в истории пока нет. <x-nav-link href="{{ route('dashboard') }}" wire:navigate
                :active="request()->routeIs('dashboard')">{{ __('Создайте свой первый лист.') }} </x-nav-link>
        </x-ui.p>
    @else
        <div class="mb-4 flex flex-row items-center justify-between">
            <div class="">

                <x-label wire:click="showConfirmingHistoryDisposalModal"
                    class="cursor-pointer hover:text-red-600 transition duration-150 ease-in-out flex flex-row gap-2 items-center text-red-400"><x-ui.icons.exclamation-circle />
                    Очистить
                    историю</x-label>
            </div>
            <div class="flex flex-row items-center gap-2">
                <x-ui.p>Записей на страницу: </x-ui.p>
                <select id="per-page" wire:model.live="perPage"
                    class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600">
                    <option value="10" selected>10</option>
                    <option value="20">20</option>
                    <option value="35">35</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
        @foreach ($historyData as $item)
            <div class="mb-3 overflow-hidden bg-white p-8 shadow-md sm:rounded-lg dark:bg-gray-800">
                <div class="flex flex-row items-center justify-between pb-3">
                    <div class="flex flex-row gap-2">
                        <x-ui.p>Дата создания:</x-ui.p>
                        <x-ui.p class="font-semibold">
                            {{ \Carbon\Carbon::parse($item->created_at)->format('d.m.Y в H:i:s') }} <span
                                class="font-light text-slate-400">(MSK)</span></x-ui.p>
                    </div>
                    <div>
                        <x-ui.dropdown-action>
                            <x-slot name="content">
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Действия') }}
                                </div>
                                @php
                                    $id = $item->id * 52;
                                @endphp
                                <div class="flex flex-row items-center gap-2">
                                    <x-dropdown-link wire:click="reportEdit({{ $id }})"
                                        href="javascript:void(0);" class="flex items-center">
                                        <x-ui.icons.edit-icon />
                                        <span class="ml-2">Редактировать</span>
                                    </x-dropdown-link>
                                </div>

                                <x-dropdown-link wire:click="reportSave({{ $id }})" href="javascript:void(0);"
                                    class="flex items-center">
                                    <x-ui.icons.download-icon />
                                    <span class="ml-2">Скачать</span>
                                </x-dropdown-link>

                                <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                <x-dropdown-link wire:click="confirmHistoryDeletion({{ $id }})"
                                    wire:loading.attr="disabled" href="javascript:void(0);"
                                    class="flex items-center text-red-400">
                                    <x-ui.icons.trash-icon />
                                    <span class="ml-2 text-red-400">Удалить</span>
                                </x-dropdown-link>
                            </x-slot>
                        </x-ui.dropdown-action>
                    </div>
                </div>


                <div class="flex flex-row gap-2 pb-4">
                    <x-ui.p>Наименование объекта:</x-ui.p>
                    <x-ui.p class="font-semibold">{{ $item->name }}</x-ui.p>
                </div>
                <div class="flex flex-row gap-2 pb-4">
                    <x-ui.p>Обозначение документа:</x-ui.p>
                    <x-ui.p class="font-semibold">{{ $item->document_designation }}</x-ui.p>
                </div>
                <div class="flex flex-row gap-2 pb-4">
                    <x-ui.p>Наименование документа:</x-ui.p>
                    <x-ui.p class="font-semibold">{{ $item->document_name }}</x-ui.p>
                </div>
                <div class="flex flex-row gap-2 pb-4">
                    <x-ui.p>Имя файла:</x-ui.p>
                    <x-ui.p class="font-semibold italic">{{ $item->file_name }}</x-ui.p>
                </div>

                <div class="flex flex-row gap-4 pb-4">
                    <div class="flex flex-row gap-1 rounded-md bg-sky-100 p-2">
                        <x-ui.p>№ п/п:</x-ui.p>
                        <x-ui.p class="font-semibold">{{ $item->order_number }}</x-ui.p>
                    </div>
                    <div class="flex flex-row gap-1 rounded-md bg-sky-100 p-2">
                        <x-ui.p>№ версии:</x-ui.p>
                        <x-ui.p class="font-semibold">{{ $item->version_number }}</x-ui.p>
                    </div>
                    <div class="flex flex-row gap-1 rounded-md bg-green-100 p-2">
                        <x-ui.p>Алгоритм:</x-ui.p>
                        <x-ui.p class="font-semibold">{{ $item->algorithm }}</x-ui.p>
                    </div>
                    <div class="flex flex-row gap-1 rounded-md bg-violet-100 p-2">
                        <x-ui.p>Тип файла:</x-ui.p>
                        <x-ui.p class="font-semibold">{{ $item->file_type }}</x-ui.p>
                    </div>
                    <div class="flex flex-row gap-1 rounded-md bg-violet-100 p-2">
                        <x-ui.p>Начертание:</x-ui.p>
                        <x-ui.p class="font-semibold">{{ $item->header_type }}</x-ui.p>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $historyData->links() }}

    @endif

    {{-- Delete History Confirmation Modal --}}

    <x-dialog-modal wire:model.live="confirmingHistoryDeletion"> // TODO Напрашивается вынести в отдельный компонент
        <x-slot name="title">
            {{ __('Удаление подписи') }}
        </x-slot>
        <x-slot name="content">
            <p>{{ __('Вы действительно хотите удалить запись из истории?') }}</p>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingHistoryDeletion')" wire:loading.attr="disabled">
                {{ __('Отмена') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="deleteHistory" wire:loading.attr="disabled">
                {{ __('Удалить') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Clear History Confirmation Modal -->
    <x-dialog-modal wire:model.live="isShowConfirmingHistoryDisposalModal">
        <x-slot name="title">
            {{ __('Удаление истории') }}
        </x-slot>
        <x-slot name="content">
            <p>{{ __('Вы действительно хотите удалить все записи из истории?') }}</p>
        </x-slot>
        <x-slot name="description">
            <p>{{ __('Данную операцию нельзя отменить.') }}</p>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('isShowConfirmingHistoryDisposalModal')"
                wire:loading.attr="disabled">
                {{ __('Отмена') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="clearAllHistory" wire:loading.attr="disabled">
                {{ __('Удалить') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>


</div>

<script type="module">
    document.addEventListener('livewire:init', () => {
        Livewire.on('redirectToReport', (event) => {
            window.open('{{ route('htmlreport') }}', '_blank'); // Открывает в новой вкладке
        });
    });
</script>
