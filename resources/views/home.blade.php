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
        <section class="hero_banner style_1">
            <div class="container">
                <div class="content_wrap">
                    <div class="row">
                        <div class="col col-lg-7">
                            <h1 class="banner_small_title"></h1>
                            <h2 class="banner_big_title">Meilleure Plateforme <br> de location <br> Polyvalente</h2>
                            <p class="banner_description">
                                À chaque besoin, sa solution de location. Avec notre plateforme polyvalente, vous pouvez
                                trouver tout ce dont vous avez besoin, quand vous en avez besoin. Libérez-vous des
                                contraintes et louez en toute liberté.
                            </p>
                        </div>
                        <div class="col col-lg-5">
                            <div class="banner_image_1 decoration_wrap">
                                <div class="image_wrap">
                                    <img src="{{ asset('autres_images/1.jpg') }}"
                                        alt="Collab – Plateforme location polyvalentes">
                                </div>
                                <div class="satisfied_student">
                                    <h3 class="wrap_title">{{ $nombreUtilisateursAffichage }}+ Utilisateur</h3>
                                    <ul class="students_thumbnail unordered_list_center">
                                        <li>
                                            <span>
                                                <img src="{{ asset('autres_images/11.jpg') }}"
                                                    alt="Collab – Plateforme location polyvalentes">
                                            </span>
                                        </li>
                                        <li>
                                            <span>
                                                <img src="{{ asset('autres_images/12.jpg') }}"
                                                    alt="Collab – Plateforme location polyvalentes">
                                            </span>
                                        </li>
                                        <li>
                                            <span>
                                                <img src="{{ asset('autres_images/13.jpg') }}"
                                                    alt="Collab – Plateforme location polyvalentes">
                                            </span>
                                        </li>
                                        <li>
                                            <span>
                                                <img src="{{ asset('autres_images/12.jpg') }}"
                                                    alt="Collab – Plateforme location polyvalentes">
                                            </span>
                                        </li>
                                        <li>
                                            <span>
                                                <img src="{{ asset('autres_images/11.jpg') }}"
                                                    alt="Collab – Plateforme location polyvalentes">
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="deco_item shape_img_1" data-parallax='{"y" : -130, "smoothness": 6}'>
                                    <img src="{{ asset('Template/assets/images/shape/shape_img_1.png') }}"
                                        alt="Collab – Plateforme location polyvalentes">
                                </div>
                                <div class="deco_item shape_img_2" data-parallax='{"y" : 160, "smoothness": 6}'>
                                    <img src="{{ asset('Template/assets/images/shape/shape_img_2.png') }}"
                                        alt="Collab – Plateforme location polyvalentes">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="expect_from_course section_space_lg">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-6">
                        <div class="section_heading">
                            <h2 class="heading_text">
                                Collab C'est quoi ?
                            </h2>
                            <p class="heading_description mb-0">
                                Découvrez une approche révolutionnaire de la location. Avec Collab, louez ce dont vous avez
                                besoin, quand vous en avez besoin.
                            </p>
                            <p class="heading_description mb-0">
                                Notre plateforme vous offre la possibilité de créer un compte utilisateur loueur pour mettre
                                des équipements en location ou des services à disposition.
                            </p>
                            <p class="heading_description mb-0">
                                Collab offre aux
                                propriétaires d'objets la possibilité de générer des revenus supplémentaires en les louant
                                à d'autres utilisateurs
                            </p>
                        </div>

                        <div class="image_widget">
                            <img src="{{ asset('autres_images/2.jpg') }}" alt="Collab – Plateforme location polyvalentes">
                        </div>
                    </div>
                    <div class="col col-lg-6">
                        <div class="row">
                            <div class="col col-md-6">
                                <div class="service_item" data-magnetic>
                                    <div class="item_icon">
                                        <img src="{{ asset('Template/assets/images/service/icon_academic_cap.svg') }}"
                                            alt="Collab – Plateforme de location polyvalente">
                                    </div>
                                    <div class="item_content">
                                        <h3 class="item_title">Large choix</h3>
                                        <p class="mb-0">
                                            Découvrez une vaste sélection d'équipements et d'espaces pour répondre à tous
                                            vos besoins de location.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-6">
                                <div class="service_item" data-magnetic>
                                    <div class="item_icon">
                                        <img src="{{ asset('Template/assets/images/service/icon_physics.svg') }}"
                                            alt="Collab – Plateforme de location polyvalente">
                                    </div>
                                    <div class="item_content">
                                        <h3 class="item_title">Accès illimité</h3>
                                        <p class="mb-0">
                                            Profitez d'un accès sans limite à tous les services de location dont vous avez
                                            besoin.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-6">
                                <div class="service_item" data-magnetic>
                                    <div class="item_icon">
                                        <img src="{{ asset('Template/assets/images/service/icon_communication.svg') }}"
                                            alt="Collab – Plateforme de location polyvalente">
                                    </div>
                                    <div class="item_content">
                                        <h3 class="item_title">Facilité d'utilisation</h3>
                                        <p class="mb-0">
                                            Accédez facilement à tous nos services de location et gérez vos réservations en
                                            toute simplicité.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-6">
                                <div class="service_item" data-magnetic>
                                    <div class="item_icon">
                                        <img src="{{ asset('Template/assets/images/service/icon_diploma.svg') }}"
                                            alt="Collab – Plateforme de location polyvalente">
                                    </div>
                                    <div class="item_content">
                                        <h3 class="item_title">Satisfaction garantie</h3>
                                        <p class="mb-0">
                                            Nous nous engageons à vous fournir une expérience de location exceptionnelle.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section class="courses_section section_space_lg">
            <div class="container">
                <div class="section_heading">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col col-lg-6">
                            <h2 class="heading_text mb-0">
                                Explorez Notre Large Catalogue
                            </h2>
                        </div>
                        <div class="col col-lg-5">
                            <p class="heading_description mb-0 text-lg-end">
                                Parcourez et Trouvez ce Dont Vous Avez Besoin
                            </p>
                        </div>
                    </div>
                </div>

                <div class="tabs_wrapper">
                    <ul class="nav" role="tablist">
                        <li role="presentation">
                            <button class="active" data-bs-toggle="tab" data-bs-target="#teb_hr" type="button"
                                role="tab" aria-selected="true">
                                <i class="fas fa-users"></i>
                                <span>Équipements à Louer</span>
                            </button>
                        </li>
                        <li role="presentation">
                            <button data-bs-toggle="tab" data-bs-target="#teb_photography" type="button" role="tab"
                                aria-selected="false">
                                <i class="fas fa-camera"></i>
                                <span>Services Disponibles</span>
                            </button>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="teb_hr" role="tabpanel">
                            <div class="row">
                                @if ($neufDerniersBiens->isNotEmpty())
                                    @foreach ($neufDerniersBiens as $bien)
                                        <div class="col col-lg-4">
                                            <div class="course_card">
                                                <div class="item_image">
                                                    <a href="{{ route('detail.bien', ['id' => $bien->id]) }}"
                                                        data-cursor-text="View">
                                                        <img src="{{ Storage::url($bien->photos->first()->chemin_fichier) }}"
                                                            alt="{{ $bien->photos->first()->description }}">
                                                    </a>
                                                </div>
                                                <div class="item_content">
                                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                                        <ul class="item_category_list unordered_list">
                                                            <li><a href="#!">{{ $bien->categorie }}</a></li>
                                                        </ul>
                                                        <div class="item_price">
                                                            <span class="sale_price">CFA {{ $bien->prix }}</span>
                                                        </div>
                                                    </div>
                                                    <ul class="meta_info_list unordered_list">
                                                        <li>
                                                            <i class="fas fa-chart-bar"></i>
                                                            <span>Proposé par: {{ $bien->user->name }}</span>
                                                        </li>
                                                    </ul>
                                                    <h3 class="item_title">
                                                        <a href="{{ route('detail.bien', ['id' => $bien->id]) }}">
                                                            {{ $bien->titre }}
                                                        </a>
                                                    </h3>
                                                    <a class="btn_unfill"
                                                        href="{{ route('detail.bien', ['id' => $bien->id]) }}">
                                                        <span class="btn_text">Voir plus</span>
                                                        <span class="btn_icon">
                                                            <i class="fas fa-long-arrow-right"></i>
                                                            <i class="fas fa-long-arrow-right"></i>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <li>
                                        <a href="{{ route('bien.catalogue') }}" class="btn btn_dark">
                                            <span>
                                                <small>Parcourir le catalogue complet</small>
                                                <small>Afficher plus</small>
                                            </span>
                                        </a>
                                    </li>
                                @else
                                    <p>Aucun bien trouvé.</p>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="teb_photography" role="tabpanel">
                            <div class="row">
                                @if ($neufDerniersServices->isNotEmpty())
                                    @foreach ($neufDerniersServices as $service)
                                        <div class="col col-lg-4">
                                            <div class="course_card">
                                                <div class="item_image">

                                                </div>
                                                <div class="item_content">
                                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                                        <ul class="item_category_list unordered_list">
                                                            <li><a href="#!">{{ $service->categorie }}</a></li>
                                                        </ul>
                                                    </div>
                                                    <ul class="meta_info_list unordered_list">
                                                        <li>
                                                            <i class="fas fa-chart-bar"></i>
                                                            <span>Service proposé par: {{ $service->user->name }}</span>
                                                        </li>
                                                    </ul>
                                                    <h3 class="item_title">
                                                        <a href="{{ route('detail.service', ['id' => $service->id]) }}">
                                                            {{ $service->titre }}
                                                        </a>
                                                    </h3>
                                                    <a class="btn_unfill"
                                                        href="{{ route('detail.service', ['id' => $service->id]) }}">
                                                        <span class="btn_text">Voir plus</span>
                                                        <span class="btn_icon">
                                                            <i class="fas fa-long-arrow-right"></i>
                                                            <i class="fas fa-long-arrow-right"></i>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <li>
                                        <a href="{{ route('service.catalogue') }}" class="btn btn_dark">
                                            <span>
                                                <small>Parcourir le catalogue complet</small>
                                                <small>Afficher plus</small>
                                            </span>
                                        </a>
                                    </li>
                                @else
                                    <p>Aucun service trouvé.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
