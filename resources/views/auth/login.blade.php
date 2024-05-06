<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <title>{{ config('app.name', 'LocaFlex') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('bloxic/images/favicon.png')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('bloxic/images/favicon.png')}}" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('auth/css/bootstrap.min.css')}}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('auth/css/fontawesome-all.min.css')}}">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{asset('auth/font/flaticon.css')}}">
    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('auth/style.css')}}">
</head>

<body>
	<!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <div id="preloader" class="preloader">
        <div class='inner'>
            <div class='line1'></div>
            <div class='line2'></div>
            <div class='line3'></div>
        </div>
    </div>
	<section class="fxt-template-animation fxt-template-layout4">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6 col-12 fxt-bg-wrap">
					<div class="fxt-bg-img" data-bg-image="{{asset('auth/img/figure/bg4-l.jpg')}}">
						<div class="fxt-header">
							<div class="fxt-transformY-50 fxt-transition-delay-1">
								<a href="login-4.html" class="fxt-logo"><img src="{{asset('auth/img/logo-4.png')}}" alt="Logo"></a>
							</div>
							<div class="fxt-transformY-50 fxt-transition-delay-2">
								<h1>Heureux de vous revoir.</h1>
							</div>
							<div class="fxt-transformY-50 fxt-transition-delay-3">
								<p>Connectez Vous</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-12 fxt-bg-color">
					<div class="fxt-content">
						<div class="fxt-form">
							<form method="POST" action="{{ route('login') }}">
                                @csrf
								<div class="form-group">
                                    <label for="Email" class="input-label">Email</label>
                                    <input type="email" class="form-control" placeholder="Email" id="Email"
                                        name="email" :value="old('email')" required autofocus
                                        autocomplete="username">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
								</div>
								<div class="form-group">
									<label for="password" class="input-label">Password</label>
									<input id="password" type="password" class="form-control" name="password" placeholder="********" required="required">
									<i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
								</div>
								<div class="form-group">
									<div class="fxt-checkbox-area">
										<div class="checkbox">
											<input id="remember_token" type="checkbox">
											<label for="remember_token">Se souvenir de moi</label>
										</div>
										<a href="#" class="switcher-text">Mot de Passe Oublié ?</a>
									</div>
								</div>
								<div class="form-group">
									<button type="submit" class="fxt-btn-fill">Se connecter</button>
								</div>
							</form>
						</div>
						<div class="fxt-footer">
							<p>Pas encore de Compte ?<a href="{{route('register')}}" class="switcher-text2 inline-text">S'inscrire</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- jquery-->
	<script src="{{asset('auth/js/jquery-3.5.0.min.js')}}"></script>
	<!-- Bootstrap js -->
	<script src="{{asset('auth/js/bootstrap.min.js')}}"></script>
	<!-- Imagesloaded js -->
	<script src="{{asset('auth/js/imagesloaded.pkgd.min.js')}}"></script>
	<!-- Validator js -->
	<script src="{{asset('auth/js/validator.min.js')}}"></script>
	<!-- Custom Js -->
	<script src="{{asset('auth/js/main.js')}}"></script>

</body>

</html>
