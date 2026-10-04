@extends('frontend.layouts.app')
<title> Contact us - {{ config('app.name', 'Laravel') }}</title>
@section('content')

    <section class="page_title ls s-py-50 corner-title ls invise overflow-visible">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>Contact us</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ URL::to('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Pages</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Contact us
                        </li>
                    </ol>
                    <div class="divider-15 d-none d-xl-block"></div>
                </div>
            </div>
        </div>
    </section>


    <section class="ls s-pt-30 s-pb-100 s-pb-md-130 s-py-lg-100 contact2">
        <div class="divider-15 d-none d-xl-block"></div>
        <div class="container">
            <div class="row c-mb-30 c-mb-md-50">
                <div class="col-md-4 text-center">
                    <div class="border-icon">
                        <div class="teaser-icon">
                            <img src="images/icon1.png" alt>
                        </div>
                    </div>
                    <h6>
                        Call Us
                    </h6>
                    <p class="teaser-content">
                        <strong>Support:</strong> <a href="tel:{{ $site_info->phone }}">+88{{ $site_info->phone }}</a>
                    </p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="border-icon">
                        <div class="teaser-icon">
                            <img src="images/icon3.png" alt>
                        </div>
                    </div>
                    <h6>
                        Write Us
                    </h6>
                    <p class="teaser-content">
                        <a href="mailto:{{ $site_info->email }}" class="__cf_email__">{{ $site_info->email }}</a>
                        <br>
                    </p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="border-icon">
                        <div class="teaser-icon">
                            <img src="images/icon2.png" alt>
                        </div>
                    </div>
                    <h6>
                        Visit Us
                    </h6>
                    <p class="teaser-content">
                        {{ $site_info->address }}
                    </p>
                </div>
            </div>
            <div class="divider-60 d-none d-xl-block"></div>
            <div class="row">
                <div class="col-lg-12 ">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="" method="post" action="{{ route('submit_message') }}">
                        @csrf

                        <div class="row c-gutter-20">

                            <div class="col-12 col-md-6">
                                <div class="form-group has-placeholder">
                                    <label for="name">Full Name
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" aria-required="true" size="30" value name="name"
                                        id="name" class="form-control text-left" placeholder="Full Name*">
                                </div>
                                <div class="form-group has-placeholder ">
                                    <label for="email">Email address

                                    </label>
                                    <input type="email" aria-required="true" size="30" value name="email"
                                        id="email" class="form-control text-left" placeholder="Email Address">
                                </div>
                                <div class="form-group has-placeholder">
                                    <label for="phone_number">Phone Number
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" aria-required="true" size="30" value name="phone_number"
                                        id="phone_number" class="form-control text-left" placeholder="Phone Number*">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">

                                <div class="form-group has-placeholder">
                                    <label for="message">Message</label>
                                    <textarea aria-required="true" rows="6" cols="45" name="message" id="message"
                                        class="form-control text-left" placeholder="Your Message*"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-center">
                                    <button type="submit" id="" name="" class="btn btn-maincolor">Send
                                        Message</button>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
                <!--.col-* -->

                <div class="divider-80 d-none d-xl-block"></div>

            </div>
        </div>
    </section>




@stop
