<div>
    <x-dropdown>
        <x-slot name="trigger">
            <span class="inline-flex rounded-md">
                <span class="inline-flex rounded-md">
                    <button type="button"
                        class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 active:bg-gray-900 disabled:opacity-50 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">
                        <p class="uppercase">Добавить</p>
                        <svg class="-me-0.5 ms-2 size-4 text-slate-100" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                </span>
            </span>
        </x-slot>
        <x-slot name="content">
            {{ $content }}
        </x-slot>
    </x-dropdown>
</div>
