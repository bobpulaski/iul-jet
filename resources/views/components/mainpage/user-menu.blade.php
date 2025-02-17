<div class="hidden text-sm font-normal sm:ms-6 sm:flex sm:items-center">
    @if (Route::has('login'))
        <nav class="flex flex-1 items-center justify-end gap-5">
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="rounded-md px-3 text-slate-700 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Личный кабинет
                </a>
            @else
                <a href="{{ route('login') }}" class="font-semibold transition duration-300 ease-in-out hover:text-slate-500">
                    Войти
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="rounded-md bg-slate-800 px-3 py-2 font-semibold text-white transition duration-300 ease-in-out hover:bg-slate-950">
                        Регистрация
                    </a>
                @endif
            @endauth
        </nav>
    @endif
</div>
