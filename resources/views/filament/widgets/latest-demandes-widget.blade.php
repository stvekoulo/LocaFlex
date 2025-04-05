<x-filament::widget>
    <x-filament::section>
        <x-slot name="heading">
            Dernières demandes en attente
        </x-slot>

        @php
            $demandes = $this->getDemandes();
        @endphp

        @if($demandes->isEmpty())
            <div class="text-center py-4 text-gray-500">
                Aucune demande en attente
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Type</th>
                            <th scope="col" class="px-6 py-3">Demandeur</th>
                            <th scope="col" class="px-6 py-3">Date</th>
                            <th scope="col" class="px-6 py-3">Détails</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($demandes as $demande)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none rounded-full {{ $demande['type'] === 'bien' ? 'bg-amber-100 text-amber-700' : 'bg-green-100 text-green-700' }}">
                                        {{ $demande['type_label'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ $demande['user_name'] }}</td>
                                <td class="px-6 py-4">{{ $demande['created_at'] }}</td>
                                <td class="px-6 py-4">{{ $demande['item_title'] }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ $demande['url'] }}" target="_blank" class="font-medium text-amber-600 hover:underline">
                                        Voir
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </x-filament::section>
</x-filament::widget>