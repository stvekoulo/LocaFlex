@extends('layouts.backend')
@section('content')
<style>
    .button {
        position: relative;
        width: 150px;
        height: 40px;
        cursor: pointer;
        display: flex;
        align-items: center;
        border: 1px solid #34974d;
        background-color: #3aa856;
    }

    .button,
    .button__icon,
    .button__text {
        transition: all 0.3s;
    }

    .button .button__text {
        transform: translateX(30px);
        color: #fff;
        font-weight: 600;
    }

    .button .button__icon {
        position: absolute;
        transform: translateX(109px);
        height: 100%;
        width: 39px;
        background-color: #34974d;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .button .svg {
        width: 30px;
        stroke: #fff;
    }

    .button:hover {
        background: #34974d;
    }

    .button:hover .button__text {
        color: transparent;
    }

    .button:hover .button__icon {
        width: 148px;
        transform: translateX(0);
    }

    .button:active .button__icon {
        background-color: #2e8644;
    }

    .button:active {
        border: 1px solid #2e8644;
    }
</style>
<div class="content">
    <div class="block block-rounded bg-gd-pulse">
        <div class="block-content block-content-full">
            <div class="py-3 text-center">
                <h1 class="h2 fw-bold text-white mb-2">
                    Gestion des services
                </h1>
                <h2 class="h5 fw-medium text-white-75">
                    Gerer vos services a offrir
                </h2>
            </div>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="block block-rounded">
        <div class="block-header block-header-default d-flex justify-content-end">
                <a href="{{ route('service.create') }}" class="btn btn-sm btn-primary ms-auto" data-bs-toggle="tooltip"
                    title="Ajouter un service">
                    Ajouter un service
                </a>
        </div>
        <div class="block-content block-content-full overflow-x-auto">
            <!-- DataTables functionality is initialized with .js-dataTable-responsive class in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                <thead>
                    <tr>
                        <th class="text-center"></th>
                        <th class="d-none d-sm-table-cell">Titre</th>
                        <th class="d-none d-sm-table-cell">Categorie</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Prix</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 15%;">Disponibilité </th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 15%;">Publié</th>
                        <th class="d-none d-sm-table-cell text-center" style="width: 15%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $index => $service)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="fw-semibold">{{ $service->titre}}</td>
                            <td class="d-none d-sm-table-cell">{{ $service->categorie }}</td>
                            <td class="d-none d-sm-table-cell">{{ $service->prix }} FCFA</td>
                            <td class="d-none d-sm-table-cell">
                                <span class="badge bg-info">{{ $service->disponibilite }}</span>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                @if ($service->publie == false)
                                    <form action="{{route('publication.true')}}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                                        <button type="submit" class="button">
                                            <span class="button__text"> Oui ?</span>
                                            <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke-linejoin="round" stroke-linecap="round" stroke="currentColor"
                                                    height="24" fill="none" class="svg">
                                                    <line y2="19" y1="5" x2="12" x1="12">
                                                    </line>
                                                    <line y2="12" y1="12" x2="19" x1="5">
                                                    </line>
                                                </svg></span>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{route('publication.false')}}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                                        <button type="submit" class="button" style="border: 1px solid #973434;
                                            background-color: #a83a3a;">
                                            <span class="button__text"> Non ?</span>
                                            <span class="button__icon" style="background-color: #973434;"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke-linejoin="round" stroke-linecap="round" stroke="currentColor"
                                                    height="24" fill="none" class="svg">
                                                    <line y2="19" y1="5" x2="12" x1="12">
                                                    </line>
                                                    <line y2="12" y1="12" x2="19" x1="5">
                                                    </line>
                                                </svg></span>
                                        </button>
                                    </form>
                                @endif
                            </td>
                            <td class="d-none d-sm-table-cell text-center">
                                <a href="{{ route('service.edit', ['id' => $service->id]) }}"
                                    class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" title="Modifier">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#confirmDelete{{ $service->id }}" data-bs-toggle="tooltip"
                                    title="Supprimer">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Modal de confirmation de suppression -->
                        <div class="modal fade" id="confirmDelete{{ $service->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="exampleModalLabel">Confirmer la suppression</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Êtes-vous sûr de vouloir supprimer cette matière ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Annuler</button>
                                        <form action="{{ route('service.destroy', ['id' => $service->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
