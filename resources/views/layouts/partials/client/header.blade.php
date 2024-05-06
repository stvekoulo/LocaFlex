<!-- Main Header / Header Style Two -->
<header class="main-header header-style-two">

    <!-- Header Lower -->
    <div class="header-lower">

        <div class="auto-container">
            <div class="inner-container d-flex justify-content-between align-items-center">
                <!-- Logo Box -->
                <div class="logo-box d-flex align-items-center">
                    <div class="nav-toggle-btn a-nav-toggle navSidebar-button">
                        <span class="hamburger">
                            <span class="top-bun"></span>
                            <span class="meat"></span>
                            <span class="bottom-bun"></span>
                        </span>
                    </div>
                    <!-- Logo -->
                    <div class="logo"><a href="index.html"><img src="{{ asset('bloxic/images/logo.png') }}"
                                alt="" title=""></a></div>
                </div>
                <div class="middle-box">
                    <div class="upper-box d-flex justify-content-between align-items-center flex-wrap">

                        <!-- Info List -->
                        <ul class="info-list">
                            <li><span class="icon"><img src="{{ asset('bloxic/images/icons/location.png') }}"
                                        alt="" /></span>Store
                                Location</li>
                            <li><span class="icon"><img src="{{ asset('bloxic/images/icons/bus.png') }}"
                                        alt="" /></span>Track Your
                                Order</li>
                            <li><span class="icon"><img src="{{ asset('bloxic/images/icons/telephone.png') }}"
                                        alt="" /></span>Call
                                Us For Enquiry</li>
                        </ul>

                        <!-- Upper Right -->
                        <div class="upper-right">
                            <!-- Info Box -->
                            <div class="upper-column info-box">
                                <div class="icon-box flaticon-gift-box"></div>
                                <strong>Free Shipping</strong>
                                Free shipping $100
                            </div>
                            <!-- Info Box -->
                            <div class="upper-column info-box">
                                <div class="icon-box flaticon-headphones"></div>
                                <strong>24/7 Support</strong>
                                Free shipping $100
                            </div>
                            <!-- Info Box -->
                            <div class="upper-column info-box">
                                <div class="icon-box flaticon-padlock-1"></div>
                                <strong>payment Secure</strong>
                                Free shipping $100
                            </div>
                        </div>
                    </div>

                    <div class="nav-outer d-flex justify-content-between align-items-center flex-wrap">

                        <!-- Main Menu -->
                        <nav class="main-menu show navbar-expand-md">
                            <div class="navbar-header">
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>

                            <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    <li class="dropdown"><a href="#">Home</a>
                                        <ul>
                                            <li><a href="index.html">Homepage One</a></li>
                                            <li><a href="index-2.html">Homepage Two</a></li>
                                            <li><a href="index-3.html">Homepage Three</a></li>
                                            <li class="dropdown"><a href="#">Header Styles</a>
                                                <ul>
                                                    <li><a href="index.html">Header Style One</a></li>
                                                    <li><a href="index-2.html">Header Style Two</a></li>
                                                    <li><a href="index-3.html">Header Style Three</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#">Shop</a>
                                        <ul>
                                            <li><a href="shop.html">Our Products</a></li>
                                            <li><a href="shop-detail.html">Product Single</a></li>
                                            <li><a href="cart.html">Shoping Cart</a></li>
                                            <li><a href="checkout.html">CheckOut</a></li>
                                            <li><a href="register.html">Register</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="about.html">About</a></li>
                                    <li class="dropdown"><a href="#">Blog</a>
                                        <ul>
                                            <li><a href="blog.html">Our Blog</a></li>
                                            <li><a href="blog-detail.html">Blog Single</a></li>
                                            <li><a href="not-found.html">Not Found</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="contact.html">Contact us</a></li>
                                </ul>
                            </div>

                        </nav>
                        <!-- Main Menu End-->

                        <!-- Options Box -->
                        <div class="options-box d-flex align-items-center">

                            <!-- Search Box -->
                            <div class="search-box-two">
                                <form method="post" action="contact.html">
                                    <div class="form-group">
                                        <input type="search" name="search-field" value="" placeholder="Search"
                                            required>
                                        <button type="submit"><span class="icon flaticon-search"></span></button>
                                    </div>
                                </form>
                            </div>

                            <!-- User Box -->
                            <a class="user-box flaticon-user-3" href="contact.html"></a>

                            <!-- Like Box -->
                            <div class="like-box">
                                <a class="user-box flaticon-heart" href="contact.html"></a>
                                <span class="total-like">0</span>
                            </div>

                            <!-- Cart Box -->
                            <div class="cart-box-two">
                                <a class="flaticon-shopping-bag" href="shop.html"></a>
                                <span class="total-like">0</span>
                            </div>

                            <!-- Mobile Navigation Toggler -->
                            <div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>

                        </div>

                    </div>

                </div>
                <!-- Button Box -->
                @if (auth()->check())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <div class="button-box text-center">
                            <button class="theme-btn btn-style-one">
                                {{ auth()->user()->name }}<span class="icon flaticon-right-arrow"></span>
                            </button>
                        </div>
                    </form>
                @else
                    <div class="button-box text-center">
                        <a href="{{ route('login') }}" class="theme-btn btn-style-one">
                            Se connecter <span class="icon flaticon-right-arrow"></span>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- End Header Lower -->

    <!-- Sticky Header  -->
    <div class="sticky-header">
        <div class="auto-container">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Logo -->
                <div class="logo">
                    <a href="index.html" title=""><img src="{{ asset('bloxic/images/logo-small.png') }}"
                            alt="" title=""></a>
                </div>

                <!-- Right Col -->
                <div class="right-box">
                    <!-- Main Menu -->
                    <nav class="main-menu">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                    <!-- Main Menu End-->

                    <!-- Mobile Navigation Toggler -->
                    <div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Sticky Menu -->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><span class="icon flaticon-multiply"></span></div>
        <nav class="menu-box">
            <div class="nav-logo"><a href="index.html"><img src="{{ asset('bloxic/images/mobile-logo.png') }}"
                        alt="" title=""></a></div>
            <!-- Search -->
            <div class="search-box">
                <form method="post" action="contact.html">
                    <div class="form-group">
                        <input type="search" name="search-field" value="" placeholder="SEARCH HERE" required>
                        <button type="submit"><span class="icon flaticon-search-1"></span></button>
                    </div>
                </form>
            </div>
            <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
            </div>
        </nav>
    </div>
    <!-- End Mobile Menu -->

</header>
<!-- End Main Header -->
