@extends('layouts.opus')
@section('content')
    <main class="page_content">
        <section class="page_banner">
            <div class="container">
                <div class="content_wrapper" style="background-image: url('{{ asset('autres_images/person-paying-using-nfc-technology.jpg') }}');">
                    <div class="row align-items-center">
                        <div class="col col-lg-6">
                            <h1 class="page_title" style="color: white">Gérer vos Paiements</h1>
                            <p class="page_description" style="color: white">
                                Gérez facilement le paiement de vos factures pour les biens réservés et les services
                                utilisés.
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </section>
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
        <section class="pricing_section section_space_lg pb-0">
            <div class="container decoration_wrap">
                <div class="section_heading text-center">
                    <h2 class="heading_text mb-0">Section Réservation des Biens</h2>
                </div>
                <div class="pricing_cards_wrapper row align-items-center">
                    @foreach ($paymentsForBiens as $index => $payment)
                        <div class="col col-lg-4">
                            <div class="pricing_card text-center tilt @if ($index == intval(count($paymentsForBiens) / 2)) bg_dark @endif">
                                <h3 class="card_heading">Facture</h3>
                                <div class="pricing_wrap">
                                    <span class="price_value"><sup></sup>CFA {{  number_format($payment->montant, 0) }}</span>
                                    <small class="d-block">{{ $payment->etat }}</small>
                                </div>
                                <hr>
                                <ul class="info_list unordered_list_block text-start">
                                    <li>
                                        <i class="fas fa-caret-right"></i>
                                        <span>Equipement louer : {{ $payment->bien ? $payment->bien->titre : 'Non spécifié' }}</span>
                                    </li>
                                </ul>
                                <div class="btn_wrap pb-0">
                                    @if($payment->etat === 'Payé')
                                        <button class="btn btn_success" disabled>
                                            <span>
                                                <small>Paiement effectué</small>
                                                <small>Déjà payé</small>
                                            </span>
                                        </button>
                                    @else
                                        <a class="btn btn_primary"
                                            href="{{ route('payment.store', ['paiementId' => $payment->id]) }}">
                                            <span>
                                                <small>Confirmer le paiement</small>
                                                <small>Proceder au paiement</small>
                                            </span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="deco_item shape_img_1" data-parallax='{"y" : 130, "smoothness": 6}'>
                    <img src="{{ asset('Template/assets/images/shape/shape_img_4.png') }}"
                        alt="Collab – Plateforme location polyvalentes">
                </div>
                <div class="deco_item shape_img_2" data-parallax='{"y" : -130, "smoothness": 6}'>
                    <img src="{{ asset('Template/assets/images/shape/shape_img_5.png') }}"
                        alt="Collab – Plateforme location polyvalentes">
                </div>
            </div>
        </section>

        <section class="pricing_section section_space_lg pb-0">
            <div class="container decoration_wrap">
                <div class="section_heading text-center">
                    <h2 class="heading_text mb-0">Section Réservation des Services</h2>
                </div>
                <div class="pricing_cards_wrapper row align-items-center">
                    @foreach ($paymentsForServices as $index => $payment)
                        <div class="col col-lg-4">
                            <div class="pricing_card text-center tilt @if ($index == intval(count($paymentsForServices) / 2)) bg_dark @endif">
                                <h3 class="card_heading">Facture</h3>
                                <div class="pricing_wrap">
                                    <span class="price_value"><sup></sup>CFA {{ number_format($payment->montant, 0) }}</span>
                                    <small class="d-block">{{ $payment->etat }}</small>
                                </div>
                                <hr>
                                <ul class="info_list unordered_list_block text-start">
                                    <li>
                                        <i class="fas fa-caret-right"></i>
                                        <span>Service: {{ $payment->service ? $payment->service->titre : 'Non spécifié' }}</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-caret-right"></i>
                                        <span>Categorie du Service: {{ $payment->service ? $payment->service->categorie : 'Non spécifié' }}</span>
                                    </li>
                                </ul>
                                <div class="btn_wrap pb-0">
                                    @if($payment->etat === 'Payé')
                                        <button class="btn btn_success" disabled>
                                            <span>
                                                <small>Paiement effectué</small>
                                                <small>Déjà payé</small>
                                            </span>
                                        </button>
                                    @else
                                        <a class="btn btn_primary"
                                            href="{{ route('payment.store', ['paiementId' => $payment->id]) }}">
                                            <span>
                                                <small>Confirmer le paiement</small>
                                                <small>Proceder au paiement</small>
                                            </span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="deco_item shape_img_1" data-parallax='{"y" : 130, "smoothness": 6}'>
                    <img src="{{ asset('Template/assets/images/shape/shape_img_4.png') }}"
                        alt="Collab – Plateforme location polyvalentes">
                </div>
                <div class="deco_item shape_img_2" data-parallax='{"y" : -130, "smoothness": 6}'>
                    <img src="{{ asset('Template/assets/images/shape/shape_img_5.png') }}"
                        alt="Collab – Plateforme location polyvalentes">
                </div>
            </div>
        </section>
        <section class="faq_section section_space_lg">
            <div class="container">
                <div class="section_heading text-center mb-3">
                    <div class="row justify-content-center">
                        <div class="col col-lg-7">
                            <h2 class="heading_text">
                                INFORMATIONS
                            </h2>
                            <p class="heading_description mb-0">
                                Avant de procéder à tout paiement, assurez-vous d'avoir bien reçu l'équipement à louer s'il
                                s'agit d'une réservation de bien, ou d'être sûr d'avoir utilisé le service réservé.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
