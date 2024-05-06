@extends('layouts.opus')
@section('content')
    <!-- Sidebar Cart Item -->
    <div class="xs-sidebar-group info-group">
        <div class="xs-overlay xs-bg-black"></div>
        <div class="xs-sidebar-widget">
            <div class="sidebar-widget-container">
                <div class="widget-heading">
                    <a href="#" class="close-side-widget">
                        X
                    </a>
                </div>
                <div class="sidebar-textwidget">

                    <!-- Sidebar Info Content -->
                    <div class="sidebar-info-contents">
                        <div class="content-inner">
                            <div class="logo">
                                <a href="index.html"><img src="{{ asset('bloxic/images/logo.png') }}" alt=""
                                        title=""></a>
                            </div>
                            <div class="content-box">

                                <h6>Services</h6>
                                <ul class="sidebar-services-list">
                                    <li><a href="#">Laptops & Computers</a></li>
                                    <li><a href="#">Cameras & Photography</a></li>
                                    <li><a href="#">Smart Phones & Tablets</a></li>
                                    <li><a href="#">Video Games & Consoles</a></li>
                                    <li><a href="#">TV & Audio</a></li>
                                    <li><a href="#">LED Table</a></li>
                                </ul>

                                <h6>Contact info</h6>
                                <!-- List Style One -->
                                <ul class="list-style-one">
                                    <li>
                                        <span class="icon flaticon-maps-and-flags"></span>
                                        <strong>Our office</strong>
                                        A-1, Envanto Headquarters, <br> Melbourne, Australia.
                                    </li>
                                    <li>
                                        <span class="icon flaticon-call-1"></span>
                                        <strong>Phone</strong>
                                        <a href="tel:+00-999-999-9999">+(00) 999 999 9999</a><br>
                                        <a href="tel:+000-000-0000">000 000 0000</a>
                                    </li>
                                    <li>
                                        <span class="icon flaticon-mail"></span>
                                        <strong>Email</strong>
                                        <a href="mailto:contact@bloxic.com">contact@Bloxic.com</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- END sidebar widget item -->

    <!-- Main Section -->
    <section class="main-slider-two">
        <div class="main-slider-carousel owl-carousel owl-theme">
            @if ($troisDerniersBiens->isNotEmpty())
                @foreach ($troisDerniersBiens as $bien)
                    <!-- Slide One -->
                    <div class="slide">
                        <div class="image-layer" style="background-image: url({{ asset('autres_images/locaflex.png') }})">
                        </div>
                        <div class="vector-icon"
                            style="background-image: url({{ asset('bloxic/images/main-slider/vector-4.png') }})"></div>
                        <div class="auto-container">
                            <!-- Content Column -->
                            <div class="content-box">
                                <div class="pattern-layer"></div>
                                <div class="box-inner">
                                    <div class="title" style="font-size: 35px;">{{ $bien->categorie }}</div>
                                    <h1>{{ $bien->titre }}</h1>
                                    <div class="text">{{ $bien->description }}</div>
                                    <div class="price">À partir de <span>{{ $bien->prix }} FCFA</span></div>

                                    @if ($bien->photos->isNotEmpty())
                                        <img src="{{ Storage::url($bien->photos->first()->chemin_fichier) }}"
                                            alt="{{ $bien->photos->first()->description }}">
                                    @else
                                        <img src="{{ asset('placeholder.jpg') }}" alt="Placeholder">
                                    @endif
                                    </br>
                                    <!-- Button Box -->
                                    <div class="button-box">
                                        <a href="#" class="theme-btn btn-style-one">
                                            Voir Plus <span class="icon flaticon-right-arrow"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Slide One -->
                @endforeach
            @else
                <p>Aucun bien trouvé.</p>
            @endif
        </div>
        <!-- Side Title -->
        <div class="social-box">
			<a href="#">Tw.</a>
			<a href="#">Fa.</a>
			<a href="#">In.</a>
		</div>
        <!-- End Side Title -->
    </section>
    <!-- End Main Section -->

    <!-- Products Section Four -->
    <section class="products-section-four">
        <div class="auto-container">
			<div class="inner-container">
				<div class="row clearfix">

					<!-- Feature Block -->
					<div class="feature-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
						<div class="inner-box">
							<div class="content">
								<div class="icon flaticon-fast"></div>
								<strong>Free Shipping</strong>
								<div class="text">Free shipping over $100</div>
							</div>
						</div>
					</div>

					<!-- Feature Block -->
					<div class="feature-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
						<div class="inner-box">
							<div class="content">
								<div class="icon flaticon-padlock"></div>
								<strong>Payment Secure</strong>
								<div class="text">Got 100% Payment Safe</div>
							</div>
						</div>
					</div>

					<!-- Feature Block -->
					<div class="feature-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
						<div class="inner-box">
							<div class="content">
								<div class="icon flaticon-headphones-1"></div>
								<strong>Support 24/7</strong>
								<div class="text">Top quialty 24/7 Support</div>
							</div>
						</div>
					</div>

					<!-- Feature Block -->
					<div class="feature-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
						<div class="inner-box">
							<div class="content">
								<div class="icon flaticon-wallet"></div>
								<strong>100% Money Back</strong>
								<div class="text">Cutomers Money Backs</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
    </section>
    <!-- End Products Section Four -->

    <!-- Brand Section -->
    <section class="brand-section">
        <div class="outer-container">
            <div class="animation_mode">
                <h1>Design. <span>Brand</span>. <strong>Quality</strong></h1>
                <img src="{{ asset('bloxic/images/icons/icon-1.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/feature.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/icon-2.png') }}" alt="" />
                <h1>Design. <span>Brand</span>. <strong>Quality</strong></h1>
                <img src="{{ asset('bloxic/images/icons/icon-1.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/feature.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/icon-2.png') }}" alt="" />
                <h1>Design. <span>Brand</span>. <strong>Quality</strong></h1>
                <img src="{{ asset('bloxic/images/icons/icon-1.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/feature.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/icon-2.png') }}" alt="" />
                <h1>Design. <span>Brand</span>. <strong>Quality</strong></h1>
                <img src="{{ asset('bloxic/images/icons/icon-1.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/feature.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/icon-2.png') }}" alt="" />
            </div>
        </div>
    </section>
    <!-- End Brand Section -->

    <!-- Products Section Five -->
    <section class="products-section-five">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title">
                <h4><span>Section Bien </span> Quelques produits disponibles pour vous !</h4>
            </div>
            <div class="four-item-carousel owl-carousel owl-theme">
                <!-- Shop Item -->
                @forelse ($biens as $bien)
                    <div class="shop-item style-two">
                        <div class="inner-box">
                            <div class="image">
                                @if ($bien->photos->isNotEmpty())
                                    <a href="#"><img src="{{ Storage::url($bien->photos->first()->chemin_fichier) }}"
                                            alt="{{ $bien->titre }}" /></a>
                                @else
                                    <a href="#"><img src="{{ asset('placeholder.jpg') }}" alt="Placeholder"></a>
                                @endif
                                <div class="options-box">
                                    <span class="plus flaticon-plus"></span>
                                    <ul class="option-list">
                                        <li><a class="flaticon-resize" href="#"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="lower-content">
                                <!-- Ajoutez ici les détails du bien -->
                                <div class="rating">
                                    <!-- Ajoutez ici les étoiles de notation si vous en avez -->
                                </div>
                                <h6><a href="#">{{ $bien->titre }}</a></h6>
                                <div class="price" style="color: red"><span></span>{{ $bien->prix }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Aucun bien disponible trouvé.</p>
                @endforelse
            </div>

            <!-- Purchase Box -->
            @guest
            <div class="purchase-box d-flex justify-content-between align-items-center flex-wrap">
                <div class="text">Nous sommes heureux de vous accueillir sur notre site. Créez votre compte </div>
                <!-- Boîte de boutons -->
                <div class="button-box">
                    <a href="{{route('register')}}" class="theme-btn btn-style-two">
                    S'inscrire <span class="icon flaticon-right-arrow"></span>
                    </a>
                </div>
            </div>
            @endguest
            <!-- End Purchase Box -->

        </div>
    </section>
    <!-- End Products Section Five -->

    <!-- Brand Section -->
    <section class="brand-section">
        <div class="outer-container">
            <div class="animation_mode">
                <h1>Design. <span>Brand</span>. <strong>Quality</strong></h1>
                <img src="{{ asset('bloxic/images/icons/icon-1.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/feature.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/icon-2.png') }}" alt="" />
                <h1>Design. <span>Brand</span>. <strong>Quality</strong></h1>
                <img src="{{ asset('bloxic/images/icons/icon-1.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/feature.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/icon-2.png') }}" alt="" />
                <h1>Design. <span>Brand</span>. <strong>Quality</strong></h1>
                <img src="{{ asset('bloxic/images/icons/icon-1.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/feature.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/icon-2.png') }}" alt="" />
                <h1>Design. <span>Brand</span>. <strong>Quality</strong></h1>
                <img src="{{ asset('bloxic/images/icons/icon-1.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/feature.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/icon-2.png') }}" alt="" />
            </div>
        </div>
    </section>
    <!-- End Brand Section -->

    <!-- Sale Section -->
    <section class="sale-section">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Sale Block -->
                <div class="sale-block style-two col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-box">
                        <div class="sale-box">
                            SALE
                            <span>30<i>% OFF</i></span>
                        </div>
                        <div class="image d-flex justify-content-between align-items-center">
                            <img src="{{ asset('bloxic/images/resource/shop-3.jpg') }}" alt="" />
                            <div class="overlay-box">
                                <div class="overlay-inner">
                                    <div class="off">Get 30% off</div>
                                    <h5><a href="shop-detail.html">Be together in the moment <br> with Barnix calling</a>
                                    </h5>
                                    <a class="buy-now" href="shop-detail.html">buy now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sale Block -->
                <div class="sale-block col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-box">
                        <div class="sale-box">
                            SALE
                            <span>30<i>% OFF</i></span>
                        </div>
                        <div class="image d-flex justify-content-between align-items-center">
                            <img src="{{ asset('bloxic/images/resource/shop-2.jpg') }}" alt="" />
                            <div class="overlay-box">
                                <div class="overlay-inner">
                                    <div class="off">Get 30% off</div>
                                    <h5><a href="shop-detail.html">Be together in the moment <br> with Barnix calling</a>
                                    </h5>
                                    <a class="buy-now" href="shop-detail.html">buy now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End Sale Section -->

    <!-- Products Section Three -->
    <section class="products-section-three">

        <div class="auto-container">
			<!-- Sec Title -->
			<div class="sec-title">
				<h4><span>Products </span> Your Choice!</h4>
			</div>
			<div class="row clearfix">

				<!-- News Block -->
				<div class="news-block-two col-lg-4 col-md-6 col-sm-12">
					<div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
						<div class="image">
							<div class="tag">bedroom</div>
							<a href="blog-detail.html"><img src="images/resource/news-3.jpg" alt="" /></a>
						</div>
						<div class="lower-content">
							<div class="info">By: <span>Alextian</span> <i>January 23,2022</i></div>
							<h5><a href="blog-detail.html">The City of London Wants To Have Brexit Cake available</a></h5>
							<a class="read-more" href="#">Read More</a>
						</div>
					</div>
				</div>

				<!-- News Block -->
				<div class="news-block-two col-lg-4 col-md-6 col-sm-12">
					<div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
						<div class="image">
							<div class="tag">bedroom</div>
							<a href="blog-detail.html"><img src="images/resource/news-4.jpg" alt="" /></a>
						</div>
						<div class="lower-content">
							<div class="info">By: <span>Alextian</span> <i>January 23,2022</i></div>
							<h5><a href="blog-detail.html">The City of London Wants To Have Brexit Cake available</a></h5>
							<a class="read-more" href="#">Read More</a>
						</div>
					</div>
				</div>

				<!-- News Block -->
				<div class="news-block-two col-lg-4 col-md-6 col-sm-12">
					<div class="inner-box wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
						<div class="image">
							<div class="tag">bedroom</div>
							<a href="blog-detail.html"><img src="images/resource/news-5.jpg" alt="" /></a>
						</div>
						<div class="lower-content">
							<div class="info">By: <span>Alextian</span> <i>January 23,2022</i></div>
							<h5><a href="blog-detail.html">The City of London Wants To Have Brexit Cake available</a></h5>
							<a class="read-more" href="#">Read More</a>
						</div>
					</div>
				</div>

			</div>

			<!-- Button Box -->
			<div class="button-box text-center">
				<a href="blog.html" class="theme-btn btn-style-one">
					More Blog <span class="icon flaticon-right-arrow"></span>
				</a>
			</div>

		</div>
    </section>
    <!-- End Products Section Three -->

    <!-- Services Section -->
    <section class="services-section">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title">
                <h4><span>essential </span> services</h4>
            </div>

            <!-- Services Info Tabs -->
            <div class="services-info-tabs">
                <!-- Services Tabs -->
                <div class="services-tabs tabs-box">
                    <!-- Feature Icon -->
                    <div class="feature-icon">
                        <img src="images/icons/feature-1.png" alt="" />
                    </div>
                    <!-- Tab Btns -->
                    <ul class="tab-btns tab-buttons clearfix">
                        <li data-tab="#prod-furniture1" class="tab-btn active-btn">Furniture Collection</li>
                        <li data-tab="#prod-room1" class="tab-btn">Living Room Collection</li>
                        <li data-tab="#prod-interior1" class="tab-btn">Interior Desiging</li>
                    </ul>

                    <!-- Tabs Container -->
                    <div class="tabs-content">

                        <!-- Tab / Active Tab -->
                        <div class="tab active-tab" id="prod-furniture1">
                            <div class="row clearfix">

                                <!-- Service Block -->
                                <div class="service-block active col-lg-6 col-md-6 col-sm-12">
                                    <div class="inner-box">
                                        <div class="image">
                                            <a href="shop-detail.html"><img
                                                    src="{{ asset('bloxic/images/resource/service-1.png') }}"
                                                    alt="" /></a>
                                        </div>
                                        <div class="lower-content">
                                            <h5><a href="shop-detail.html">Business Card Design</a></h5>
                                            <div class="text">We build and activate brands through cultural <br> str
                                                vision, and the power of emotion <br> across every</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Service Block -->
                                <div class="service-block col-lg-6 col-md-6 col-sm-12">
                                    <div class="inner-box">
                                        <div class="image">
                                            <a href="shop-detail.html"><img
                                                    src="{{ asset('bloxic/images/resource/service-2.png') }}"
                                                    alt="" /></a>
                                        </div>
                                        <div class="lower-content">
                                            <h5><a href="shop-detail.html">Banner Desgin</a></h5>
                                            <div class="text">We build and activate brands through cultural <br> str
                                                vision, and the power of emotion <br> across every</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Tab -->
                        <div class="tab" id="prod-room1">
                            <div class="row clearfix">

                                <!-- Service Block -->
                                <div class="service-block col-lg-6 col-md-6 col-sm-12">
                                    <div class="inner-box">
                                        <div class="image">
                                            <a href="shop-detail.html"><img
                                                    src="{{ asset('bloxic/images/resource/service-1.png') }}"
                                                    alt="" /></a>
                                        </div>
                                        <div class="lower-content">
                                            <h5><a href="shop-detail.html">Business Card Design</a></h5>
                                            <div class="text">We build and activate brands through cultural <br> str
                                                vision, and the power of emotion <br> across every</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Service Block -->
                                <div class="service-block active col-lg-6 col-md-6 col-sm-12">
                                    <div class="inner-box">
                                        <div class="image">
                                            <a href="shop-detail.html"><img
                                                    src="{{ asset('bloxic/images/resource/service-2.png') }}"
                                                    alt="" /></a>
                                        </div>
                                        <div class="lower-content">
                                            <h5><a href="shop-detail.html">Banner Desgin</a></h5>
                                            <div class="text">We build and activate brands through cultural <br> str
                                                vision, and the power of emotion <br> across every</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Tab -->
                        <div class="tab" id="prod-interior1">
                            <div class="row clearfix">

                                <!-- Service Block -->
                                <div class="service-block active col-lg-6 col-md-6 col-sm-12">
                                    <div class="inner-box">
                                        <div class="image">
                                            <a href="shop-detail.html"><img
                                                    src="{{ asset('bloxic/images/resource/service-1.png') }}"
                                                    alt="" /></a>
                                        </div>
                                        <div class="lower-content">
                                            <h5><a href="shop-detail.html">Business Card Design</a></h5>
                                            <div class="text">We build and activate brands through cultural <br> str
                                                vision, and the power of emotion <br> across every</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Service Block -->
                                <div class="service-block col-lg-6 col-md-6 col-sm-12">
                                    <div class="inner-box">
                                        <div class="image">
                                            <a href="shop-detail.html"><img
                                                    src="{{ asset('bloxic/images/resource/service-2.png') }}"
                                                    alt="" /></a>
                                        </div>
                                        <div class="lower-content">
                                            <h5><a href="shop-detail.html">Banner Desgin</a></h5>
                                            <div class="text">We build and activate brands through cultural <br> str
                                                vision, and the power of emotion <br> across every</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Services Section -->

    <!-- Testimonial Section Two -->
    <section class="testimonial-section-two">
        <div class="pattern-layer" style="background-image: url({{ asset('bloxic/images/background/pattern-5.png') }})">
        </div>
        <div class="auto-container">
            <div class="inner-container">
                <span class="dott"></span>

                <div class="single-item-carousel owl-carousel owl-theme">

                    <!-- Testimonial Block Two -->
                    <div class="testimonial-block-two">
                        <div class="inner-box">
                            <h3>testimonials</h3>
                            <div class="text">The other hand we denounce with righteou indg ation and dislike men who
                                are so beguiled and demorali ed by the of pleasure of the moment.Dislike men who are so
                                beguiled demoraliz worlds ed by the charms of pleasure of the moment. Lorem ipsum dolor sit
                            </div>
                            <div class="designation"><span>Foqrul Saheb</span> Senior Artist Developer</div>
                        </div>
                    </div>

                    <!-- Testimonial Block Two -->
                    <div class="testimonial-block-two">
                        <div class="inner-box">
                            <h3>testimonials</h3>
                            <div class="text">The other hand we denounce with righteou indg ation and dislike men who
                                are so beguiled and demorali ed by the of pleasure of the moment.Dislike men who are so
                                beguiled demoraliz worlds ed by the charms of pleasure of the moment. Lorem ipsum dolor sit
                            </div>
                            <div class="designation"><span>Foqrul Saheb</span> Senior Artist Developer</div>
                        </div>
                    </div>

                    <!-- Testimonial Block Two -->
                    <div class="testimonial-block-two">
                        <div class="inner-box">
                            <h3>testimonials</h3>
                            <div class="text">The other hand we denounce with righteou indg ation and dislike men who
                                are so beguiled and demorali ed by the of pleasure of the moment.Dislike men who are so
                                beguiled demoraliz worlds ed by the charms of pleasure of the moment. Lorem ipsum dolor sit
                            </div>
                            <div class="designation"><span>Foqrul Saheb</span> Senior Artist Developer</div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- End Testimonial Section Two -->

    <!-- Brand Section -->
    <section class="brand-section">
        <div class="outer-container">
            <div class="animation_mode">
                <h1>Design. <span>Brand</span>. <strong>Quality</strong></h1>
                <img src="{{ asset('bloxic/images/icons/icon-1.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/feature.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/icon-2.png') }}" alt="" />
                <h1>Design. <span>Brand</span>. <strong>Quality</strong></h1>
                <img src="{{ asset('bloxic/images/icons/icon-1.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/feature.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/icon-2.png') }}" alt="" />
                <h1>Design. <span>Brand</span>. <strong>Quality</strong></h1>
                <img src="{{ asset('bloxic/images/icons/icon-1.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/feature.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/icon-2.png') }}" alt="" />
                <h1>Design. <span>Brand</span>. <strong>Quality</strong></h1>
                <img src="{{ asset('bloxic/images/icons/icon-1.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/feature.png') }}" alt="" />
                <img src="{{ asset('bloxic/images/icons/icon-2.png') }}" alt="" />
            </div>
        </div>
    </section>
    <!-- End Brand Section -->
@endsection
