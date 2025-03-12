<div>

    @foreach ($historyData as $item)
        <div class="mb-3 overflow-hidden bg-white p-8 shadow-md sm:rounded-lg dark:bg-gray-800">
            <div class="flex flex-row gap-2 pb-4">
                <p class="text-sm font-semibold">Дата создания:</p>
                <p class="text-sm">{{ \Carbon\Carbon::parse($item->created_at)->format('d.m.Y в H:i:s') }}</p>
            </div>

            <div class="flex flex-row gap-2 pb-4">
                <p class="text-sm font-semibold">Наименование объекта:</p>
                <p class="text-sm">{{ $item->name }}</p>
            </div>
            <div class="flex flex-row gap-2 pb-4">
                <p class="text-sm font-semibold">Обозначение документа:</p>
                <p class="text-sm">{{ $item->document_designation }}</p>
            </div>
            <div class="flex flex-row gap-2 pb-4">
                <p class="text-sm font-semibold">Наименование документа:</p>
                <p class="text-sm">{{ $item->document_name }}</p>
            </div>

            <div class="flex flex-row gap-4 pb-4">
                <div class="flex flex-row gap-1 rounded-md bg-sky-100 p-2">
                    <p class="text-sm font-semibold">№ п/п:</p>
                    <p class="text-sm">{{ $item->order_number }}</p>
                </div>
                <div class="flex flex-row gap-1 rounded-md bg-sky-100 p-2">
                    <p class="text-sm font-semibold">№ версии:</p>
                    <p class="text-sm">{{ $item->version_number }}</p>
                </div>
                <div class="flex flex-row gap-1 rounded-md bg-sky-100 p-2">
                    <p class="text-sm font-semibold">Алгоритм:</p>
                    <p class="text-sm">{{ $item->algorithm }}</p>
                </div>
            </div>



        </div>
    @endforeach


    {{-- <div class="overflow-hidden bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
        <div class="flex flex-col p-8">
            <div class="flex flex-col">
                <x-label for="file-type">На страницу</x-label>
                <select id="per-page" wire:model.live="perPage"
                    class="mb-4 mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600">
                    <option value="10" selected>10</option>
                    <option value="20">20</option>
                    <option value="35">35</option>
                    <option value="0">Все</option>
                </select>
            </div>

            <div class="relative overflow-x-auto">

                <table class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">Дата</th>
                            <th scope="col" class="px-6 py-3">Наименование объекта</th>
                            <th scope="col" class="px-6 py-3">Обозначение</th>
                            <th scope="col" class="px-6 py-3">Наименование документа</th>
                            <th scope="col" class="px-6 py-3">Алгоритм</th>
                            <th scope="col" class="px-6 py-3">Футер?</th>
                            <th scope="col" class="px-6 py-3">Тип файла</th>
                            <th scope="col" class="px-6 py-3">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($historyData as $item)
                            <tr class="border-b border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
                                <td class="px-6 py-4">{{ $item->id }}</td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d.m.Y H:i:s') }}
                                </td>
                                <td class="px-6 py-4">{{ $item->name }}</td>
                                <td class="px-6 py-4">{{ $item->document_designation }}</td>
                                <td class="px-6 py-4">{{ $item->document_name }}</td>
                                <td class="px-6 py-4">{{ $item->algorithm }}</td>
                                <td class="px-6 py-4">{{ $item->is_footer }}</td>
                                <td class="px-6 py-4">{{ $item->file_type }}</td>
                                <td class="px-6 py-4">
                                    <x-button wire:click="reportSave({{ $item->id }})">Скачать</x-button>
                                    @php
                                        $id = $item->id * 2 * 52;
                                    @endphp
                                    <x-button wire:click="reportEdit({{ $id }})">Edit</x-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    {{ $historyData->links() }}
                </table>
            </div>
        </div>

    </div> --}}
</div>

<script type="module">
    document.addEventListener('livewire:init', () => {
        Livewire.on('redirectToReport', (event) => {
            window.open('{{ route('htmlreport') }}', '_blank'); // Открывает в новой вкладке
        });
    });
</script>
