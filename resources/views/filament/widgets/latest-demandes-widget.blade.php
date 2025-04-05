<x-filament::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <x-heroicon-o-bell-alert class="w-6 h-6 text-amber-500" />
                    <span>Dernières demandes en attente</span>
                </div>
                <a href="{{ route('filament.loueur.resources.demande-reservations.index') }}" class="text-sm font-medium text-primary-600 hover:text-primary-500">
                    Voir toutes les demandes
                </a>
            </div>
        </x-slot>

        @php
            $demandes = $this->getDemandes();
        @endphp

        @if($demandes->isEmpty())
            <div class="flex flex-col items-center justify-center py-6 text-gray-500">
                <x-heroicon-o-inbox class="w-8 h-8 mb-2 text-gray-400" />
                <p>Aucune demande en attente</p>
                <p class="text-sm mt-1">Vous serez notifié lorsque de nouvelles demandes arriveront</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($demandes as $demande)
                    <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-750 transition duration-150">
                        <div class="flex justify-between items-start">
                            <div class="flex items-start space-x-4">
                                <div class="p-2 rounded-full {{ $demande['type'] === 'bien' ? 'bg-amber-100 text-amber-700 dark:bg-amber-900 dark:text-amber-300' : 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900 dark:text-emerald-300' }}">
                                    @if($demande['type'] === 'bien')
                                        <x-heroicon-s-home class="w-6 h-6" />
                                    @else
                                        <x-heroicon-s-wrench-screwdriver class="w-6 h-6" />
                                    @endif
                                </div>
                                <div>
                                    <div class="flex items-center">
                                        <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $demande['item_title'] }}</h3>
                                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $demande['type'] === 'bien' ? 'bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-200' : 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200' }}">
                                            {{ $demande['type_label'] }}
                                        </span>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        <span class="font-medium">{{ $demande['user_name'] }}</span> - {{ $demande['duree'] }} jours
                                    </p>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-500 line-clamp-1">
                                        {{ $demande['motif'] }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex flex-col items-end">
                                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $demande['created_at'] }}</span>
                                <a href="{{ $demande['url'] }}" class="mt-2 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md {{ $demande['type'] === 'bien' ? 'text-amber-700 bg-amber-100 hover:bg-amber-200 dark:text-amber-200 dark:bg-amber-900 dark:hover:bg-amber-800' : 'text-emerald-700 bg-emerald-100 hover:bg-emerald-200 dark:text-emerald-200 dark:bg-emerald-900 dark:hover:bg-emerald-800' }} focus:outline-none focus:ring-2 focus:ring-offset-2 {{ $demande['type'] === 'bien' ? 'focus:ring-amber-500 dark:focus:ring-amber-600' : 'focus:ring-emerald-500 dark:focus:ring-emerald-600' }}">
                                    <x-heroicon-s-eye class="w-4 h-4 mr-1" />
                                    Détails
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4 text-center">
                <a href="{{ $demandes[0]['type'] === 'bien' ? route('filament.loueur.resources.demande-reservations.index') : route('filament.loueur.resources.demande-services.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 dark:bg-amber-700 dark:hover:bg-amber-800">
                    <x-heroicon-s-clipboard-document-list class="w-5 h-5 mr-2" />
                    Gérer toutes les demandes
                </a>
            </div>
        @endif
    </x-filament::section>
</x-filament::widget>