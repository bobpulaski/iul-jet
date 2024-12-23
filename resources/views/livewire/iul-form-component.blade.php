<div>
    <div class="dark:bg-gray-800 max-w-3xl overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <div class="p-6">

            <x-validation-errors class="mb-4" />

            <form wire:submit="start">
                @csrf

                <div>
                    <x-label for="name" value="{{ __('Наименование объекта') }}" />
                    <x-input id="name" wire:model="name" class="mt-1 block w-full" type="text" name="name"
                        :value="old('name')" autofocus autocomplete="name" />
                </div>

                <div class="mt-4 flex flex-row gap-4">
                    <div class="basis-1/4">
                        <x-label for="order-number" value="{{ __('№ п/п*') }}" />
                        <x-input id="order-number" class="mt-1 block w-full" type="number" min="0"
                            name="order-number" :value="old('order-number')" required autofocus autocomplete="order-number" />
                    </div>
                    <div class="basis-full">
                        <x-label for="document-designation" value="{{ __('Обозначение документа*') }}" />
                        <x-input id="document-designation" class="mt-1 block w-full" type="text"
                            name="document-designation" :value="old('document-designation')" required autofocus
                            autocomplete="document-designation" />
                    </div>
                </div>

                <div class="mt-4 flex flex-row gap-4">
                    <div class="basis-full">
                        <x-label for="document-name" value="{{ __('Наименование документа*') }}" />
                        <x-input id="document-name" class="mt-1 block w-full" type="text" name="document-name"
                            :value="old('document-name')" required autofocus autocomplete="name" />
                    </div>
                    <div class="basis-1/4">
                        <x-label for="version-number" value="{{ __('№ версии*') }}" />
                        <x-input id="version-number" class="mt-1 block w-full" type="number" name="order-number"
                            :value="old('order-number')" required autofocus autocomplete="order-number" />
                    </div>
                </div>



                <div class="mt-4 flex flex-row gap-4">
                    <x-label for="algorithm-radio" value="{{ __('Алгоритм расчёта контрольной суммы*') }}" />
                </div>

                <div class="mt-4 flex flex-row gap-4">
                    <input checked id="algorithm-radio-crc32" type="radio" value="crc32" name="algorithm-radio"
                        class="dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600 h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500">
                    <label for="algorithm-radio-crc32"
                        class="dark:text-gray-300 ms-2 text-sm font-medium text-gray-900">CRC32</label>

                    <input id="algorithm-radio-md5" type="radio" value="md5" name="algorithm-radio"
                        class="dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600 h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500">
                    <label for="algorithm-radio-md5"
                        class="dark:text-gray-300 ms-2 text-sm font-medium text-gray-900">MD5</label>

                    <input id="algorithm-radio-sha1" type="radio" value="sha1" name="algorithm-radio"
                        class="dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600 h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500">
                    <label for="algorithm-radio-sha1"
                        class="dark:text-gray-300 ms-2 text-sm font-medium text-gray-900">SHA1</label>
                </div>


                <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                    x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-cancel="uploading = false"
                    x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                    <div class="mt-4 flex flex-row gap-4">
                        <div class="basis-full">
                            <x-input id="file-add" class="mt-1 w-full" type="file" wire:model="inputFile"
                                accept=".pdf, .doc, .docx, .xls, .xlsx, .odt, .ods, .xml" name="file-add"
                                :value="old('file-add')" required autofocus autocomplete="file-add" />
                        </div>

                        <!-- Cancel upload button -->
                        <button type="button" wire:click="$cancelUpload('inputFile')">Cancel Upload</button>
                    </div>

                    <!-- Progress Bar -->
                    <div x-show="uploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                </div>


                <div class="mt-4 flex items-center justify-end">
                    <x-button>Сформировать</x-button>
                </div>

            </form>
            @livewire('progress-modal-component')
        </div>
    </div>

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
            background: #084cdf;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            color: #fff;
            cursor: pointer;
            transition: background .2s ease-in-out;
        }

        input[type=file]::file-selector-button:hover {
            background: #0d45a5;
        }
    </style>

</div>
