<div>
    <section>
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-2 lg:px-6">

            <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
                <h2 class="mb-4 mt-8 text-3xl tracking-tight font-bold text-gray-700 dark:text-white">Выберите удобную
                    для вас сумму или укажите свою</h2>

            </div>

            <div class="space-y-8 grid 2xl:grid-cols-4 sm:gap-6 xl:gap-10 lg:space-y-0">
                <!-- Pricing Card -->
                <div
                    class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border-4 border-sky-500 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                    <h3 class="mb-4 text-xl font-semibold">На кофе</h3>
                    <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">В нашей команде тоже любят горячие
                        напитки.</p>
                    <div class="flex justify-center items-baseline my-8">
                        <span class="mr-2 text-5xl font-bold text-sky-500">500 ₽</span>
                    </div>

                    <button type="button" wire:click="donateFix(500)"
                            class="text-white bg-slate-600 hover:bg-slate-500 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-primary-900">
                        Поддержать
                    </button>
                </div>
                <!-- Pricing Card -->
                <div
                    class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border-4 border-sky-600 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                    <h3 class="mb-4 text-xl font-semibold">Поддержка!</h3>
                    <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">Наймём дизайнера на полный рабочий
                        день.</p>
                    <div class="flex justify-center items-baseline my-8">
                        <span class="mr-2 text-5xl font-bold text-sky-600">1000 ₽</span>
                    </div>

                    <button type="button" wire:click="donateFix(1000)"
                            class="text-white bg-slate-600 hover:bg-slate-500 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-primary-900">
                        Поддержать
                    </button>
                </div>
                <!-- Pricing Card -->
                <div
                    class="relative flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border-4 border-sky-700 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">

                    <!-- MOST POPULAR плашка -->
                    <div class="absolute -top-3 left-1/2 transform -translate-x-1/2">
                        <span class="bg-pink-500 text-white text-xs text- font-bold px-3 py-1 rounded-full">
                            СУПЕР!
                        </span>
                    </div>

                    <h3 class="mb-4 text-xl font-semibold">Просто нет слов...</h3>
                    <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">Отдельное спасибо за такой
                        уровень!</p>
                    <div class="flex justify-center items-baseline my-8">
                        <span class="mr-2 text-5xl font-bold text-sky-700">2000 ₽</span>
                    </div>

                    <button type="button" wire:click="donateFix(2000)"
                            class="text-white bg-slate-600 hover:bg-slate-500 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-primary-900">
                        Поддержать
                    </button>
                </div>


                <!-- Pricing Card -->
                <div
                    class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                    <h3 class="mb-4 text-xl font-semibold">Произвольная сумма</h3>
                    <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">Как вам будет удобно.</p>

                    <form wire:submit.prevent="donateFree">
                        <div class="flex justify-center items-baseline my-9">
                            <x-input wire:model="freeAmount" name="amount" type="number" placeholder="Например, 500"
                                     required class="mt-7"/>
                        </div>

                        <button type="submit"
                                class="w-full text-white bg-slate-600 hover:bg-slate-500 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-primary-900">
                            Поддержать
                        </button>

                    </form>
                </div>


            </div>
        </div>
    </section>

    <section class="py-2 px-4 mx-auto max-w-screen-xl 2xl:py-8 lg:px-6">
        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-2">
                <x-label for="terms">
                    <div class="flex flex-col justify-between">
                        <div>
                            {!! __(
                                'Нажимая на кнопку «Поддержать» вы соглашаетесь с :Пользовательским соглашением и :Политикой конфиденциальности',
                                [
                                    'Пользовательским соглашением' =>
                                        '<a href="/terms.pdf" target="_blank" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                        __('Пользовательским соглашением') .
                                        '</a>',
                                    'Политикой конфиденциальности' =>
                                        '<a href="/policy.pdf" target="_blank" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                        __('Политикой конфиденциальности').
                                        '</a>',
                                ],
                            ) !!}
                        </div>
                        <p class="mt-2">Электронный чек будет отправлен вам на указанный при регистрации адрес
                            электронной почты.</p>
                        <p class="my-2">Платежный шлюз предоставлен <a class="underline text-sky-600"
                                                                       href="https://yookassa.ru/" target="_blank">Сервисом
                                для работы с платежами в интернете — ЮKassa.</a></p>
                    </div>
                </x-label>
            </div>
        @endif
    </section>
</div>
