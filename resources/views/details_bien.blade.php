@php
    $user = Auth::user();
@endphp
@php
    if (Auth::check() && Auth::user()->role === 'Loueur') {
        abort(403);
    }
@endphp
@extends('layouts.opus')
@section('content')
    <main class="page_content">

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

        <!-- Page Section - Start
                    ================================================== -->
        <section class="page_banner">
            <div class="container">
                <div class="content_wrapper">
                    <div class="row align-items-center">
                        <div class="col col-lg-7">
                            <ul class="breadcrumb_nav unordered_list">
                                <li><a href="{{ route('home') }}">Accueil</a></li>
                                <li><a href="#">Bien</a></li>
                                <li>Détail du produit</li>
                            </ul>
                            <h1 class="page_title">
                                {{ $bien->titre }}
                            </h1>
                            <br>
                            <li>
                                <a href="#" class="btn btn_dark" data-bs-toggle="modal"
                                    data-bs-target="#demandeModal">
                                    <span>
                                        <small>Faire une demande de réservation</small>
                                        <small>Envoyer la demande</small>
                                    </span>
                                </a>
                            </li>

                            <!-- Modal -->
                            <div class="modal fade" id="demandeModal" tabindex="-1" aria-labelledby="demandeModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="demandeModalLabel">Faire une demande de réservation
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('bien.demande') }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="duree">Durée de la réservation (en jours)</label>
                                                    <input type="number" class="form-control" id="duree" name="duree"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="motif">Motif de la réservation</label>
                                                    <textarea class="form-control" id="motif" name="motif" rows="3" required></textarea>
                                                </div>
                                                <input type="hidden" name="bien_id" value="{{ $bien->id }}">
                                                <button type="submit" class="btn btn_dark">
                                                    <a href="#" class="btn btn_dark">
                                                        <span>
                                                            <small>Envoyer la demande</small>
                                                            <small>soumettre</small>
                                                        </span>
                                                    </a>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col col-lg-5">
                            <div class="image_widget page_banner_image">
                                <h1 class="page_title">
                                    CFA {{ $bien->prix }}
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Page Section - End
                ================================================== -->


        <!-- Mentor Details Section - Start
                    ================================================== -->
        <section class="details_section mentor_details_section section_space_lg">
            <div class="container">
                <div class="section_space_md pt-0">
                    <div class="row align-items-center">
                        <div class="col col-lg-6">
                            @foreach ($biens->photos as $photo)
                                <div class="details_image image_widget">
                                    <img src="{{ Storage::url($photo->chemin_fichier) }}" alt="{{ $photo->description }}">
                                </div>
                            @endforeach
                        </div>
                        <div class="col col-lg-6">
                            <div class="details_content ps-lg-5">
                                <h2 class="details_item_title">{{ $bien->titre }}</h2>
                                <h4 class="mentor_designation">Publier par: </h4>
                                <h3 class="mentor_name">{{ $bien->user->name }}</h3>
                                <ul class="meta_info_list unordered_list">
                                    <li>
                                        <i class="fas fa-clock"></i>
                                        <span>{{ $bien->disponibilite }}</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-star"></i>
                                        <span>{{ $bien->tags }}</span>
                                    </li>
                                </ul>
                                <p>
                                    {{ $bien->description }}
                                </p>
                                <div class="row">
                                    <div class="col col-lg-4">
                                        <div class="counter_item pe-0">
                                            <p class="mb-0">
                                                {{ $bien->caracteristiques }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($bien->photos as $photo)
                        <div class="col col-lg-4">
                            <div class="mentor_item">
                                <div class="mentor_image">
                                    <a href="#">
                                        <img src="{{ Storage::url($photo->chemin_fichier) }}"
                                            alt="{{ $photo->description }}">
                                    </a>
                                </div>
                                <div class="mentor_content">
                                    <ul class="meta_info_list unordered_list_center mb-0">
                                        <li>
                                            <i class="fas fa-clock"></i>
                                            <span>{{ $bien->disponibilite }}</span>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                            <span>{{ $bien->tags }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Mentor Details Section - End
                ================================================== -->
    </main>
@endsection
