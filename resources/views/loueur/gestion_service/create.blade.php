@php
    $user = Auth::user();
@endphp
@php
    if (Auth::user()->role === 'Client') {
        abort(403);
    }
@endphp
@extends('layouts.backend')
@section('content')
    <div class="container">
        <div class="content">
            <!-- Heading -->
            <div class="block block-rounded bg-gd-leaf">
                <div class="block-content block-content-full">
                    <div class="py-3 text-center">
                        <h1 class="h2 fw-bold text-white mb-2">
                            Gestion des Services
                        </h1>
                        <h2 class="h5 fw-medium text-white-75">
                            Ajoutez un service à offrir
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
                <div class="block-header block-header-default">
                    <h3 class="block-title"></h3>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="block-content">
                    <form action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <p class="text-muted">
                                    En soumettant ce bien, vous acceptez nos conditions générales. Vous confirmez également
                                    que vous êtes le propriétaire légitime de ce bien ou que vous avez le droit de le louer.
                                </p>
                            </div>
                            <div class="col-lg-8 col-xl-5">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" id="titre" name="titre">
                                    <label class="form-label" for="titre">Titre</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <select class="form-select" id="categorie" name="categorie" aria-label="Floating label select example">
                                        <option selected>Sélectionnez une catégorie</option>
                                        <option value="entretien_reparation">Services d'entretien et de réparation</option>
                                        <option value="transports_terrestres">Services de transports terrestres</option>
                                        <option value="transports_aeriens">Services de transports aériens</option>
                                        <option value="telecommunications">Services de télécommunications</option>
                                        <option value="services_financiers">Services financiers</option>
                                        <option value="services_informatiques">Services informatiques et services connexes</option>
                                        <option value="services_comptables">Services comptables, d'audit et de tenue de livres</option>
                                        <option value="etudes_marche_sondages">Services d'études de marché et de sondages</option>
                                        <option value="conseil_gestion">Services de conseil en gestion et services connexes</option>
                                        <option value="education_formation">Services d'éducation et de formation professionnelle</option>
                                    </select>
                                    <label class="form-label" for="categorie">Catégorie</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="number" class="form-control" id="prix" name="prix">
                                    <label class="form-label" for="prix">Prix</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <select class="form-select" id="tags" name="tags"
                                        aria-label="Floating label select example">
                                        <option selected value="service_domicile">Service à domicile</option>
                                        <option value="service_sur_place">Service sur place</option>
                                    </select>
                                    <label class="form-label" for="tags">Tags</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <textarea class="form-control" id="description" name="description" style="height: 200px"></textarea>
                                    <label class="form-label" for="description">Description</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <select class="form-select" id="disponibilite" name="disponibilite"
                                        aria-label="Floating label select example">
                                        <option selected value="Disponible">Disponible</option>
                                        <option value="Occupé">Occupé</option>
                                    </select>
                                    <label class="form-label" for="disponibilite">Disponibilité</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 text-sm-end push">
                            <div class="mb-4">
                                <button type="submit" class="btn btn-alt-primary">Soumettre</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
