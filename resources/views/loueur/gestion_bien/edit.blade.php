@extends('layouts.backend')
@section('content')
<div class="container">
    <div class="content">
        <!-- Heading -->
        <div class="block block-rounded bg-gd-pulse">
            <div class="block-content block-content-full">
                <div class="py-3 text-center">
                    <h1 class="h2 fw-bold text-white mb-2">
                        Gestion des Biens
                    </h1>
                    <h2 class="h5 fw-medium text-white-75">
                        Modifier un bien à louer
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
                <form action="{{ route('bien.update', $biens->id) }}" method="POST" enctype="multipart/form-data">
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
                                <input type="text" class="form-control" value="{{ $biens->titre }}" id="titre" name="titre">
                                <label class="form-label" for="titre">Titre</label>
                            </div>
                            <div class="form-floating mb-4">
                                <select class="form-select" id="categorie"
                                    name="categorie" aria-label="Floating label select example">
                                    <option selected>Sélectionnez une catégorie</option>
                                    <option value="electromenager"@if ($biens->categorie == 'electromenager') selected @endif>Electroménager</option>
                                    <option value="transport"@if ($biens->categorie == 'transport') selected @endif>Transport</option>
                                    <option value="meubles"@if ($biens->categorie == 'meubles') selected @endif>Meubles</option>
                                    <option value="vetements"@if ($biens->categorie == 'vetements') selected @endif>Vêtements</option>
                                    <option value="electronique"@if ($biens->categorie == 'electronique') selected @endif>Électronique</option>
                                    <option value="jouets"@if ($biens->categorie == 'jouets') selected @endif>Jouets</option>
                                    <option value="sport"@if ($biens->categorie == 'sport') selected @endif>Sport</option>
                                    <option value="outils"@if ($biens->categorie == 'outils') selected @endif>Outils</option>
                                    <option value="accessoires"@if ($biens->categorie == 'accessoires') selected @endif>Accessoires</option>
                                    <option value="livres"@if ($biens->categorie == 'livres') selected @endif>Livres</option>
                                    <option value="musique"@if ($biens->categorie == 'musique') selected @endif>Musique</option>
                                    <option value="jardinage"@if ($biens->categorie == 'jardinage') selected @endif>Jardinage</option>
                                    <option value="bricolage"@if ($biens->categorie == 'bricolage') selected @endif>Bricolage</option>
                                    <option value="artisanat"@if ($biens->categorie == 'artisanat') selected @endif>Artisanat</option>
                                    <option value="decoration"@if ($biens->categorie == 'decoration') selected @endif>Décoration</option>
                                    <option value="cuisine"@if ($biens->categorie == 'cuisine') selected @endif>Cuisine</option>
                                    <option value="voyage"@if ($biens->categorie == 'voyage') selected @endif>Voyage</option>
                                    <option value="animaux"@if ($biens->categorie == 'animaux') selected @endif>Animaux</option>
                                    <option value="beaute"@if ($biens->categorie == 'beaute') selected @endif>Beauté</option>
                                </select>
                                <label class="form-label" for="categorie">Catégorie</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="number" class="form-control" value="{{ $biens->prix }}" id="prix" name="prix">
                                <label class="form-label" for="prix">Prix</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" value="{{ $biens->emplacement }}" id="emplacement" name="emplacement">
                                <label class="form-label" for="emplacement">Emplacement</label>
                            </div>
                            <div class="form-floating mb-4">
                                <select class="form-select" id="tags" name="tags"
                                    aria-label="Floating label select example">
                                    <option selected value="neuf"@if ($biens->tags == 'neuf') selected @endif>Neuf</option>
                                    <option value="occasion"@if ($biens->tags == 'occasion') selected @endif>Occasion</option>
                                    <option value="assez_bon_etat"@if ($biens->tags == 'assez_bon_etat') selected @endif>Assez bon état</option>
                                    <option value="bon_etat"@if ($biens->tags == 'bon_etat') selected @endif>Bon état</option>
                                </select>
                                <label class="form-label" for="tags">Tags</label>
                            </div>
                            <div class="form-floating mb-4">
                                <textarea class="form-control" id="description" name="description" style="height: 200px">{{ $biens->description }}</textarea>
                                <label class="form-label" for="description">Description</label>
                            </div>
                            <div class="form-floating mb-4">
                                <select class="form-select" id="disponibilite" name="disponibilite"
                                    aria-label="Floating label select example">
                                    <option selected value="Disponible"@if ($biens->disponibilite == 'Disponible') selected @endif>Disponible</option>
                                    <option value="Occupé"@if ($biens->disponibilite == 'Occupé') selected @endif>Occupé</option>
                                </select>
                                <label class="form-label" for="disponibilite">Disponibilité</label>
                            </div>
                            <div class="form-floating mb-4">
                                <textarea class="form-control" id="caracteristiques" name="caracteristiques" style="height: 200px">{{ $biens->caracteristiques }}</textarea>
                                <label class="form-label" for="caracteristiques">Caractéristiques</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 text-sm-end push">
                        <button type="submit" class="btn btn-lg btn-alt-primary fw-semibold">
                            Mettre a jours
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
