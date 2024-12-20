<div>


    <!-- Modal toggle -->
    <button wire:click="openModal" data-modal-target="static-modal" data-modal-toggle="static-modal"
        class="dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 block rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300"
        type="button">
        Toggle modal
    </button>

    @if ($isOpen)
        <div id="static-modal" wire:model="isOpen" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 flex h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden bg-slate-300 bg-opacity-50 backdrop-blur-sm">

            <div class="relative max-h-full w-full max-w-2xl p-4">
                <!-- Modal content -->
                <div class="dark:bg-gray-700 relative rounded-lg bg-slate-50 shadow">
                    <!-- Modal header -->
                    <div class="dark:border-gray-600 flex items-center justify-between rounded-t border-b p-4 md:p-5">
                        <h3 class="dark:text-white text-xl font-semibold text-gray-900">
                            Static modal
                        </h3>
                        <button type="button" wire:click="$toggle('isOpen')"
                            class="dark:hover:bg-gray-600 dark:hover:text-white ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900"
                            data-modal-hide="static-modal">
                            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="space-y-4 p-4 md:p-5">
                        <p class="dark:text-gray-400 text-base leading-relaxed text-gray-500">
                            With less than a month to go before the European Union enacts new consumer privacy laws for
                            its citizens, companies around the world are updating their terms of service agreements to
                            comply.
                        </p>
                        <p class="dark:text-gray-400 text-base leading-relaxed text-gray-500">
                            The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May
                            25 and is meant to ensure a common set of data rights in the European Union. It requires
                            organizations to notify users as soon as possible of high-risk data breaches that could
                            personally affect them.
                        </p>
                    </div>
                    <!-- Modal footer -->
                    <div class="dark:border-gray-600 flex items-center rounded-b border-t border-gray-200 p-4 md:p-5">
                        <button data-modal-hide="static-modal" type="button"
                            class="dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">I
                            accept</button>
                        <button data-modal-hide="static-modal" type="button"
                            class="dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 ms-3 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100">Decline</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
