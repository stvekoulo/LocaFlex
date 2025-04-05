<x-filament::layouts.base :livewire="$livewire">
    @vite(['resources/css/app.css', 'resources/css/filament.css', 'resources/js/app.js'])
    <div class="filament-app-layout flex h-full w-full overflow-x-clip">
        <div
            x-data="{}"
            x-cloak
            x-show="$store.sidebar.isOpen"
            x-transition.opacity.500ms
            x-on:click="$store.sidebar.close()"
            class="filament-sidebar-close-overlay fixed inset-0 z-20 w-full h-full bg-gray-900/50 lg:hidden"
        ></div>

        <x-filament::layouts.app.sidebar />

        <div
            @if (config('filament.layout.sidebar.is_collapsible_on_desktop'))
                x-data="{}"
                x-bind:class="{
                    'lg:pl-[var(--collapsed-sidebar-width)] rtl:lg:pr-[var(--collapsed-sidebar-width)] rtl:lg:pl-0': $store.sidebar.isCollapsed,
                    'lg:pl-[var(--sidebar-width)] rtl:lg:pr-[var(--sidebar-width)] rtl:lg:pl-0': ! $store.sidebar.isCollapsed,
                }"
                x-bind:style="'display: flex'"
            @else
                class="pl-[var(--sidebar-width)] rtl:pr-[var(--sidebar-width)] rtl:pl-0"
            @endif
            class="filament-main flex-1 w-full flex-col space-y-6 rtl:lg:pl-0 h-full max-h-screen overflow-x-hidden"
        >
            <header class="filament-main-topbar h-[4rem] shrink-0 w-full border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-2 sm:px-4 md:px-6 lg:px-8">
                <div class="flex items-center h-full">
                    <button
                        x-data="{}"
                        x-on:click="$store.sidebar.open()"
                        class="filament-sidebar-open-button shrink-0 flex items-center justify-center w-10 h-10 text-primary-500 rounded-full hover:bg-gray-500/5 focus:bg-primary-500/10 focus:outline-none lg:hidden"
                    >
                        <x-heroicon-o-bars-3 class="w-6 h-6" />
                    </button>

                    <div class="flex items-center justify-between flex-1">
                        <x-filament::layouts.app.topbar.breadcrumbs />

                        @livewire('filament.core.global-search')

                        <x-filament::layouts.app.topbar.user-menu />
                    </div>
                </div>
            </header>

            <div class="filament-main-content flex-1 w-full px-4 mx-auto md:px-6 lg:px-8 max-w-screen-2xl">
                {{ \Filament\Facades\Filament::renderHook('content.start') }}

                {{ $slot }}

                {{ \Filament\Facades\Filament::renderHook('content.end') }}
            </div>

            <div class="filament-main-footer py-4 shrink-0 w-full px-4 mx-auto md:px-6 lg:px-8 max-w-screen-2xl">
                <div class="flex items-center justify-center md:justify-between text-xs text-gray-500 dark:text-gray-400">
                    <div>
                        <p>&copy; {{ date('Y') }} LocaFlex - Tous droits réservés.</p>
                    </div>
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="#" class="text-amber-600 hover:text-amber-700 dark:text-amber-500 dark:hover:text-amber-400">Centre d'aide</a>
                        <a href="#" class="text-amber-600 hover:text-amber-700 dark:text-amber-500 dark:hover:text-amber-400">Conditions d'utilisation</a>
                        <a href="#" class="text-amber-600 hover:text-amber-700 dark:text-amber-500 dark:hover:text-amber-400">Politique de confidentialité</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament::layouts.base>