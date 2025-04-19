<div>
    <x-dropdown>
        <x-slot name="trigger">
            <span class="inline-flex rounded-md">
                <span class="inline-flex rounded-md">
                    <button type="button"
                        class="inline-flex items-center rounded-md border border-transparent bg-slate-200 px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:bg-gray-50 focus:outline-none active:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300 dark:focus:bg-gray-700 dark:active:bg-gray-700">
                        <p>. . .</p>
                        <svg class="-me-0.5 ms-2 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
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
