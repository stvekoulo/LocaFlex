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
<!-- Page Content -->
    <!-- User Info -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="bg-image bg-image-bottom" style="background-image: url('{{ asset('assets/media/photos/photo13@2x.jpg') }}');">
        <div class="bg-black-75 py-4">
            <div class="content content-full text-center">
                <!-- Avatar -->
                <div class="mb-3">
                    <a class="img-link" href="be_pages_generic_profile.html">
                        <img class="img-avatar img-avatar96 img-avatar-thumb"
                            src="{{ asset('assets/media/avatars/avatar15.jpg') }}" alt="">
                    </a>
                </div>
                <!-- END Avatar -->

                <!-- Personal -->
                <h1 class="h3 text-white fw-bold mb-2"></h1>
                <h2 class="h5 text-white-75">
                    {{ auth()->user()->name }} <a class="text-danger-light"
                        href="javascript:void(0)">@ {{ auth()->user()->role }}</a>
                </h2>
                <!-- END Personal -->
            </div>
        </div>
    </div>
    <!-- END User Info -->

    <!-- Main Content -->
    <div class="content">
        <!-- User Profile -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="fa fa-user-circle me-1 text-muted"></i> Profil Utilisateur
                </h3>
            </div>
            <div class="block-content">
                <form action="be_pages_generic_profile.edit.html" method="POST" enctype="multipart/form-data"
                    onsubmit="return false;">
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Les informations vitales de votre compte.
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <div class="mb-4">
                                <label class="form-label" for="profile-settings-username">Nom d'utilisateur</label>
                                <input type="text" class="form-control form-control-lg" id="profile-settings-username"
                                    name="profile-settings-username" placeholder="Enter your username.."
                                    value="{{ auth()->user()->name }}" readonly>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="profile-settings-email">Email Address</label>
                                <input type="email" class="form-control form-control-lg" id="profile-settings-email"
                                    name="profile-settings-email" placeholder="Enter your email.."
                                    value="{{ auth()->user()->email }}" readonly>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="profile-settings-email">Numéro de teléphone</label>
                                <input type="tel" class="form-control form-control-lg" id="profile-settings-email"
                                    name="profile-settings-email" placeholder="Enter your phone number"
                                    value="{{ auth()->user()->phone }}" readonly>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END User Profile -->

        <!-- Change Password Section -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="fa fa-lock me-1 text-muted"></i> Modifier votre mot de passe
                </h3>
            </div>
            <div class="block-content">
                <form action="{{ route('loueur.updatePassword') }}" method="POST">
                    @csrf
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Changez votre mot de passe ici.
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="current_password" name="current_password"
                                    placeholder="Entrez votre ancien mot de passe">
                                <label class="form-label" for="current_password">Ancien mot de passe</label>
                                @error('current_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="new_password" name="new_password"
                                    placeholder="Entrez votre nouveau mot de passe">
                                <label class="form-label" for="new_password">Nouveau mot de passe</label>
                                @error('new_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Confirmez votre nouveau mot de passe">
                                <label class="form-label" for="password_confirmation">Confirmer le mot de passe</label>
                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="btn btn-alt-primary">Mettre à jour le mot de passe</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Change Password Section -->
    </div>
    <!-- END Main Content -->
    <!-- END Page Content -->
@endsection
