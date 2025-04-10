<header class="site_header site_header_1">
    <div class="container">
        <div class="row align-items-center">
            <div class="col col-lg-3 col-5">
                <div class="site_logo">
                    <a class="site_link" href="{{ route('home') }}">
                        <img src="{{ asset('Template/assets/images/logo/site_logo.svg') }}"
                            alt="Collab – Plateforme location polyvalentes">
                    </a>
                </div>
            </div>
            <div class="col col-lg-6 col-2">
                <nav class="main_menu navbar navbar-expand-lg">
                    <div class="main_menu_inner collapse navbar-collapse justify-content-center"
                        id="main_menu_dropdown">
                        <ul class="main_menu_list unordered_list_center">
                            <li><a class="nav-link" href="{{ route('home') }}">Acceuil</a></li>
                            <li><a class="nav-link" href="{{ route('bien.catalogue') }}">Catalogue Équipements</a>
                            </li>
                            <li><a class="nav-link" href="{{ route('service.catalogue') }}">Catalogue Services</a>
                            </li>
                            @if (auth()->check())
                                <li><a class="nav-link" href="{{ route('payment.index') }}">Paiement</a></li>
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col col-lg-3 col-5">
                <ul class="header_btns_group unordered_list_end d-flex align-items-center">
                    <li>
                        <button class="mobile_menu_btn" type="button" data-bs-toggle="collapse"
                            data-bs-target="#main_menu_dropdown" aria-controls="main_menu_dropdown"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa-solid fa-arrow-down"></i>
                        </button>
                    </li>
                    @if (auth()->check())
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn border_dark" type="submit">
                                <span>
                                    <small>Utilisateur : {{ auth()->user()->name }}</small>
                                    <small>Déconnexion</i></small>
                                </span>
                            </button>
                        </form>
                    @else
                        <button class="d-inline-block me-2">
                            <a class="btn border_dark" href="{{ route('login') }}">
                                <span>
                                    <small>Se connecter</small>
                                    <small>Se connecter</small>
                                </span>
                            </a>
                        </button>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</header>
