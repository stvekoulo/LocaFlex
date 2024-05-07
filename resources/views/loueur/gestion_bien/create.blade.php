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
                            Gestion des Biens
                        </h1>
                        <h2 class="h5 fw-medium text-white-75">
                            Ajoutez un bien à louer
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
                    <form action="{{ route('bien.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <select class="form-select" id="categorie"
                                        name="categorie" aria-label="Floating label select example">
                                        <option selected>Sélectionnez une catégorie</option>
                                        <option value="electromenager">Electroménager</option>
                                        <option value="transport">Transport</option>
                                        <option value="meubles">Meubles</option>
                                        <option value="vetements">Vêtements</option>
                                        <option value="electronique">Électronique</option>
                                        <option value="jouets">Jouets</option>
                                        <option value="sport">Sport</option>
                                        <option value="outils">Outils</option>
                                        <option value="accessoires">Accessoires</option>
                                        <option value="livres">Livres</option>
                                        <option value="musique">Musique</option>
                                        <option value="jardinage">Jardinage</option>
                                        <option value="bricolage">Bricolage</option>
                                        <option value="artisanat">Artisanat</option>
                                        <option value="decoration">Décoration</option>
                                        <option value="cuisine">Cuisine</option>
                                        <option value="voyage">Voyage</option>
                                        <option value="animaux">Animaux</option>
                                        <option value="beaute">Beauté</option>
                                    </select>
                                    <label class="form-label" for="categorie">Catégorie</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="number" class="form-control" id="prix" name="prix">
                                    <label class="form-label" for="prix">Prix</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" id="emplacement" name="emplacement">
                                    <label class="form-label" for="emplacement">Emplacement</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <select class="form-select" id="tags" name="tags"
                                        aria-label="Floating label select example">
                                        <option selected value="neuf">Neuf</option>
                                        <option value="occasion">Occasion</option>
                                        <option value="assez_bon_etat">Assez bon état</option>
                                        <option value="bon_etat">Bon état</option>
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
                                <div class="form-floating mb-4">
                                    <textarea class="form-control" id="caracteristiques" name="caracteristiques" style="height: 200px"></textarea>
                                    <label class="form-label" for="caracteristiques">Caracteristiques</label>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="photo">Selectionnez des photos</label>
                                    <input class="form-control" type="file" id="photo" name="photo[]" multiple>
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
