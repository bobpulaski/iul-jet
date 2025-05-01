<div class="hidden text-md font-semibold sm:ms-6 sm:flex sm:items-center">
    @if (Route::has('login'))
        <nav class="flex flex-1 items-center justify-end gap-5">
            <a href="/docs/intro/" class="transition duration-300 ease-in-out hover:text-slate-500 mr-8">
                Документация
            </a>
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="flex flex-row gap-2 justify-between items-center transition duration-300 ease-in-out hover:text-slate-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                    </svg>

                    <span>Личный кабинет</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="transition duration-300 ease-in-out hover:text-slate-500">
                    Войти
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="rounded-md bg-slate-800 px-3 py-2 text-white transition duration-300 ease-in-out hover:bg-slate-950">
                        Регистрация
                    </a>
                @endif
            @endauth
        </nav>
    @endif
</div>
