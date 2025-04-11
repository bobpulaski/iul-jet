<form wire:submit="send">

    <div class="flex justify-start">
        <div class="w-2/3 overflow-hidden bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
            <div class="flex flex-col p-8">

                <x-ui.h3>Обратная связь</x-ui.h3>

                <div class="mt-4 flex flex-col">
                    <x-label for="request-type" value="{{ __('Выберите тип обращения') }}" />


                    <select id="request-type" wire:model="requestType" autofocus
                        class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-sky-600 dark:focus:ring-sky-600">
                        @foreach ($requestTypes as $requestType)
                            <option value="{{ $requestType->value }}">{{ $requestType->value }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4 flex flex-col">
                    <x-label for="request-subject" value="{{ __('Тема*') }}" />
                    <x-input id="request-subject" wire:model="requestSubject" class="mt-1 block w-full" type="text"
                        name="requestSubject" autocomplete="subject" required autofocus />
                    <div class="text-red-400">
                        @error('requestSubject')
                            <x-ui.form-validation-error-message :message="$message" />
                        @enderror
                    </div>
                </div>

                <div class="mt-4 flex flex-col">
                    <x-label for="request-body" value="{{ __('Сообщение*') }}" />
                    <x-textarea id="request-body" rows="5" wire:model="requestBody" class="mt-1 block w-full"
                        name="requestBody" required autofocus></x-textarea>

                    <div class="text-red-400">
                        @error('requestBody')
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

<script>
    window.addEventListener('show-banner-and-redirect', event => {
        setTimeout(() => {
            window.location.href = '{{ route('dashboard') }}';
        }, 3000); // Подождите 3 секунды перед переходом
    });
</script>
