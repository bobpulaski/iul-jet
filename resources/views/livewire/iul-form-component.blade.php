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
                <div class="flex flex-row">
                    <x-label for="name" value="{{ __('Наименование объекта*') }}" />
                </div>

                <div class="relative flex flex-row items-center justify-between gap-4">
                    <div class="w-full">
                        <x-input id="name" wire:model="name" class="mt-1 block w-full" type="text" name="name"
                            required autofocus autocomplete="name" />
                        @error('name')
                            <x-ui.form-validation-error-message :message="$message" />
                        @enderror
                    </div>

                    <x-input id="is-title-toggle" wire:model="isTitle" type="checkbox" class="h-5 w-5" />


                </div>



                {{-- 2# Порядковый номер и обозначение --}}
                <div class="mt-4 flex flex-row gap-4">
                    <div class="basis-2/12">
                        <x-label for="orderNumber" value="{{ __('№ п/п') }}" />
                        <x-input id="orderNumber" wire:model="orderNumber" class="mt-1 block w-full" type="number"
                            min="0" name="orderNumber" autocomplete="orderNumber" />
                        <div class="text-red-400">
                            @error('orderNumber')
                                <x-ui.form-validation-error-message :message="$message" />
                            @enderror
                        </div>
                    </div>
                    <div class="basis-10/12">
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
                        <div class="text-red-400">
                            @error('documentName')
                                <x-ui.form-validation-error-message :message="$message" />
                            @enderror
                        </div>
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
        <div class="mt-3 overflow-hidden bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
            <div class="flex flex-col p-8">

                <div class="flex flex-row items-center justify-between">
                    <x-ui.h3>{{ __('Подписи ответственных лиц') }}</x-ui.h3>
                    <div class="flex flex-row gap-4 align-middle">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Запомнить</p>
                        <x-ui.toggle wire:model="isRememberSignatures">
                            {{ __('Запомнить') }}
                        </x-ui.toggle>
                    </div>
                </div>


                <div>
                    <div x-data="{
                        {{-- rows: [{ kind: '', surname: '', signdate: '' }], --}}
                        rows: $wire.entangle('responsiblePersons'),
                    
                            addRow() {
                                this.rows.push({ kind: '', surname: '', signdate: '' });
                                {{-- this.updateLivewireArray(); --}}
                            },
                    
                            deleteRow(index) {
                                this.rows.splice(index, 1);
                                {{-- this.updateLivewireArray(); --}}
                            },
                            {{--
                            updateLivewireArray() {
                                @this.set('responsiblePersons', this.rows);
                            } --}}
                    }">


                        {{-- TODO: @input="updateLivewireArray()" надо переделать, а то на каждое нажатие в поле ввода
                        реагирует.
                        Сделал так, потому-что первая строка подписей не попадает в массив, пока не добавишь новую
                        строку --}}
                        <template x-for="(row, index) in rows" :key="index">

                            <div class="">
                                <div
                                    class="mb-2 mt-2 flex flex-col items-center gap-4 rounded-md bg-sky-100 p-4 md:flex-row">

                                    <div class="md:full basis-4/12">
                                        <x-input x-model="row.kind" type="text" class="block w-full"
                                            placeholder="Характер работы" />
                                    </div>

                                    <div class="md:full basis-5/12">
                                        <x-input x-model="row.surname" type="text" class="block w-full"
                                            placeholder="Фамилия" />
                                    </div>

                                    <div class="md:full basis-3/12">
                                        <x-input x-model="row.signdate" class="block w-full" type="date" />
                                    </div>



                                    <div class="md:full basis-1/12">
                                        <x-danger-button x-show="index > 0" @click="deleteRow(index)"
                                            title="Удалить подпись">
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
                            <x-info-button @click="addRow()" title="Добавить подпись"><svg
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
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
        <div class="mt-3 overflow-hidden bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
            <div class="flex flex-col p-8">
                <x-ui.h3>{{ __('Файл') }}</x-ui.h3>
                <input id="inputFile" class="block w-full text-sm text-sky-700" type="file" accept=""
                    name="inputFile" required autofocus />
                <div>
                    @error('inputFile')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Алгоритм --}}
        <div class="mt-3 overflow-hidden bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
            <div class="flex flex-col p-8">
                <x-ui.h3>{{ __('Алгоритм расчета контрольной суммы') }}</x-ui.h3>
                <div class="mt-4 flex flex-row gap-4">
                    <input id="algorithm-radio-md5" wire:model="algorithm" type="radio" value="md5"
                        name="algorithm-radio"
                        class="h-4 w-4 border-gray-300 bg-gray-100 text-sky-600 focus:ring-2 focus:ring-sky-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-sky-600">
                    <label for="algorithm-radio-md5"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">MD5</label>

                    <input id="algorithm-radio-crc32" wire:model="algorithm" type="radio" value="crc32"
                        name="algorithm-radio"
                        class="h-4 w-4 border-gray-300 bg-gray-100 text-sky-600 focus:ring-2 focus:ring-sky-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-sky-600">
                    <label for="algorithm-radio-crc32"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">CRC32</label>

                    <input id="algorithm-radio-sha1" wire:model="algorithm" type="radio" value="sha1"
                        name="algorithm-radio"
                        class="h-4 w-4 border-gray-300 bg-gray-100 text-sky-600 focus:ring-2 focus:ring-sky-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-sky-600" />
                    <label for="algorithm-radio-sha1"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">SHA1</label>
                </div>
            </div>
        </div>


        {{-- Подвал --}}
        <div class="mt-3 overflow-hidden bg-white shadow-md sm:rounded-lg dark:bg-gray-800">

            <div x-data="{ isFooterEnabled: @entangle('isFooter') }" class="flex flex-col p-8">
                <div class="flex flex-row items-center justify-between">
                    <x-ui.h3>{{ __('Подвал') }}</x-ui.h3>
                    <div class="flex flex-row gap-4 align-middle">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Печать</p>
                        <x-ui.toggle id="is-footer-toggle" x-model="isFooterEnabled" />
                    </div>
                </div>

                <div class="flex flex-row items-center gap-4">
                    <div class="basis-full">
                        <x-label for="description" value="{{ __('Обозначение') }}" x-bind:disabled="!isFooterEnabled"
                            x-bind:class="{ 'opacity-30': !isFooterEnabled, 'opacity-100': isFooterEnabled }" />
                        <x-input id="description" wire:model="description" x-bind:disabled="!isFooterEnabled"
                            x-bind:class="{ 'opacity-30': !isFooterEnabled, 'opacity-100': isFooterEnabled }"
                            class="mt-1 block w-full" type="text" name="description" autofocus
                            autocomplete="description" />
                    </div>
                    <div class="basis-2/12">
                        <x-label for="page" value="{{ __('Лист') }}" x-bind:disabled="!isFooterEnabled"
                            x-bind:class="{ 'opacity-30': !isFooterEnabled, 'opacity-100': isFooterEnabled }" />
                        <x-input id="page" wire:model="page" x-bind:disabled="!isFooterEnabled"
                            x-bind:class="{ 'opacity-30': !isFooterEnabled, 'opacity-100': isFooterEnabled }"
                            class="mt-1 block w-full" type="number" min="0" name="page"
                            autocomplete="page" />
                    </div>
                    <div class="basis-2/12">
                        <x-label for="pages" value="{{ __('Листов') }}" x-bind:disabled="!isFooterEnabled"
                            x-bind:class="{ 'opacity-30': !isFooterEnabled, 'opacity-100': isFooterEnabled }" />
                        <x-input id="pages" wire:model="pages" x-bind:disabled="!isFooterEnabled"
                            x-bind:class="{ 'opacity-30': !isFooterEnabled, 'opacity-100': isFooterEnabled }"
                            class="mt-1 block w-full" type="number" min="0" name="pages"
                            autocomplete="pages" />
                    </div>
                </div>
            </div>


        </div>


        {{-- Настройки --}}
        <div class="mt-3 overflow-hidden bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
            <div class="flex flex-col p-8">
                <x-ui.h3>{{ __('Настройки') }}</x-ui.h3>
                <div class="flex flex-row items-center gap-4">

                    <div class="flex flex-col">
                        <x-label for="file-type">Тип файла</x-label>
                        <select id="file-type" wire:model="fileType"
                            class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-sky-600 dark:focus:ring-sky-600">
                            <option value="pdf">PDF</option>
                            <option value="docx" selected>DOCX</option>
                            {{-- <option value="odt">ODT</option> --}}
                            <option value="html">HTML</option>
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <x-label for="header-type">Начертание заголовков</x-label>
                        <select id="header-type" wire:model="headerType"
                            class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-sky-600 dark:focus:ring-sky-600">
                            <option value="regular" selected>Regular</option>
                            <option value="bold" class="font-bold">Bold</option>
                            <option value="italic" class="italic">Italic</option>
                            <option value="italic-bold" class="font-bold italic">Bold Italic</option>
                        </select>
                    </div>

                </div>

            </div>
        </div>


        {{-- Сформировать --}}
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
        document.addEventListener('livewire:init', () => {
            Livewire.on('redirectToReport', (event) => {
                window.open('{{ route('htmlreport') }}', '_blank'); // Открывает в новой вкладке
            });
        });


        let algorithm = '{{ $algorithm }}'; // Получаю значение по умолчанию

        const fileSelector = document.getElementById("inputFile");
        const resultElement = document.getElementById("loadButton");
        const algorithmRadios = document.querySelectorAll('input[name="algorithm-radio"]');

        // Обработчик изменения радиокнопок
        algorithmRadios.forEach((radio) => {
            radio.addEventListener('change', (event) => {
                algorithm = event.target.value; // Обновляем текущий алгоритм
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
            const hash = await readFile(file, algorithm); // Передаем текущий алгоритм
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
                hour12: false // Установите true, если хотите 12-часовой формат
            };

            const formattedDate = fileModifiedDate.toLocaleString('ru-RU',
                options); // Форматируем дату для лучшей читаемости

            console.log(`
                Hash: ${algorithm} - ${hash}
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


        // let currentAlgorithm = '{{ $algorithm }}'; // Получаю значение по умолчанию

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
