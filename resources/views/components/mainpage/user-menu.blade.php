<div class="hidden sm:ms-6 sm:flex sm:items-center font-normal text-sm">
    @if (Route::has('login'))
        <nav class="flex flex-1 justify-end gap-5 items-center">
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="rounded-md px-3 text-slate-700 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Личный кабинет
                </a>
            @else
                <a href="{{ route('login') }}" class="transition duration-300 ease-in-out hover:text-white/10">
                    Войти
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="transition duration-300 ease-in-out hover:bg-orange-500 bg-orange-700 px-3 py-2 rounded-md text-white">
                        Регистрация
                    </a>
                @endif
            @endauth
        </nav>
    @endif
</div>
