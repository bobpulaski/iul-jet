<div>

    @if (Auth::check() && Auth::user()->hasRole('unpaid'))
        <!-- Предположим, есть метод hasRole в вашей модели User -->
        <button>Скрытая кнопка для администраторов</button>
    @endif

    <button type="button" wire:click="phpinfo">PHPINFO</button>

    <form wire:submit="start">
        @csrf

        {{-- Основная информация --}}
        <div class="overflow-hidden bg-white shadow-md sm:rounded-lg dark:bg-gray-800">

            <div class="flex flex-col p-8">

                <x-ui.h3>Основная информация</x-ui.h3>

                {{-- 1# Наименование объекта --}}
                <div class="flex flex-col">
                    <x-label for="name" value="{{ __('Наименование объекта*') }}" />
                    <x-input id="name" wire:model="name" class="mt-1 block w-full" type="text" name="name"
                        required autofocus autocomplete="name" />
                    @error('name')
                        <x-ui.form-validation-error-message :message="$message" />
                    @enderror
                </div>

                {{-- 2# Порядковый номер и обозначение --}}
                <div class="mt-4 flex flex-row gap-4">
                    <div class="flex basis-1/4 flex-col">
                        <x-label for="orderNumber" value="{{ __('№ п/п*') }}" />
                        <x-input id="orderNumber" wire:model="orderNumber" class="mt-1 block w-full" type="number"
                            min="0" name="orderNumber" required autocomplete="orderNumber" />
                        <div class="text-red-400">
                            @error('orderNumber')
                                <x-ui.form-validation-error-message :message="$message" />
                            @enderror
                        </div>
                    </div>
                    <div class="basis-full">
                        <x-label for="documentDesignation" value="{{ __('Обозначение документа*') }}" />
                        <x-input id="documentDesignation" wire:model="documentDesignation" class="mt-1 block w-full"
                            type="text" name="documentDesignation" required autocomplete="documentDesignation" />
                        <div class="text-red-400">
                            @error('documentDesignation')
                                <x-ui.form-validation-error-message :message="$message" />
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- 3# Наименование документа и версия --}}
                <div class="mt-4 flex flex-row gap-4">
                    <div class="basis-10/12">
                        <x-label for="documentName" value="{{ __('Наименование документа*') }}" />
                        <x-input id="documentName" wire:model="documentName" class="mt-1 block w-full" type="text"
                            name="documentName" required autocomplete="documentName" />
                    </div>
                    <div class="basis-2/12">
                        <x-label for="versionNumber" value="{{ __('№ версии*') }}" />
                        <x-input id="versionNumber" min="0" wire:model="versionNumber" class="mt-1 block w-full"
                            type="number" name="versionNumber" required autocomplete="versionNumber" />
                    </div>
                </div>

            </div>
        </div>



        {{-- Файл и расчёт контрольной суммы --}}
        <div class="mt-6 overflow-hidden bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
            <div class="flex flex-col p-8">
                <x-ui.h3>{{ __('Файл и алгоритм расчета контрольной суммы') }}</x-ui.h3>
                <div class="mt-4 flex flex-row gap-4">
                    <input id="algorithm-radio-crc32" wire:model="currentAlgorithm" type="radio" value="crc32"
                        name="algorithm-radio"
                        class="h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600">
                    <label for="algorithm-radio-crc32"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">CRC32</label>

                    <input id="algorithm-radio-md5" wire:model="currentAlgorithm" type="radio" value="md5"
                        name="algorithm-radio"
                        class="h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600">
                    <label for="algorithm-radio-md5"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">MD5</label>

                    <input id="algorithm-radio-sha1" wire:model="currentAlgorithm" type="radio" value="sha1"
                        name="algorithm-radio"
                        class="h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600">
                    <label for="algorithm-radio-sha1"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">SHA1</label>
                </div>

                <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                    x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-cancel="uploading = false"
                    x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                    <div class="mt-4 flex flex-row gap-4">


                        <div class="basis-3/4">
                            {{-- <input id="inputFile" onchange="fileInfo()"
                                class="block w-full mt-1 text-sm text-indigo-700" type="file" wire:model="inputFile"
                                accept=".pdf, .doc, .docx, .xls, .xlsx, .odt, .ods, .xml" name="inputFile" required
                                autofocus /> --}}

                            <input id="inputFile" class="mt-1 block w-full text-sm text-indigo-700" type="file"
                                wire:model="inputFile" accept=".pdf, .doc, .docx, .xls, .xlsx, .odt, .ods, .xml"
                                name="inputFile" required autofocus />
                        </div>


                        <div>
                            @error('inputFile')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- <div class="mt-1 basis-1/4 text-right">
                            <x-button type="button"
                                wire:click="$cancelUpload('inputFile')">{{ __('Отменить загрузку') }}
                            </x-button>
                        </div> --}}

                    </div>

                    {{-- <div x-show="uploading" class="relative mt-4">
                        <div class="w-full rounded-full bg-gray-200 dark:bg-gray-700">
                            <div x-bind:style="'width: ' + progress + '%'"
                                class="rounded-full bg-blue-600 p-3 text-center text-xs font-medium leading-none text-blue-100">
                                <span class="absolute inset-0 flex items-center justify-center text-sm text-white"
                                    x-text="progress + '%'"></span>
                            </div>
                        </div>
                    </div> --}}

                </div>

            </div>
        </div>


        {{-- Подписи ответственных лиц --}}
        <div class="mt-6 overflow-hidden bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
            <div class="flex flex-col p-8">

                <div class="flex flex-row items-center justify-between">
                    <x-ui.h3>{{ __('Подписи ответственных лиц') }}</x-ui.h3>
                    {{-- <x-ui.toggle :data="$rememberResponsiblePersons" wire:model="rememberResponsiblePersons">
                        {{ __('Запомнить') }}
                    </x-ui.toggle> --}}


                    <label class="inline-flex cursor-pointer items-center">
                        <input disabled wire:model="rememberResponsiblePersons" type="checkbox" class="peer sr-only">
                        <div
                            class="peer relative h-6 w-11 rounded-full bg-gray-200 after:absolute after:start-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-blue-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rtl:peer-checked:after:-translate-x-full dark:border-gray-600 dark:bg-gray-700 dark:peer-focus:ring-blue-800">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Запомнить</span>
                    </label>

                </div>


                <div>
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

                        {{-- TODO: @input="updateLivewireArray()" надо переделать, а то на каждое нажатие в поле ввода реагирует.
                                Сделал так, потому-что первая строка подписей не попадает в массив, пока не добавишь новую строку --}}

                        <template x-for="(row, index) in rows" :key="index">

                            {{-- <div class="grid grid-cols-8 gap-4 mt-4"> --}}
                            <div class="flex flex-col">
                                <div class="mb-2 mt-2 flex flex-col gap-4 rounded-md bg-indigo-100 p-4 md:flex-row">

                                    <div class="md:full basis-5/12">
                                        <x-input x-model="row.kind" type="text" class="block w-full"
                                            placeholder="Характер работы" @input="updateLivewireArray()" />
                                    </div>

                                    <div class="md:full basis-6/12">
                                        <x-input x-model="row.surname" type="text" class="block w-full"
                                            placeholder="Фамилия" @input="updateLivewireArray()" />
                                    </div>
                                    <div class="md:full basis-1/12">
                                        <x-danger-button x-show="index > 0" @click="deleteRow(index)">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </x-danger-button>

                                        <!-- <div class="tooltip">Hover over me
                                                    <span class="tooltiptext">Добавить подпись</span>
                                                </div> -->

                                    </div>
                                </div>
                            </div>

                        </template>

                        <div class="mt-4">
                            <x-info-button @click="addRow()"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </x-info-button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="mt-6 flex flex-row justify-self-end">
            {{-- <x-button x-show="!uploading">Сформировать</x-button> --}}
            <x-button id="loadButton">Сформировать</x-button>
            {{-- <template x-if="!uploading">
                <x-button>Сформировать</x-button>
            </template> --}}
            {{-- <x-button :disabled="uploading" x-bind:class="{ 'opacity-50 cursor-not-allowed': uploading }"> --}}

        </div>

    </form>


    @livewire('progress-modal-component')

    <script>
        function crc32(buffer) {
            let crcTable = new Uint32Array(256);
            for (let i = 0; i < 256; i++) {
                let c = i;
                for (let j = 0; j < 8; j++) {
                    c = (c & 1) ? (0xEDB88320 ^ (c >>> 1)) : (c >>> 1);
                }
                crcTable[i] = c >>> 0; // Ensure unsigned
            }

            let crc = 0xFFFFFFFF;
            for (let byte of buffer) {
                crc = (crc >>> 8) ^ crcTable[(crc ^ byte) & 0xFF];
            }
            return (crc ^ 0xFFFFFFFF) >>> 0; // Ensure unsigned
        }

        // Обработка выбора файла и вычисление CRC32
        document.getElementById('inputFile').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (!file) return;

            const button = document.getElementById('loadButton');
            button.textContent = 'Загрузка...'; // Изменяем текст кнопки


            const reader = new FileReader();
            reader.onload = function(e) {
                const arrayBuffer = e.target.result;
                const bytes = new Uint8Array(arrayBuffer);
                const checksum = crc32(bytes); // Вычисляем CRC32 для массива байтов

                button.textContent = 'Сформировать'; // Возвращаем текст кнопки после завершения

                console.log(
                    `${file.name} - CRC32: ${checksum.toString(16)}`
                ); // Выводим результат в шестнадцатеричном формате

                console.log(
                    `${file.size} - size`
                );
            };



            reader.readAsArrayBuffer(file);
        });



        // function fileInfo() {
        //     var fileInput = document.getElementById('inputFile').files[0];
        //     if (fileInput) {
        //         var fileName = fileInput.name;
        //         var fileSize = fileInput.size;
        //         var fileType = fileInput.type;
        //         var fileModifiedDate = new Date(fileInput.lastModified); // Create a Date object from lastModified
        //         var formattedDate = fileModifiedDate.toLocaleString(); // Format the date for better readability
        //         var file_info = fileName + "\n" + fileSize + " bytes\n" + fileType + "\nLast Modified: " +
        //             formattedDate;

        //         console.log(formattedDate);

        //         Livewire.dispatch('file-selected', {
        //             formattedDate: formattedDate
        //         });
        //     } else {
        //         alert("No file selected.");
        //     }
        // }
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



        /* Tooltip container */
        .tooltip {
            position: relative;
            display: inline-block;
            border-bottom: 1px dotted black;
            z-index: 999;
            /* If you want dots under the hoverable text */
        }

        /* Tooltip text */
        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: black;
            color: #fff;
            text-align: center;
            padding: 5px 0;
            border-radius: 6px;

            width: 120px;
            bottom: 100%;
            left: 50%;
            margin-left: -60px;
            /* Use half of the width (120/2 = 60), to center the tooltip */

            /* Position the tooltip text - see examples below! */
            position: absolute;
            z-index: 1;
        }

        /* Show the tooltip text when you mouse over the tooltip container */
        .tooltip:hover .tooltiptext {
            visibility: visible;
        }
    </style>

</div>
