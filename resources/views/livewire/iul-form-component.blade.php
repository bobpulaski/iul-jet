<div>
    <form wire:submit="start">
        @csrf
        {{-- Основная информация --}}
        <div class="w-9/12 overflow-hidden bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
            <div class="p-8">

                <h3 class="mb-4">Основная информация</h3>

                <div>
                    <x-label for="name" value="{{ __('Наименование объекта*') }}" />
                    <x-input id="name" wire:model="name" class="mt-1 block w-full" type="text" name="name"
                        required autofocus autocomplete="name" />
                    <div class="text-red-400">
                        @error('name')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 flex flex-row gap-4">
                    <div class="basis-1/4">
                        <x-label for="orderNumber" value="{{ __('№ п/п*') }}" />
                        <x-input id="orderNumber" wire:model="orderNumber" class="mt-1 block w-full" type="number"
                            min="0" name="orderNumber" required autocomplete="orderNumber" />
                    </div>
                    <div class="basis-full">
                        <x-label for="documentDesignation" value="{{ __('Обозначение документа*') }}" />
                        <x-input id="documentDesignation" wire:model="documentDesignation" class="mt-1 block w-full"
                            type="text" name="documentDesignation" required autocomplete="documentDesignation" />
                    </div>
                </div>

                <div class="mt-4 flex flex-row gap-4">
                    <div class="basis-full">
                        <x-label for="documentName" value="{{ __('Наименование документа*') }}" />
                        <x-input id="documentName" wire:model="documentName" class="mt-1 block w-full" type="text"
                            name="documentName" required autocomplete="documentName" />
                    </div>
                    <div class="basis-1/4">
                        <x-label for="versionNumber" value="{{ __('№ версии*') }}" />
                        <x-input id="versionNumber" wire:model="versionNumber" class="mt-1 block w-full" type="number"
                            name="versionNumber" required autocomplete="versionNumber" />
                    </div>
                </div>
            </div>
        </div>

        {{-- Подписи ответственных лиц --}}
        <div class="mt-6 w-9/12 overflow-hidden bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
            <div class="p-8">
                <h3 class="mb-4">Подписи ответственных лиц</h3>
                <div class="mt-4">

                    <div x-data="{
                        rows: [{ kind: '', surname: '' }],
                        addRow() {
                            this.rows.push({ kind: '', surname: '' });
                            this.updateLivewireArray();
                        },
                        deleteRow(index) {
                            this.rows.splice(index, 1);
                            this.updateLivewireArray();
                        },
                        updateLivewireArray() {
                            @this.set('responsiblePersons', this.rows);
                        }
                    }">

                    {{-- TODO: @input="updateLivewireArray()" надо переделать, а то на каждое нажатие в поле ввода реагирует.            Сделал так, потому-что первая строка подписей не попадает в массив, пока не добавишь новую строку --}}

                        <template x-for="(row, index) in rows" :key="index">
                            <div class="mt-4 grid grid-cols-8 gap-4">

                                <div class="col-span-3">
                                    <x-input x-model="row.kind" type="text" class="block w-full"
                                        placeholder="Характер работы" @input="updateLivewireArray()" />
                                </div>

                                <div class="col-span-4">
                                    <x-input x-model="row.surname" type="text" class="block w-full"
                                        placeholder="Фамилия" @input="updateLivewireArray()" />
                                </div>

                                <div class="col-span-1">
                                    <button x-show="index > 0" class="mt-1 rounded-md p-2 hover:bg-slate-100"
                                        @click="deleteRow(index)">
                                        <svg width="24px" height="24px" viewBox="0 0 24.00 24.00" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" stroke="#000000" transform="rotate(0)">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"
                                                transform="translate(0,0), scale(1)">
                                            </g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                                stroke="#CCCCCC" stroke-width="0.624"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M18 6V18C18 19.1046 17.1046 20 16 20H8C6.89543 20 6 19.1046 6 18V6M15 6V5C15 3.89543 14.1046 3 13 3H11C9.89543 3 9 3.89543 9 5V6M4 6H20"
                                                    stroke="#393939" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </template>

                        <div class="mt-4">
                            <x-info-button @click="addRow()">{{ __('Добавить') }}</x-info-button>
                        </div>
                    </div>


                    {{-- Файл и расчёт контрольной суммы --}}
                    <div class="mt-6 w-9/12 overflow-hidden bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
                        <div class="p-8">
                            <h3 class="mb-4">{{ __('Алгоритм расчёта контрольной суммы*') }}</h3>
                            <div class="mt-4 flex flex-row gap-4">
                                <input id="algorithm-radio-crc32" wire:model="currentAlgorithm" type="radio"
                                    value="crc32" name="algorithm-radio"
                                    class="h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600">
                                <label for="algorithm-radio-crc32"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">CRC32</label>

                                <input id="algorithm-radio-md5" wire:model="currentAlgorithm" type="radio"
                                    value="md5" name="algorithm-radio"
                                    class="h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600">
                                <label for="algorithm-radio-md5"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">MD5</label>

                                <input id="algorithm-radio-sha1" wire:model="currentAlgorithm" type="radio"
                                    value="sha1" name="algorithm-radio"
                                    class="h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600">
                                <label for="algorithm-radio-sha1"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">SHA1</label>
                            </div>

                            <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                                x-on:livewire-upload-finish="uploading = false"
                                x-on:livewire-upload-cancel="uploading = false"
                                x-on:livewire-upload-error="uploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">

                                <div class="mt-4 flex flex-row gap-4">


                                    <div class="basis-3/4">
                                        <input id="inputFile" onchange="fileInfo()" class="mt-1 block w-full"
                                            type="file" wire:model="inputFile"
                                            accept=".pdf, .doc, .docx, .xls, .xlsx, .odt, .ods, .xml" name="inputFile"
                                            autofocus />
                                    </div>


                                    <div>
                                        @error('inputFile')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mt-1 basis-1/4 text-right">
                                        <x-button type="button"
                                            wire:click="$cancelUpload('inputFile')">{{ __('Отменить загрузку') }}
                                        </x-button>
                                    </div>

                                </div>

                                <div x-show="uploading" class="mt-2">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="mt-6 w-9/12 overflow-hidden">
                        <div class="py-6">
                            <div class="mt-4 flex items-center justify-end">
                                <x-button>Сформировать</x-button>
                            </div>
                        </div>
                    </div>

    </form>




    @livewire('progress-modal-component')

    <script>
        function fileInfo() {
            var fileInput = document.getElementById('inputFile').files[0];
            if (fileInput) {
                var fileName = fileInput.name;
                var fileSize = fileInput.size;
                var fileType = fileInput.type;
                var fileModifiedDate = new Date(fileInput.lastModified); // Create a Date object from lastModified
                var formattedDate = fileModifiedDate.toLocaleString(); // Format the date for better readability
                var file_info = fileName + "\n" + fileSize + " bytes\n" + fileType + "\nLast Modified: " +
                    formattedDate;

                console.log(formattedDate);

                Livewire.dispatch('file-selected', {
                    formattedDate: formattedDate
                });
            } else {
                alert("No file selected.");
            }
        }
    </script>


    {{-- <script>
                document.getElementById('inputFile').addEventListener('change', function() {
                    var filename = this.files[0].name;
                    document.getElementById('file-label').innerText = filename;
                });
            </script> --}}

    <style>
        input {
            box-shadow: none !important;
        }

        input[type=file]::file-selector-button {
            margin-right: 20px;
            border: none;
            background: #1f2937;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            color: #fff;
            cursor: pointer;
            transition: background .2s ease-in-out;
        }

        input[type=file]::file-selector-button:hover {
            background: #374151;
        }
    </style>

</div>
