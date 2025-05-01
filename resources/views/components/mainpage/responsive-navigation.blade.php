<div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
    {{-- <div class="space-y-1 pb-3 pt-2">
                                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                                    {{ __('Документация') }}
                                </x-responsive-nav-link>
                                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                                    {{ __('Тарифы') }}
                                </x-responsive-nav-link>
                                <x-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                                    {{ __('Регистрация') }}
                                </x-responsive-nav-link> --}}
    @if (Route::has('login'))
        <nav class="-mx-3 flex flex-1 justify-end">

            @auth
                <a href="/docs/intro/"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Документация
                </a>
                <a href="{{ url('/dashboard') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Личный кабинет
                </a>
            @else
                <a href="/docs/intro/"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Документация
                </a>
                <a href="{{ route('login') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Войти
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Регистрация
                    </a>
                @endif
            @endauth
        </nav>
    @endif
</div>

<!-- Responsive Settings Options -->
{{-- <div class="border-t border-gray-200 pb-1 pt-4 dark:border-gray-600">
                            <div class="flex items-center px-4">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <div class="me-3 shrink-0">
                                        <img class="size-10 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}"
                                            alt="{{ Auth::user()->name }}" />
                                    </div>
                                @endif

                                <div>
                                    <div class="text-base font-medium text-gray-800 dark:text-gray-200">
                                        {{ Auth::user()->name }}</div>
                                    <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                                </div>
                            </div>

                            <div class="mt-3 space-y-1">
                                <!-- Account Management -->
                                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                    {{ __('Profile') }}
                                </x-responsive-nav-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                                        {{ __('API Tokens') }}
                                    </x-responsive-nav-link>
                                @endif

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-responsive-nav-link href="{{ route('logout') }}"
                                        @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-responsive-nav-link>
                                </form>

                                <!-- Team Management -->
                                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                    <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-responsive-nav-link
                                        href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                                        :active="request()->routeIs('teams.show')">
                                        {{ __('Team Settings') }}
                                    </x-responsive-nav-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                            {{ __('Create New Team') }}
                                        </x-responsive-nav-link>
                                    @endcan

                                    <!-- Team Switcher -->
                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>

                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                        </div> --}}
