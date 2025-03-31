<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Collab') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('Template/assets/images/logo/favourite_icon_1.svg') }}">
    <link rel="icon" href="{{ asset('Template/assets/images/logo/favourite_icon_1.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('auth/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('auth/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('auth/font/flaticon.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('auth/style.css')}}">
</head>

<body>
    <div id="preloader" class="preloader">
        <div class='inner'>
            <div class='line1'></div>
            <div class='line2'></div>
            <div class='line3'></div>
        </div>
    </div>
    <div id="wrapper" class="wrapper">
        <div class="fxt-template-animation fxt-template-layout4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-12 fxt-bg-wrap">
                        <div class="fxt-bg-img" data-bg-image="{{asset('autres_images/9.jpg')}}">
                            <div class="fxt-header">
                                <div class="fxt-transformY-50 fxt-transition-delay-1">
                                    <a href="#" class="fxt-logo"><img src="{{asset('Template/assets/images/logo/site_logo.svg')}}" alt="Logo"></a>
                                </div>
                                <div class="fxt-transformY-50 fxt-transition-delay-2">
                                    <h1>Bienvenue sur Collab</h1>
                                </div>
                                <div class="fxt-transformY-50 fxt-transition-delay-3">
                                    <p>Inscrivez-vous.Cela ne vous prendra que 1 min .</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 fxt-bg-color">
                        <div class="fxt-content">
                            <div class="fxt-form">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name" class="input-label">Nom utilisateur</label>
                                            <input type="text" class="form-control" placeholder="Nom et Prenom"
                                                id="name" name="name" :value="old('name')" required autofocus
                                                autocomplete="name">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="input-label">Numéro de télephone</label>
                                            <input type="tel" class="form-control" placeholder="votre numéro de téléphone"
                                                id="phone" name="phone" :value="old('phone')" required autofocus
                                                autocomplete="phone">
                                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                    </div>
                                    <div class="form-group">
                                        <label for="Email" class="input-label">Email</label>
                                        <input type="email" class="form-control" placeholder="Email" id="email"
                                            name="email" :value="old('email')" required autocomplete="username">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    <div class="form-group">
                                        <label for="role" class="input-label">S'inscrire en tant que</label>
                                        <select name="role" id="role" class="form-control" required>
                                            <option value="Client">Utilisateur Client</option>
                                            <option value="Loueur">Utilisateur Loueur</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="input-label">Mot de Passe</label>
                                        <input id="password" type="password" class="form-control" name="password" placeholder="********" required="required">
                                        <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation" class="input-label">Confirmé le mot de passe</label>
                                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="********" required="required">
                                        <i toggle="#password_confirmation" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="fxt-btn-fill">S'inscrire</button>
                                    </div>
                                </form>
                            </div>
                            <div class="fxt-footer">
                                <p>Déjà inscrit ?<a href="{{route('login')}}" class="switcher-text2 inline-text">Se connecter</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('auth/js/jquery-3.5.0.min.js')}}"></script>
    <script src="{{asset('auth/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('auth/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('auth/js/validator.min.js')}}"></script>
    <script src="{{asset('auth/js/main.js')}}"></script>
</body>
</html>
