@extends('frontend.layouts.app')

<title> বিজ্ঞাপন | Newsnarayanganjbd</title>

@section('content')

    @include('frontend.layouts.menus')

    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ URL::to('/') }}">হোম</a></li>
                        <li>বিজ্ঞাপন</a></li>
                    </ol>
                </div><!-- Col end -->
            </div><!-- Row end -->
        </div><!-- Container end -->
    </div><!-- Page title end -->

    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    
                    <div class="single-post">

                        {!! $site_info->advertise_ino ?? '' !!}
                        
                    </div><!-- Single post end -->

                </div><!-- Content Col end -->

            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- First block end -->





@endsection