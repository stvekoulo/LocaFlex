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
                                <li><a href="{{ route('home') }}">Acceuil</a></li>
                                <li><a href="#">Service</a></li>
                                <li>Deatail du service</li>
                            </ul>
                            <h1 class="page_title">
                                {{ $service->titre }}
                            </h1>
                            <ul class="info_list unordered_list_block pb-0">
                                <li>
                                    <i class="fas fa-check"></i>
                                    <span>
                                        {{ $service->description }}
                                    </span>
                                </li>
                                <li>
                                    <span>

                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Page Section - End
                ================================================== -->

        <!-- Course Details Section - Start
                ================================================== -->
        <section class="details_section course_details_section">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-8">
                        <div class="section_space_lg pb-lg-0">
                            <div class="pe-lg-5">
                                <div class="course_info_card d-lg-none">
                                    <div class="details_image">
                                    </div>
                                    <ul class="meta_info_list unordered_list">
                                        <li>
                                            <i class="fas fa-star"></i>
                                            <span>Prix du service</span>
                                        </li>
                                    </ul>
                                    <div class="item_price">
                                        <span class="sale_price">A partir de CFA {{ $service->prix }}</span>
                                    </div>

                                    <a href="#" class="btn btn_dark" data-bs-toggle="modal"
                                        data-bs-target="#demandeModal">
                                        <span>
                                            <small>Obtenir ce service</small>
                                            <small>Faire une demande</small>
                                        </span>
                                    </a>
                                    <ul class="course_info_list unordered_list_block">
                                        <li>
                                            <span><i class="fas fa-user"></i>Service proposé par</span>
                                            <strong>{{ $service->user->name }}</strong>
                                        </li>
                                        <li>
                                            <span><i class="fas fa-chart-bar"></i>Catégorie du service</span>
                                            <strong>{{ $service->categorie }}</strong>
                                        </li>
                                        <li>
                                            <span><i class="fas fa-clock"></i>Disponibilité</span>
                                            <strong>Service {{ $service->disponibilite }}</strong>
                                        </li>
                                        <li>
                                            <span><i class="fas fa-users"></i>Informations importantes</span>
                                            @if ($service->tags == 'service_domicile')
                                                <strong>Service à domicile</strong>
                                            @elseif($service->tags == 'service_sur_place')
                                                <strong>Service sur place</strong>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col col-lg-4">
                        <aside class="sidebar">
                            <div class="course_info_card d-none d-lg-block">
                                <div class="details_image">
                                </div>
                                <ul class="meta_info_list unordered_list">
                                    <li>
                                        <i class="fas fa-star"></i>
                                        <span>Prix du service</span>
                                    </li>
                                </ul>
                                <div class="item_price">
                                    <span class="sale_price">A partir de CFA {{ $service->prix }}</span>
                                </div>

                                <a href="#" class="btn btn_dark" data-bs-toggle="modal"
                                    data-bs-target="#demandeModal">
                                    <span>
                                        <small>Obtenir ce service</small>
                                        <small>Faire une demande</small>
                                    </span>
                                </a>
                                <ul class="course_info_list unordered_list_block">
                                    <li>
                                        <span><i class="fas fa-user"></i>Service proposé par</span>
                                        <strong>{{ $service->user->name }}</strong>
                                    </li>
                                    <li>
                                        <span><i class="fas fa-chart-bar"></i>Catégorie du service</span>
                                        <strong>{{ $service->categorie }}</strong>
                                    </li>
                                    <li>
                                        <span><i class="fas fa-clock"></i>Disponibilité</span>
                                        <strong>Service {{ $service->disponibilite }}</strong>
                                    </li>
                                    <li>
                                        <span><i class="fas fa-users"></i>Informations importantes</span>
                                        @if ($service->tags == 'service_domicile')
                                            <strong>Service à domicile</strong>
                                        @elseif($service->tags == 'service_sur_place')
                                            <strong>Service sur place</strong>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
        <!-- Course Details Section - End
                ================================================== -->

        <!-- Modal -->
        <div class="modal fade" id="demandeModal" tabindex="-1" aria-labelledby="demandeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="demandeModalLabel">Faire une demande
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('service.demande') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="duree">Durée du service (en jours)</label>
                                <input type="number" class="form-control" id="duree" name="duree" required>
                            </div>
                            <div class="mb-3">
                                <label for="motif">Raison de la demande</label>
                                <textarea class="form-control" id="motif" name="motif" rows="3" required></textarea>
                            </div>
                            <input type="hidden" name="service_id" value="{{ $service->id }}">
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
    </main>
@endsection
