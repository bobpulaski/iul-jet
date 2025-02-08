<div class="hidden sm:ms-6 sm:flex sm:items-center">
    @if (Route::has('login'))
        <nav class="flex flex-1 justify-end">
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="rounded-md px-3 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Личный кабинет
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="rounded-md px-3 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Войти
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="rounded-md px-3 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Регистрация
                    </a>
                @endif
            @endauth
        </nav>
    @endif
</div>