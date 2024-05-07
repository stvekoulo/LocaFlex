@extends('layouts.simple')
@section('content')
    <div class="hero bg-body-extra-light">
        <div class="hero-inner">
            <div class="content content-full">
                <div class="py-4 text-center">
                    <div class="display-1 fw-bold text-elegance">
                        <i class="fa fa-database opacity-50 me-1"></i> 503
                    </div>
                    <h1 class="fw-bold mt-5 mb-2">Oops.. Vous venez de trouver une page d'erreur..</h1>
                    <h2 class="fs-4 fw-medium text-muted mb-5">Nous sommes désolés, mais il semble qu'aucun profil scolaire
                        n'ait été ajouté ou activé. Veuillez ajouter un profil scolaire ou activer un profil existant pour
                        accéder à notre service.</h2>
                    @if (Auth::guard('staff')->user()->role == 'surveillant')
                        <a href="{{ route('schoolyear.index') }}" class="btn btn-lg btn-primary">
                            Ajouter ou activer un profil
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
