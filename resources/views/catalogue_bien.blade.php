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
        <section class="page_banner">
            <div class="container">
                <div class="content_wrapper" style="background-image: url('{{ asset('autres_images/8.jpg') }}');">
                    <div class="row align-items-center">
                        <div class="col col-lg-6">
                            <h1 class="page_title">Catalogue des Produits</h1>
                            <p class="page_description">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="courses_archive_section section_space_lg">
            <div class="container">
                <div class="row">
                    @if ($biens->isNotEmpty())
                        @foreach ($biens as $bien)
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
                                                <span class="sale_price">CFA {{ number_format($bien->prix, 0) }}</span>
                                            </div>
                                        </div>
                                        <ul class="meta_info_list unordered_list">
                                            <li>
                                                <i class="fas fa-chart-bar"></i>
                                                <span>Proposé par : {{ $bien->user->name }}</span>
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
                    @else
                        <p>Aucun service trouvé.</p>
                    @endif
                </div>
            </div>
        </section>
        <!-- Courses Archive Section - End
            ================================================== -->
    </main>
@endsection
