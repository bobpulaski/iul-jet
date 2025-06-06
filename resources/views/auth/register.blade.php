<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-mainpage.logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <x-honeypot />

            <div>
                <x-label for="name" value="{{ __('Имя') }}" />
                <x-input id="name" class="mt-1 block w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Пароль') }}" />
                <x-input id="password" class="mt-1 block w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Подтвердите пароль') }}" />
                <x-input id="password_confirmation" class="mt-1 block w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />


                            <div class="ms-2">
                                {!! __(
                                    'Нажимая на кнопку «Регистрация» я соглашаюсь с :Пользовательским соглашением и :Политикой конфиденциальности',
                                    [
                                        'Пользовательским соглашением' =>
                                            '<a href="/terms.pdf" target="_blank" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                            __('Пользовательским соглашением') .
                                            '</a>',
                                        'Политикой конфиденциальности' =>
                                            '<a href="/policy.pdf" target="_blank" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                            __('Политикой конфиденциальности') .
                                            '</a>',
                                    ],
                                ) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="mt-4 flex items-center justify-end">
                <a class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                    href="{{ route('login') }}">
                    {{ __('Уже зарегистрированы? Войти') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Регистрация') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
