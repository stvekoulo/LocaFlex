@extends('layouts.backend')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Succès!',
                text: '{{ session('success') }}',
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Erreur!',
                text: '{{ session('error') }}',
            });
        @endif
    </script>
    <div class="content">
        <div class="block block-rounded bg-gd-leaf">
            <div class="block-content block-content-full">
                <div class="py-3 text-center">
                    <h1 class="h2 fw-bold text-white mb-2">
                        Mes demandes
                    </h1>
                    <h2 class="h5 fw-medium text-white-75">
                        Gérer vos demandes de réservation et de services
                    </h2>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-6">
                    <!-- Message List -->
                    <div class="block block-rounded">
                        <div class="block-content">
                            <!-- Messages -->
                            <!-- Checkable Table (.js-table-checkable class is initialized in Helpers.cbTableToolsCheckable()) -->
                            <table class="js-table-checkable table table-hover table-vcenter">
                                <thead>
                                    <tr>
                                        <th colspan="3">
                                            <!-- Messages Options -->
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <button type="button" class="btn btn-alt-secondary">
                                                        <i class="fa fa-fw fa-archive"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-alt-secondary">
                                                        <i class="fa fa-fw fa-star"></i>
                                                    </button>
                                                </div>
                                                <div>
                                                    <button type="button" class="btn btn-alt-secondary">
                                                        <i class="fa fa-fw fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- END Messages Options -->
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($demandes as $demande)
                                        <tr>
                                            <td class="d-none d-sm-table-cell fw-semibold">{{ $demande->user->name }}</td>
                                            <td>
                                                @if ($demande->etat == 'En attente')
                                                    <a class="fw-semibold" data-bs-toggle="modal"
                                                        data-bs-target="#modal-demande-{{ $demande->id }}" href="#">
                                                        Une nouvelle demande de reservation <span
                                                            class="text-danger blink">&#9679;</span>
                                                    </a>
                                                @elseif($demande->etat == 'Validé' || $demande->etat == 'Refusé')
                                                    <a class="fw-semibold" data-bs-toggle="modal"
                                                        data-bs-target="#modal-demande-{{ $demande->id }}" href="#">
                                                        Une nouvelle demande de reservation <span
                                                            class="text-success blink">&#9679;</span>
                                                    </a>
                                                @endif
                                                <div class="text-muted mt-1">Cliquez pour en savoir plus </div>
                                            </td>
                                            <td class="d-none d-xl-table-cell fw-semibold fs-sm text-muted">
                                                {{ $demande->created_at->format('D') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- END Messages -->
                        </div>
                    </div>
                    <!-- END Message List -->
                </div>
                <div class="col-md-6">
                    <!-- Message List -->
                    <div class="block block-rounded">
                        <div class="block-content">
                            <!-- Messages -->
                            <!-- Checkable Table (.js-table-checkable class is initialized in Helpers.cbTableToolsCheckable()) -->
                            <table class="js-table-checkable table table-hover table-vcenter">
                                <thead>
                                    <tr>
                                        <th colspan="3">
                                            <!-- Messages Options -->
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <button type="button" class="btn btn-alt-secondary">
                                                        <i class="fa fa-fw fa-archive"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-alt-secondary">
                                                        <i class="fa fa-fw fa-star"></i>
                                                    </button>
                                                </div>
                                                <div>
                                                    <button type="button" class="btn btn-alt-secondary">
                                                        <i class="fa fa-fw fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- END Messages Options -->
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($demandeservices as $demandeservice)
                                        <tr>
                                            <td class="d-none d-sm-table-cell fw-semibold">{{ $demandeservice->user->name }}
                                            </td>
                                            <td>
                                                @if ($demandeservice->etat == 'En attente')
                                                    <a class="fw-semibold" data-bs-toggle="modal"
                                                        data-bs-target="#modal-demandeservice-{{ $demandeservice->id }}"
                                                        href="#">
                                                        Une nouvelle demande pour vos service <span
                                                            class="text-danger blink">&#9679;</span>
                                                    </a>
                                                @elseif($demandeservice->etat == 'Validé' || $demandeservice->etat == 'Refusé')
                                                    <a class="fw-semibold" data-bs-toggle="modal"
                                                        data-bs-target="#modal-demandeservice-{{ $demandeservice->id }}"
                                                        href="#">
                                                        Une nouvelle demande pour vos service <span
                                                            class="text-success blink">&#9679;</span>
                                                    </a>
                                                @endif
                                                <div class="text-muted mt-1">Cliquez pour en savoir plus </div>
                                            </td>
                                            <td class="d-none d-xl-table-cell fw-semibold fs-sm text-muted">
                                                {{ $demandeservice->created_at->format('D') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- END Messages -->
                        </div>
                    </div>
                    <!-- END Message List -->
                </div>
            </div>

            @foreach ($demandes as $demande)
                <div class="modal fade" id="modal-demande-{{ $demande->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="modal-demande-{{ $demande->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-popout" role="document">
                        <div class="modal-content">
                            <div class="block block-rounded shadow-none mb-0">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Demande de reservation</h3>
                                    <div class="block-options">
                                    </div>
                                </div>
                                <div
                                    class="block-content block-content-full block-content-sm bg-body fs-sm d-flex justify-content-between align-items-center">
                                    <a href="javascript:void(0)">Demande de la part d'un utilisateur nommé
                                        {{ $demande->user->name }}</a>
                                    <span class="text-muted">{{ $demande->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="block-content">
                                    <h5>MOTIF DE LA DEMANDE</h5>
                                    <p>{{ $demande->motif }}</p>
                                    <h5>SUR UNE DURÉE DE </h5>
                                    <p>{{ $demande->duree }} Jours</p>
                                </div>
                                @if ($demande->etat == 'En attente')
                                    <div class="block-content p-3 bg-body">
                                        <form action="{{ route('accepterdemande.bien', $demande->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Accepter la demande</button>
                                        </form>
                                    </div>
                                    <div class="block-content p-3 bg-body">
                                        <form action="{{ route('refuserdemande.bien', $demande->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Refuser la demande</button>
                                        </form>
                                    </div>
                                @elseif($demande->etat == 'Validé')
                                    <div class="block-content p-3 bg-body">
                                        La demande est Validée
                                    </div>
                                @else
                                    <div class="block-content p-3 bg-body">
                                        La demande est Refusée
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach ($demandeservices as $demandeservice)
                <div class="modal fade" id="modal-demandeservice-{{ $demandeservice->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="modal-demandeservice-{{ $demandeservice->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-popout" role="document">
                        <div class="modal-content">
                            <div class="block block-rounded shadow-none mb-0">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Demande pour un de vos service</h3>
                                    <div class="block-options">
                                    </div>
                                </div>
                                <div
                                    class="block-content block-content-full block-content-sm bg-body fs-sm d-flex justify-content-between align-items-center">
                                    <a href="javascript:void(0)">L'utilisateur {{ $demandeservice->user->name }} a faire
                                        une demande pour un de vos service</a>
                                    <span class="text-muted">{{ $demandeservice->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="block-content">
                                    <h5>MOTIF DE LA DEMANDE</h5>
                                    <p>{{ $demandeservice->motif }}</p>
                                    <h5>SUR UNE DURÉE DE </h5>
                                    <p>{{ $demandeservice->duree }} Jours</p>
                                </div>
                                @if ($demandeservice->etat == 'En attente')
                                    <div class="block-content p-3 bg-body">
                                        <form action="{{ route('accepterdemande.service', $demandeservice->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Accepter la demande</button>
                                        </form>
                                    </div>
                                    <div class="block-content p-3 bg-body">
                                        <form action="{{ route('refuserdemande.service', $demandeservice->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Refuser la demande</button>
                                        </form>
                                    </div>
                                @elseif($demandeservice->etat == 'Validé')
                                    <div class="block-content p-3 bg-body">
                                        Le service est validé
                                    </div>
                                @else
                                    <div class="block-content p-3 bg-body">
                                        Le service est refusé
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
