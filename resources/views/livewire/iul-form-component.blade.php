<div>

    @if (Auth::check() && Auth::user()->hasRole('unpaid'))
        <!-- Предположим, есть метод hasRole в вашей модели User -->
        <button>Скрытая кнопка для администраторов</button>
    @endif

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

                        {{-- TODO: @input="updateLivewireArray()" надо переделать, а то на каждое нажатие в поле ввода
                        реагирует.
                        Сделал так, потому-что первая строка подписей не попадает в массив, пока не добавишь новую
                        строку --}}

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
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
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

        {{-- Файл --}}
        <div class="mt-6 overflow-hidden bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
            <div class="flex flex-col p-8">
                <x-ui.h3>{{ __('Файл') }}</x-ui.h3>
                <input id="inputFile" class="block w-full text-sm text-indigo-700" type="file" accept=""
                    name="inputFile" required autofocus />
                <div>
                    @error('inputFile')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Алгоритм --}}
        <div class="mt-6 overflow-hidden bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
            <div class="flex flex-col p-8">
                <x-ui.h3>{{ __('Алгоритм расчета контрольной суммы') }}</x-ui.h3>
                <div class="mt-4 flex flex-row gap-4">
                    <input id="algorithm-radio-md5" wire:model="currentAlgorithm" type="radio" value="md5"
                        name="algorithm-radio"
                        class="h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600">
                    <label for="algorithm-radio-md5"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">MD5</label>

                    <input id="algorithm-radio-crc32" wire:model="currentAlgorithm" type="radio" value="crc32"
                        name="algorithm-radio"
                        class="h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600">
                    <label for="algorithm-radio-crc32"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">CRC32</label>

                    <input id="algorithm-radio-sha1" wire:model="currentAlgorithm" type="radio" value="sha1"
                        name="algorithm-radio"
                        class="h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600" />
                    <label for="algorithm-radio-sha1"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">SHA1</label>
                </div>
            </div>
        </div>




        {{-- Настройки --}}
        <div class="mt-6 overflow-hidden bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
            <div class="flex flex-row p-8">
                <div>
                    <x-label for="file-type">Формат файла</x-label>
                    <select id="file-type" wire:model="fileType"
                        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600">
                        <option value="docx" selected>DOCX</option>
                        <option value="pdf">PDF</option>
                        <option value="odt">ODT</option>
                        <option value="html">HTML</option>
                    </select>
                </div>
                <div>
                    <x-ui.h3>{{ __('Алгоритм расчета контрольной суммы') }}</x-ui.h3>
                    {{-- <div class="mt-4 flex flex-row gap-4">

                        <input id="algorithm-radio-md5" wire:model="currentAlgorithm" type="radio" value="md5"
                            name="algorithm-radio"
                            class="h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600">
                        <label for="algorithm-radio-md5"
                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">MD5</label>

                        <input id="algorithm-radio-crc32" wire:model="currentAlgorithm" type="radio"
                            value="crc32" name="algorithm-radio"
                            class="h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600">
                        <label for="algorithm-radio-crc32"
                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">CRC32</label>

                        <input id="algorithm-radio-sha1" wire:model="currentAlgorithm" type="radio" value="sha1"
                            name="algorithm-radio"
                            class="h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600" />
                        <label for="algorithm-radio-sha1"
                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">SHA1</label>
                    </div> --}}
                </div>
            </div>
        </div>



        <div class="align-items-center mt-6 flex flex-row justify-end">
            {{-- <x-button x-show="!uploading">Сформировать</x-button> --}}
            <x-button id="loadButton">Сформировать</x-button>



            {{-- <template x-if="!uploading">
                <x-button>Сформировать</x-button>
            </template> --}}
            {{-- <x-button :disabled="uploading" x-bind:class="{ 'opacity-50 cursor-not-allowed': uploading }"> --}}

        </div>

    </form>


    @livewire('progress-modal-component')

    <script type="module">
        let currentAlgorithm = '{{ $currentAlgorithm }}'; // Получаю значение по умолчанию

        const fileSelector = document.getElementById("inputFile");
        const resultElement = document.getElementById("loadButton");
        const algorithmRadios = document.querySelectorAll('input[name="algorithm-radio"]');

        // Обработчик изменения радиокнопок
        algorithmRadios.forEach((radio) => {
            radio.addEventListener('change', (event) => {
                currentAlgorithm = event.target.value; // Обновляем текущий алгоритм
                const file = fileSelector.files[0]; // Получаем выбранный файл
                update(file);
            });
        });

        // Обработчик изменения выбора файла
        fileSelector.addEventListener("change", async (event) => {
            const file = event.target.files[0]; // Получаем выбранный файл
            await update(file);
        });

        async function update(file) {
            if (!file) {
                resultElement.innerHTML = "Сначала выберите файл!";
                return;
            }

            resultElement.innerHTML = "Loading...";

            const start = Date.now();
            const hash = await readFile(file, currentAlgorithm); // Передаем текущий алгоритм
            const end = Date.now();

            const duration = end - start;
            const fileSizeMB = file.size / 1024 / 1024;
            const throughput = fileSizeMB / (duration / 1000);
            const fileSize = file.size;
            const fileName = file.name;
            const fileType = file.type;
            const fileModifiedDate = new Date(file.lastModified); // Создаем объект Date из lastModified
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric',
                hour12: false // Установите false, если хотите 24-часовой формат
            };

            const formattedDate = fileModifiedDate.toLocaleString('ru-RU',
                options); // Форматируем дату для лучшей читаемости

            console.log(`
                Hash: ${currentAlgorithm} - ${hash}
                FileName: ${fileName}
                fileSize: ${fileSize}
                fileType: ${fileType}
                formattedDate: ${formattedDate}
                Throughput: ${throughput.toFixed(2)} MB/s
                Duration: ${duration} ms
            `);

            resultElement.innerHTML = "Сформировать";
            const fileData = {
                hash: hash,
                fileName: fileName,
                formattedDate: formattedDate,
                fileSize: fileSize,
            };

            console.log(fileData);

            Livewire.dispatch('compose', {
                fileData: fileData
            });
        }


        // let currentAlgorithm = '{{ $currentAlgorithm }}'; // Получаю значение по умолчанию

        // const fileSelector = document.getElementById("inputFile");
        // const resultElement = document.getElementById("loadButton");
        // const algorithmRadios = document.querySelectorAll('input[name="algorithm-radio"]');

        // // Обработчик изменения радиокнопок
        // algorithmRadios.forEach((radio) => {
        //     radio.addEventListener('change', (event) => {
        //         currentAlgorithm = event.target.value; // Обновляем текущий алгоритм
        //         update();
        //     });
        // });

        // fileSelector.addEventListener("change", async (event) => {
        //     await update();
        // });

        // async function update() {
        //     const file = event.target.files[0];
        //     let fileData = null;

        //     resultElement.innerHTML = "Loading...";
        //     const start = Date.now();

        //     const hash = await readFile(file, currentAlgorithm); // Передаем текущий алгоритм
        //     const end = Date.now();

        //     const duration = end - start;
        //     const fileSizeMB = file.size / 1024 / 1024;
        //     const throughput = fileSizeMB / (duration / 1000);
        //     const fileSize = file.size;
        //     const fileName = file.name;
        //     const fileType = file.type;
        //     const fileModifiedDate = new Date(file.lastModified); // Создаем объект Date из lastModified
        //     const options = {
        //         year: 'numeric',
        //         month: 'long',
        //         day: 'numeric',
        //         hour: 'numeric',
        //         minute: 'numeric',
        //         second: 'numeric',
        //         hour12: false // Установите false, если хотите 24-часовой формат
        //     };

        //     const formattedDate = fileModifiedDate.toLocaleString('ru-RU',
        //         options); // Форматируем дату для лучшей читаемости

        //     console.log(`
    //         Hash: ${currentAlgorithm} - ${hash}
    //         FileName: ${fileName}
    //         fileSize: ${fileSize}
    //         fileType: ${fileType}
    //         formattedDate: ${formattedDate}
    //         Throughput: ${throughput.toFixed(2)} MB/s
    //         Duration: ${duration} ms
    //     `);

        //     resultElement.innerHTML = "Сформировать";

        //     fileData = {
        //         fileName: fileName,
        //         fileSize: fileSize,
        //         hash: hash
        //     };

        //     console.log(fileData);

        //     Livewire.dispatch('compose', {
        //         fileData: fileData
        //     });
        // }
    </script>


    {{--
    <script>
        document.getElementById('inputFile').addEventListener('change', function () {
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
