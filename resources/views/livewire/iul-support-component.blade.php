    <form wire:submit="send">

        <div class="flex justify-start">
            <div class="w-2/3 overflow-hidden bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
                <div class="flex flex-col p-8">

                    <x-ui.h3>Обратная связь</x-ui.h3>

                    <div class="mt-4 flex flex-col">
                        <x-label for="type" value="{{ __('Выберите тип обращения') }}" />
                        <select id="type" wire:model="type"
                            class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-sky-600 dark:focus:ring-sky-600">
                            @foreach ($types as $type)
                                <option value="{{ $type->name }}">{{ $type->value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4 flex flex-col">
                        <x-label for="subject" value="{{ __('Тема*') }}" />
                        <x-input id="requestSubject" wire:model="subject" class="mt-1 block w-full" type="text"
                            name="subject" autocomplete="subject" required autofocus />
                        <div class="text-red-400">
                            @error('subject')
                                <x-ui.form-validation-error-message :message="$message" />
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4 flex flex-col">
                        <x-label for="body" value="{{ __('Сообщение*') }}" />
                        <x-textarea rows="5" id="requestBody" wire:model="body" class="mt-1 block w-full"
                            name="body" required autofocus></x-textarea>

                        <div class="text-red-400">
                            @error('body')
                                <x-ui.form-validation-error-message :message="$message" />
                            @enderror
                        </div>
                    </div>

                    <div class="align-items-center mt-6 flex flex-row justify-end">
                        <x-button id="send-button">Отправить</x-button>
                    </div>


                </div>
            </div>
        </div>

    </form>
