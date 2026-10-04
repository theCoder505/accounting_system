@extends('frontend.layouts.app')
<title> Home - {{ config('app.name', 'Laravel') }}</title>
@section('content')

    <section class="page_slider main_slider">
        <div class="flexslider" data-nav="true" data-dots="false">
            <ul class="slides">
                <li class="ds text-center slide1">
                    <span class="flexslider-overlay"></span>
                    <span class="embed-responsive embed-responsive-16by9">
                        <iframe
                            src="https://www.youtube.com/embed/UBufeh1yv2c?feature=oembed&amp;;showinfo=0&amp;;autoplay=1&amp;;controls=0&amp;;mute=1&amp;;loop=1&amp;;playlist=UBufeh1yv2c"
                            allowfullscreen></iframe>
                    </span>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 itro_slider">
                                <div class="intro_layers_wrapper">
                                    <div class="intro_layers">
                                        <div class="intro_layer" data-animation="fadeIn">
                                            <p class="text-uppercase intro_after_featured_word">welcome to</p>
                                        </div>

                                        <div class="intro_layer" data-animation="slideRight">
                                            <h2 class="text-uppercase intro_featured_word">
                                                it agency
                                            </h2>
                                        </div>
                                        <div class="intro_layer" data-animation="fadeIn">
                                            <h3 class="intro_before_featured_word">
                                                <span class="color-main2">Web Design & Development</span>,
                                                <span class="color-main3">Marketing</span> &
                                                <span class="color-main4">Branding</span>
                                            </h3>
                                        </div>
                                        <div class="intro_layer page-bottom" data-animation="expandUp">
                                            <a class="btn btn-maincolor" href="#">Get Started</a>
                                        </div>
                                    </div>
                                    <!-- eof .intro_layers -->
                                </div>
                                <!-- eof .intro_layers_wrapper -->
                            </div>
                            <!-- eof .col-* -->
                        </div>
                        <!-- eof .row -->
                    </div>
                    <!-- eof .container -->
                </li>
                <li class="ds text-center slide2">
                    <span class="flexslider-overlay"></span>
                    <img src="{{ asset('assets/frontend/') }}/images/slide_02.jpg" alt>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 itro_slider">
                                <div class="intro_layers_wrapper">
                                    <div class="intro_layers">
                                        <div class="intro_layer" data-animation="fadeIn">
                                            <h3 class="text-lowercase intro_before_featured_word">
                                                Online
                                            </h3>
                                        </div>
                                        <div class="intro_layer" data-animation="fadeIn">
                                            <h2 class="text-uppercase intro_featured_word">
                                                Marketing
                                            </h2>
                                        </div>
                                        <div class="intro_layer" data-animation="pullDown">
                                            <p class="text-uppercase intro_after_featured_word">Solutions</p>
                                        </div>
                                        <div class="intro_layer page-bottom" data-animation="expandUp">
                                            <a class="btn btn-maincolor" href="#">Get Started</a>
                                        </div>
                                    </div>
                                    <!-- eof .intro_layers -->
                                </div>
                                <!-- eof .intro_layers_wrapper -->
                            </div>
                            <!-- eof .col-* -->
                        </div>
                        <!-- eof .row -->
                    </div>
                    <!-- eof .container -->
                </li>
                <li class="ds text-center slide3">
                    <img src="{{ asset('assets/frontend/') }}/images/slide_03.jpg" alt>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 itro_slider">
                                <div class="intro_layers_wrapper">
                                    <div class="intro_layers">
                                        <div class="intro_layer" data-animation="fadeInRight">
                                            <h2 class="text-uppercase intro_featured_word light">
                                                Modern
                                            </h2>
                                        </div>
                                        <div class="intro_layer" data-animation="fadeIn">
                                            <h2 class="text-uppercase intro_featured_word bold">
                                                Marketing & design
                                            </h2>
                                        </div>
                                        <div class="intro_layer" data-animation="fadeIn">
                                            <h2 class="text-uppercase intro_featured_word">
                                                That works
                                            </h2>
                                        </div>

                                        <div class="intro_layer page-bottom" data-animation="expandUp">
                                            <a class="btn btn-maincolor" href="#">Get Started</a>
                                            <a class="btn btn-outline-maincolor" href="#">our folio</a>
                                        </div>
                                    </div>
                                    <!-- eof .intro_layers -->
                                </div>
                                <!-- eof .intro_layers_wrapper -->
                            </div>
                            <!-- eof .col-* -->
                        </div>
                        <!-- eof .row -->
                    </div>
                    <!-- eof .container -->
                </li>

            </ul>
        </div>
        <!-- eof flexslider -->
        <div class="flexslider-bottom d-none d-xl-block">
            <a href="#about" class="mouse-button animated floating"></a>
        </div>
    </section>
    <div class="divider-10 d-block d-sm-none"></div>
    <section class="s-pt-30 s-pt-lg-50 s-pt-xl-25 ls about-home" id="about">
        <div class="divider-5 d-none d-xl-block"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                    <div class="main-content text-center">
                        <div class="img-wrap text-center">
                            <img src="{{ asset('assets/frontend/') }}/img/vertical_line.png" alt>
                            <div class="divider-35"></div>
                        </div>
                        <h5>
                            We are the one of the most effective Web Development Company
                        </h5>
                        <p>
                            Getting online is easy. Succeeding online is a different story. You’ll
                            need more than just a beautiful website to stand out these days.
                            <strong>Online marketing solutions.</strong> Conversion-based web
                            design coupled with a lead generating marketing plan, your online
                            success is inevitable.
                        </p>
                        <div class="divider-30"></div>
                        <div class="img-wrap text-center">
                            <img src="{{ asset('assets/frontend/') }}/img/vertical_line.png" alt>
                        </div>
                        <div>
                            <div class="divider-40"></div>
                            <button type="button" class="btn btn-outline-maincolor">Get
                                Started</button>
                            <div class="divider-40"></div>
                        </div>
                        <div class="img-wrap text-center">
                            <img src="{{ asset('assets/frontend/') }}/img/vertical_line.png" alt>
                        </div>
                        <div class="divider-10 d-none d-xl-block"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="divider-10 d-block d-sm-none"></div>
    </section>

    <section class="s-pt-30 s-pb-3 service-item2 ls animate" id="services" data-animation="fadeInUp">
        <div class="container">
            <div class="row c-mb-50 c-mb-md-60">
                <div class="d-none d-lg-block divider-20"></div>


                @foreach ($services as $item)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="vertical-item text-center">
                        <div class="item-media">
                            <img src="{{ asset($item->image) }}" alt="{{$item->name}}">
                        </div>
                        <div class="item-content">
                            <h6>
                                <a href="{{ route('service', $item->slug) }}">{{$item->name}}</a>
                            </h6>

                            <p>
                                {!! $item->short_description !!}
                            </p>

                        </div>
                    </div>
                </div>
                @endforeach
            
              
                <!-- .col-* -->
            </div>
            <div class="pink-line text-center">
                <img src="{{ asset('assets/frontend/') }}/img/pink_line_big.png" alt>
            </div>
        </div>
    </section>

    <section class="s-pt-100 s-pt-lg-130 ds process-part skew_right s-parallax top_white_line_big overflow-visible"
        id="steps">
        <div class="container">
            <div class="divider-65"></div>
            <div class="row align-items-center c-mb-20 c-mb-lg-60">
                <div class="col-12 col-lg-4">
                    <div class="step-left-part text-right">
                        <h2 class="step-title">
                            <span class="color-main">01</span>Strategy
                        </h2>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="step-center-part text-center">
                        <img src="{{ asset('assets/frontend/') }}/images/step_img_1.jpg" alt>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="step-right-part">
                        <p class="step-text">We define your competition and target audience.
                            Discover what is working in your online industry, then design your
                            website accordingly.</p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center right c-mb-20 c-mb-lg-60">
                <div class="col-12 col-lg-4  order-lg-3">
                    <div class="step-left-part">
                        <h2 class="step-title color1">
                            <span class="color-main2">02</span>Design
                        </h2>
                    </div>
                </div>
                <div class="col-12 col-lg-4 order-lg-2">
                    <div class="step-center-part text-center">
                        <img src="{{ asset('assets/frontend/') }}/images/step_img_2.jpg" alt>
                    </div>
                </div>
                <div class="col-12 col-lg-4 order-lg-1 text-right">
                    <div class="step-right-part ">
                        <p class="step-text">Color scheme, layout, sitemap, and style. We will
                            bring your brand to life with a one of a kind masterpiece, built just
                            for you.</p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center c-mb-20 c-mb-lg-60">
                <div class="col-12 col-lg-4">
                    <div class="step-left-part text-right part3">
                        <h2 class="step-title">
                            <span class="color-main3">03</span>Develop
                        </h2>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="step-center-part text-center">
                        <img src="{{ asset('assets/frontend/') }}/images/step_img_3.jpg" alt>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="step-right-part">
                        <p class="step-text">We turn your ideas into a reality. &our website is
                            placed on a "development server" where you get to watch the whole
                            process, live.</p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center right c-mb-20 c-mb-lg-60">
                <div class="col-12 col-lg-4  order-lg-3">
                    <div class="step-left-part part4">
                        <h2 class="step-title color1">
                            <span class="color-main4">04</span>Support
                        </h2>
                    </div>
                </div>
                <div class="col-12 col-lg-4 order-lg-2">
                    <div class="step-center-part text-center last">
                        <img src="{{ asset('assets/frontend/') }}/images/step_img_2.jpg" alt>
                    </div>
                </div>
                <div class="col-12 col-lg-4 order-lg-1 text-right">
                    <div class="step-right-part ">
                        <p class="step-text">This is where you go live, to the world. Design,
                            marketing, and maintenance; we'll be at your side for the life of your
                            site.</p>
                    </div>
                </div>
            </div>
            <div class="divider-10 d-block d-sm-none"></div>
            <div class="img-wrap text-center">
                <img src="{{ asset('assets/frontend/') }}/img/vertical_line2.png" alt>
            </div>
            <div class=" white-button text-center">
                <a class="btn white-btn" href="#">Get Started</a>
            </div>
            <div class="divider-30 d-none d-xl-block"></div>
        </div>
    </section>

    <section class="s-pt-75 s-pt-xl-50 gallery-carousel main-gallery container-px-0" id="gallery">
        <div class="container-fluid">
            <div class="img-wrap text-center">
                <img src="{{ asset('assets/frontend/') }}/img/vertical_line.png" alt>
                <div class="divider-40 d-block d-sm-none"></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-md-10 col-xl-6">
                            <div class="filters gallery-filters small-text text-lg-right">
                                <a href="#" data-filter="*" class="active selected">All</a>

                                @foreach ($services as $item)
                                    <a href="#" data-filter=".image-{{ $item->id }}">{{ $item->name }}</a>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="owl-carousel gallery-owl-nav" data-autoplay="false" data-responsive-lg="5"
                        data-responsive-md="3" data-responsive-sm="3" data-responsive-xs="2" data-nav="true"
                        data-dots="false" data-filters=".gallery-filters" data-margin="0" data-loop="true">


                        @foreach ($services as $item)
                            <?php
                            $works = App\Models\Work::where('service_id', $item->id)
                                ->where('status', 1)
                                ->get();
                            ?>
                            @foreach ($works as $work)
                                <div
                                    class="vertical-item item-gallery content-absolute text-center ds image-{{ $item->id }}">
                                    <div class="item-media">
                                        <img src="{{ asset($work->image) }}" alt="{{ $work->name }}">
                                        <div class="media-links">

                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <h6>
                                            <a href="{{ $work->link ?? '#' }}" target="_blank">{{ $work->name }}</a>
                                        </h6>
                                        <div class="small-text link-a">
                                            <a href="{{ route('service', $item->slug) }}">{{ $item->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                    <!-- .owl-carousel-->
                </div>
            </div>
        </div>
    </section>



    <section class="ls ms book-item s-pb-30 s-pb-lg-25">
        <div class="corner corner-light"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="text-block text-center">
                        <div class="btn-book-section overflow-visible">
                            <a href="#" class="btn btn-maincolor">Get Started</a>
                        </div>
                        <div class="img-wrap text-center">
                            <img src="{{ asset('assets/frontend/') }}/img/vertical_line.png" alt>
                            <div class="divider-35"></div>
                        </div>
                        <h5>
                            B2B Marketing & Web Design
                            <br> Resources
                        </h5>
                        <p>
                            B2B client acquisition is not the same as B2C– a B2B website, brand
                            messaging and content marketing play a much different role. We
                            understand the B2B marketing and sales funnel and the tactics that
                            generate and nurture ideal client leads.
                        </p>
                        <div class="divider-30"></div>
                        <div class="img-wrap text-center">
                            <img src="{{ asset('assets/frontend/') }}/img/vertical_line.png" alt>
                        </div>
                    </div>
                </div>
                <div class="divider-40"></div>
                <div class="row c-gutter-30 c-mb-30 c-mb-lg-0 text-center book">
                    <div class="col-12 col-lg-4">
                        <div class="stage book-1 ls">
                            <img src="{{ asset('assets/frontend/') }}/images/book-1.png" alt="#">
                            <div class="info">
                                <header>
                                    <h6>
                                        <a href="#">Annual Report
                                            <br>2017-2018</a>
                                    </h6>
                                </header>
                                <p>
                                    At vero eos et accusam et justo duo dolores et ea rebum. Stet clita
                                    kasd gubergren.
                                </p>
                                <p class="small-text link-a">
                                    <a href="#">Buy It Now!</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="stage book-2 ds">
                            <img src="{{ asset('assets/frontend/') }}/images/book-2.png" alt="#">
                            <div class="info">
                                <header>
                                    <h6>
                                        <a href="#">Tools of Trading: Modern Marketing</a>
                                    </h6>
                                </header>
                                <p>
                                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
                                    numy eirmod.
                                </p>
                                <p class="small-text link-a">
                                    <a href="#">Buy It Now!</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="stage book-3 ls">
                            <img src="{{ asset('assets/frontend/') }}/images/book-3.png" alt="#">
                            <div class="info">
                                <header>
                                    <h6>
                                        <a href="#">Business Magazine: Design</a>
                                    </h6>
                                </header>
                                <p>
                                    Et accusam et justo duo dolores et ea rebum. Stet clita kasd
                                    gubergren.
                                </p>
                                <p class="small-text link-a">
                                    <a href="#">Buy It Now!</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="divider-30"></div>
                <div class="text-center img-wrap col-md-12">
                    <div>
                        <img src="{{ asset('assets/frontend/') }}/img/vertical_line.png" alt>
                    </div>
                    <div class="divider-40"></div>
                    <a href="#" class="btn btn-outline-maincolor">Get Started</a>
                    <div class="divider-40"></div>
                    <div>
                        <img src="{{ asset('assets/frontend/') }}/img/vertical_line.png" alt>
                    </div>
                </div>
            </div>
            <div class="divider-10"></div>
        </div>
    </section>

    <section class="ls ms blog-post-carousel">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel" data-responsive-lg="4" data-responsive-md="3" data-responsive-sm="2"
                        data-responsive-xs="1" data-nav="false" data-dots="false" data-loop="true" data-margin="4">

                        @foreach($first_four_reviews as $item)
                        <article class="box text-center">
                            <div class="item-content">
                                <p class="small-text">
                                    <a href="#"> {{ Carbon\Carbon::parse($item->date)->format('d F Y') }} </a>
                                </p>
                                <h6>
                                    <a href="#">{{$item->short_description}}</a>
                                </h6>
                                <div class="post-author">
                                    <img src="{{ asset($item->image) }}" alt>
                                    <p>
                                        <a href="#">{{$item->name}}</a>
                                    </p>
                                </div>
                            </div>
                            <!-- .item-content -->
                        </article>
                        @endforeach

                       
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section
        class="s-pt-130 s-pb-15 s-pb-md-50 s-pt-xl-100 s-pb-lg-30 overflow-visible s-parallax testimonials-sliders main-testimonials ds"
        id="testimonials">
        <div class="corner ls ms"></div>
        <div class="container">
            <div class="row c-mt-30 c-mt-md-0">
                <div class="divider-20"></div>
                <div class="text-center img-wrap line col-md-12">
                    <img src="{{ asset('assets/frontend/') }}/img/vertical_line2.png" alt>
                </div>
                <div class="divider-40 d-none d-md-block"></div>
                <div class="col-md-12">
                    <div class="owl-carousel" data-autoplay="false" data-responsive-lg="1" data-responsive-md="1"
                        data-responsive-sm="1" data-nav="false" data-dots="true" id="quote">

                        @foreach($next_four_reviews as $item)
                        <div class="quote-item">
                            <div class="quote-image">
                                <img src="{{ asset($item->image) }}" alt>
                            </div>
                            <p class="small-text author-job">
                                {{$item->designation}}
                            </p>
                            <h5>
                                <a href="#">{{$item->name}}</a>
                            </h5>
                            <p>
                                <em class="big">
                                    {{$item->short_description}}
                                </em>
                            </p>
                        </div>
                        @endforeach
                    </div>
                    <!-- .testimonials-slider -->
                </div>
                <div class="divider-55 d-none d-md-block"></div>
                <div class="text-center img-wrap col-md-12">
                    <img src="{{ asset('assets/frontend/') }}/img/vertical_line2.png" alt>
                </div>
                <div class="divider-10 d-none d-md-block"></div>
            </div>
        </div>
        <div class="testimonials-btn text-center">
            <a href="#quote" class="btn-maincolor">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
        <div class="corner corner-light"></div>
    </section>

    <section class="s-pt-130 s-pt-md-50 ls text-section">
        <div class="divider-30"></div>
        <div class="container">
            <div class="row">
                <div class="text-center col-md-12 justify-content-center text-block">
                    <img src="{{ asset('assets/frontend/') }}/img/vertical_line.png" alt>
                    <div class="divider-35"></div>
                    <div class="content">
                        <h1>
                            Lets Get Started
                            <br> Your Project
                        </h1>
                        <p>
                            We’ll help to achieve your goals and to grow business
                        </p>
                        <div class="divider-30"></div>
                    </div>
                    <img src="{{ asset('assets/frontend/') }}/img/vertical_line.png" alt>
                    <div>
                        <div class="divider-40"></div>
                        <a href="#" class="btn btn-outline-maincolor">Let’s Talk!</a>
                        <div class="divider-30"></div>
                    </div>
                    <div class="img-wrap overflow-visible">
                        <img src="{{ asset('assets/frontend/') }}/img/vertical_line.png" alt>
                        <div class="divider-5 d-none d-xl-block"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="s-pt-50 s-pb-100 s-pt-lg-30 s-pb-lg-75 ls ms teaser-contact-icon main-icon s-parallax" id="contact">
        <div class="corner corner-inverse"></div>
        <div class="text-center img-wrap col-md-12">
            <img src="{{ asset('assets/frontend/') }}/img/dark_line_short.png" alt>
        </div>
        <div class="container">
            <div class="divider-10 d-none d-xl-block"></div>
            <div class="row c-mb-50 c-mb-lg-0">
                <div class="col-lg-4 text-center">
                    <div class="border-icon">
                        <div class="teaser-icon">
                            <img src="{{ asset('assets/frontend/') }}/images/icon1.png" alt>
                        </div>
                    </div>
                    <h6>
                        Call Us
                    </h6>
                    <p>
                        <strong>Support:</strong> <a href="tel:{{ $site_info->phone }}">+88{{ $site_info->phone }}</a>
                    </p>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="border-icon">
                        <div class="teaser-icon">
                            <img src="{{ asset('assets/frontend/') }}/images/icon3.png" alt>
                        </div>
                    </div>
                    <h6>
                        Write Us
                    </h6>
                    <p>
                        <a href="mailto:{{ $site_info->email }}" class="__cf_email__">{{ $site_info->email }}</a>
                        <br>
                    </p>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="border-icon">
                        <div class="teaser-icon">
                            <img src="{{ asset('assets/frontend/') }}/images/icon2.png" alt>
                        </div>
                    </div>
                    <h6>
                        Visit Us
                    </h6>
                    <p>
                        {{ $site_info->address }}
                    </p>
                </div>
            </div>
            <div class="divider-30 d-none d-lg-block"></div>
            <div class="text-center img-wrap col-md-12 layout-2">
                <img src="{{ asset('assets/frontend/') }}/img/dark_line_short.png" alt>
            </div>
        </div>
        <div class="divider-10"></div>
    </section>

@stop
