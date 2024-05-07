@extends('layouts.simple')
@section('content')
    <div class="hero bg-body-extra-light">
        <div class="hero-inner">
            <div class="content content-full">
                <div class="py-4 text-center">
                    <div class="display-1 fw-bold text-corporate">
                        <i class="fa fa-ban opacity-50 me-1"></i> 403
                    </div>
                    <h1 class="fw-bold mt-5 mb-2">Oups... Vous venez de trouver une page d'erreur.</h1>
                    <h2 class="fs-4 fw-medium text-muted mb-5">Nous sommes désolés mais vous n'êtes pas autorisé à accéder
                        à cette page..</h2>
                        <a class="btn btn-lg btn-alt-secondary" href="{{ url()->previous() }}">
                            <i class="fa fa-arrow-left opacity-50 me-1"></i> Retour
                        </a>
                </div>
            </div>
        </div>
    </div>
@endsection
