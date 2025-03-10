<div>
    <div class="overflow-hidden bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
        <div class="flex flex-col p-8">

            <x-ui.h3>iul-history-component</x-ui.h3>

            <div class="relative overflow-x-auto">

                <table class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Дата</th>
                            <th scope="col" class="px-6 py-3">Наименование объекта</th>
                            <th scope="col" class="px-6 py-3">Обозначение</th>
                            <th scope="col" class="px-6 py-3">Наименование документа</th>
                            <th scope="col" class="px-6 py-3">Алгоритм</th>
                            <th scope="col" class="px-6 py-3">Имя файла</th>
                            <th scope="col" class="px-6 py-3">Тип файла</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($historyData as $item)
                            <tr class="border-b border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d.m.Y H:i:s') }}
                                </td>
                                <td class="px-6 py-4">{{ $item->name }}</td>
                                <td class="px-6 py-4">{{ $item->document_designation }}</td>
                                <td class="px-6 py-4">{{ $item->document_name }}</td>
                                <td class="px-6 py-4">{{ $item->algorithm }}</td>
                                <td class="px-6 py-4">{{ $item->file_name }}</td>
                                <td class="px-6 py-4">{{ $item->file_type }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
