<div>


    <div class="w-9/12 overflow-hidden bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
        <div class="p-8">

            <x-validation-errors class="mb-4" />

            <form wire:submit="start">
                @csrf
                <h3 class="mb-4">Основная информация</h3>
                <div>
                    <x-label for="name" value="{{ __('Наименование объекта') }}" />
                    <x-input id="name" wire:model="name" class="block w-full mt-1" type="text" name="name"
                        :value="old('name')" autofocus autocomplete="name" />
                </div>

                <div class="flex flex-row gap-4 mt-4">
                    <div class="basis-1/4">
                        <x-label for="order-number" value="{{ __('№ п/п*') }}" />
                        <x-input id="order-number" class="block w-full mt-1" type="number" min="0"
                            name="order-number" :value="old('order-number')" required autofocus autocomplete="order-number" />
                    </div>
                    <div class="basis-full">
                        <x-label for="document-designation" value="{{ __('Обозначение документа*') }}" />
                        <x-input id="document-designation" class="block w-full mt-1" type="text"
                            name="document-designation" :value="old('document-designation')" required autofocus
                            autocomplete="document-designation" />
                    </div>
                </div>

                <div class="flex flex-row gap-4 mt-4">
                    <div class="basis-full">
                        <x-label for="document-name" value="{{ __('Наименование документа*') }}" />
                        <x-input id="document-name" class="block w-full mt-1" type="text" name="document-name"
                            :value="old('document-name')" required autofocus autocomplete="name" />
                    </div>
                    <div class="basis-1/4">
                        <x-label for="version-number" value="{{ __('№ версии*') }}" />
                        <x-input id="version-number" class="block w-full mt-1" type="number" name="order-number"
                            :value="old('order-number')" required autofocus autocomplete="order-number" />
                    </div>
                </div>
        </div>
    </div>

    <div class="w-9/12 mt-6 overflow-hidden bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
        <div class="p-8">
            <h3 class="mb-4">{{ __('Алгоритм расчёта контрольной суммы*') }}</h3>
            <div class="flex flex-row gap-4 mt-4">
                <input checked id="algorithm-radio-crc32" type="radio" value="crc32" name="algorithm-radio"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600">
                <label for="algorithm-radio-crc32"
                    class="text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">CRC32</label>

                <input id="algorithm-radio-md5" type="radio" value="md5" name="algorithm-radio"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600">
                <label for="algorithm-radio-md5"
                    class="text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">MD5</label>

                <input id="algorithm-radio-sha1" type="radio" value="sha1" name="algorithm-radio"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600">
                <label for="algorithm-radio-sha1"
                    class="text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">SHA1</label>
            </div>
            <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-cancel="uploading = false"
                x-on:livewire-upload-error="uploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">

                <div class="flex flex-row gap-4 mt-4">
                    <div class="basis-3/4">
                        <input id="file-add" class="block w-full mt-1" type="file" wire:model="inputFile"
                            accept=".pdf, .doc, .docx, .xls, .xlsx, .odt, .ods, .xml" name="file-add" required
                            autofocus />
                    </div>

                    <!-- Cancel upload button -->
                    <div class="mt-1 text-right basis-1/4">
                        <x-button type="button" wire:click="$cancelUpload('inputFile')">{{ __('Отменить загрузку') }}
                        </x-button>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div x-show="uploading" class="mt-2">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
            </div>
        </div>
    </div>

    <div class="w-9/12 mt-6 overflow-hidden bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
        <div class="p-8">
            <h3 class="mb-4">Подписи ответственных лиц</h3>
            <div class="mt-4">
                <div x-data="{
                    rows: [{ kind: '', surname: '' }],
                    addRow() {
                        this.rows.push({
                            kind: '',
                            surname: '',
                        });
                    },
                    deleteRow(index) {
                        this.rows.splice(index, 1);
                    }
                }">

                    <template x-for="(row, index) in rows" :key="index">
                        <div class="grid grid-cols-8 gap-4 mt-4">

                            <div class="col-span-3">
                                <x-input x-model="row.kind" type="text" class="block w-full"
                                    placeholder="Характер работы" />
                            </div>

                            <div class="col-span-4">
                                <x-input x-model="row.surname" type="text" class="block w-full"
                                    placeholder="Фамилия" />
                            </div>

                            <div class="col-span-1">
                                <button x-show="index > 0" class="p-2 mt-1 rounded-md hover:bg-slate-100"
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
            </div>

        </div>
    </div>


    <div class="w-9/12 mt-6 overflow-hidden">
        <div class="py-6">
            <div class="flex items-center justify-end mt-4">
                <x-button>Сформировать</x-button>
            </div>
        </div>
    </div>

    </form>
    @livewire('progress-modal-component')



    <script>
        document.getElementById('file-add').addEventListener('change', function() {
            var filename = this.files[0].name;
            document.getElementById('file-label').innerText = filename;
        });
    </script>

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
