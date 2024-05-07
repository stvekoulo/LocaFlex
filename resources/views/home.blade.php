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
    <!-- Banner Section - Start
        ================================================== -->
        <section class="hero_banner style_1">
            <div class="container">
                <div class="content_wrap">
                    <div class="row">
                        <div class="col col-lg-7">
                            <h1 class="banner_small_title">Learning Excellence</h1>
                            <h2 class="banner_big_title">The Best Free Online Courses of All Time</h2>
                            <p class="banner_description">
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                                esse cillum fugiat nulla pariatur
                            </p>
                        </div>
                        <div class="col col-lg-5">
                            <div class="banner_image_1 decoration_wrap">
                                <div class="image_wrap">
                                    <img src="{{asset('Template/assets/images/banner/hero_banner_img_1.jpg')}}"
                                        alt="Collab – Plateforme location polyvalentes">
                                </div>
                                <div class="satisfied_student">
                                    <h3 class="wrap_title">220+ Utilisateur</h3>
                                    <ul class="students_thumbnail unordered_list_center">
                                        <li>
                                            <span>
                                                <img src="{{asset('Template/assets/images/meta/student_thumbnail_1.png')}}"
                                                    alt="Collab – Plateforme location polyvalentes">
                                            </span>
                                        </li>
                                        <li>
                                            <span>
                                                <img src="{{asset('Template/assets/images/meta/student_thumbnail_1.png')}}"
                                                    alt="Collab – Plateforme location polyvalentes">
                                            </span>
                                        </li>
                                        <li>
                                            <span>
                                                <img src="{{asset('Template/assets/images/meta/student_thumbnail_1.png')}}"
                                                    alt="Collab – Plateforme location polyvalentes">
                                            </span>
                                        </li>
                                        <li>
                                            <span>
                                                <img src="{{asset('Template/assets/images/meta/student_thumbnail_1.png')}}"
                                                    alt="Collab – Plateforme location polyvalentes">
                                            </span>
                                        </li>
                                        <li>
                                            <span>
                                                <img src="{{asset('Template/assets/images/meta/student_thumbnail_1.png')}}"
                                                    alt="Collab – Plateforme location polyvalentes">
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="deco_item shape_img_1" data-parallax='{"y" : -130, "smoothness": 6}'>
                                    <img src="{{asset('Template/assets/images/shape/shape_img_1.png')}}"
                                        alt="Collab – Plateforme location polyvalentes">
                                </div>
                                <div class="deco_item shape_img_2" data-parallax='{"y" : 160, "smoothness": 6}'>
                                    <img src="{{asset('Template/assets/images/shape/shape_img_2.png')}}"
                                        alt="Collab – Plateforme location polyvalentes">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Banner Section - End
    ================================================== -->

    <!-- Expect From Course - Start
        ================================================== -->
        <section class="expect_from_course section_space_lg">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-6">
                        <div class="section_heading">
                            <h2 class="heading_text">
                                Collab C'est quoi ?
                            </h2>
                            <p class="heading_description mb-0">
                                Rutrum tellus pellentesque eu tincidunt. Venenatis cras sed felis eget velit aliquet
                                sagittis id consectetur
                            </p>
                        </div>

                        <div class="image_widget">
                            <img src="{{asset('Template/assets/images/about/about_image_1.jpg')}}"
                                alt="Collab – Plateforme location polyvalentes">
                        </div>
                    </div>
                    <div class="col col-lg-6">
                        <div class="row">
                            <div class="col col-md-6">
                                <div class="service_item" data-magnetic>
                                    <div class="item_icon">
                                        <img src="{{asset('Template/assets/images/service/icon_academic_cap.svg')}}"
                                            alt="Collab – Plateforme location polyvalentes">
                                    </div>
                                    <div class="item_content">
                                        <h3 class="item_title">Knowledge</h3>
                                        <p class="mb-0">
                                            Duis aute irure dolor in repreh in voluptate velit esse cillum dolore eu
                                            fugiat nulla pariatur
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-6">
                                <div class="service_item" data-magnetic>
                                    <div class="item_icon">
                                        <img src="{{asset('Template/assets/images/service/icon_physics.svg')}}"
                                            alt="Collab – Plateforme location polyvalentes">
                                    </div>
                                    <div class="item_content">
                                        <h3 class="item_title">Unlimited access</h3>
                                        <p class="mb-0">
                                            Libero nunc consequat interd varius sit amet mattis vulpute enim liquet
                                            sagittis
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-6">
                                <div class="service_item" data-magnetic>
                                    <div class="item_icon">
                                        <img src="{{asset('Template/assets/images/service/icon_communication.svg')}}"
                                            alt="Collab – Plateforme location polyvalentes">
                                    </div>
                                    <div class="item_content">
                                        <h3 class="item_title">Practical Skills</h3>
                                        <p class="mb-0">
                                            Vulputate enim nulla aliquet porttitor lacus luctus accums. Cras sed
                                            felis eget velit
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-6">
                                <div class="service_item" data-magnetic>
                                    <div class="item_icon">
                                        <img src="{{asset('Template/assets/images/service/icon_diploma.svg')}}"
                                            alt="Collab – Plateforme location polyvalentes">
                                    </div>
                                    <div class="item_content">
                                        <h3 class="item_title">A certificate</h3>
                                        <p class="mb-0">
                                            Excepteur sint occaecat cupid non proident, sunt in culpa qui officia
                                            deserunt mollit
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Expect From Course - End
    ================================================== -->

    <!-- Courses Section - Start
        ================================================== -->
        <section class="courses_section section_space_lg">
            <div class="container">
                <div class="section_heading">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col col-lg-6">
                            <h2 class="heading_text mb-0">
                                Découvrez notre catalogue
                            </h2>
                        </div>
                        <div class="col col-lg-5">
                            <p class="heading_description mb-0 text-lg-end">
                                Parcourez puis trouvez
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
                                <span>Catégorie Biens à louer</span>
                            </button>
                        </li>
                        <li role="presentation">
                            <button data-bs-toggle="tab" data-bs-target="#teb_photography" type="button"
                                role="tab" aria-selected="false">
                                <i class="fas fa-camera"></i>
                                <span>Catégorie Services disponibles</span>
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
                                                <a href="{{ route('detail.bien', ['id' => $bien->id]) }}" data-cursor-text="View">
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
                                                <a class="btn_unfill" href="{{ route('detail.bien', ['id' => $bien->id]) }}">
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
                                    <a href="{{route('bien.catalogue')}}" class="btn btn_dark">
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
                                                <a class="btn_unfill" href="{{ route('detail.service', ['id' => $service->id]) }}">
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
                                    <a href="{{route('service.catalogue')}}" class="btn btn_dark">
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
        <!-- Courses Section - End
    ================================================== -->

    <!-- Newslatter Section - Start
        ================================================== -->
        <section class="newslatter_section">
            <div class="container">
                <div class="newslatter_box" style="background-image: url('{{asset('Template/assets/images/shape/shape_img_6.svg')}}');">
                    <div class="row justify-content-center">
                        <div class="col col-lg-6">
                            <div class="section_heading text-center">
                                <h2 class="heading_text">
                                    Subscribe Now Forget 20% Discount Every Courses
                                </h2>
                                <p class="heading_description mb-0">
                                    Nam ipsum risus, rutrum vitae, vestibulum eu, molestie vel, lacus. Sed magna
                                    purus, fermentum eu
                                </p>
                            </div>
                            <form action="#">
                                <div class="form_item m-0">
                                    <input type="email" name="email" placeholder="Your Email">
                                    <button type="submit" class="btn btn_dark">
                                        <span>
                                            <small>Subsctibe</small>
                                            <small>Subsctibe</small>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Newslatter Section - End
    ================================================== -->
</main>

@endsection
