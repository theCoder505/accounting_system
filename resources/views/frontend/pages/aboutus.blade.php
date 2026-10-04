@extends('frontend.layouts.app')
<title> About us - {{ config('app.name', 'Laravel') }}</title>
@section('content')

    <section class="page_title ls s-py-50 corner-title ls invise overflow-visible">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>About us</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ URL::to('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Pages</a>
                        </li>
                        <li class="breadcrumb-item active">
                            About us
                        </li>
                    </ol>
                    <div class="divider-15 d-none d-xl-block"></div>
                </div>
            </div>
        </div>
    </section>


    <section class="ls s-pt-30 s-pt-md-50 s-pb-md-10 s-py-lg-50 c-gutter-60 c-mb-30 c-mb-md-50 overflow-visible">
        <div class="divider-65 d-none d-lg-block"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 service-single to_animate animate" data-animation="fadeInRight">
                    {!! $site_info->about_us !!}
                </div>

            </div>
            <div class="divider-10 d-none d-lg-block"></div>
        </div>
    </section>

    <section class="ls s-pt-50 s-pb-130 gallery-title">
        <div class="d-none d-lg-block divider-20"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-md-10 col-xl-12">
                            <div class="filters gallery-filters small-text text-lg-right">
                                <a href="#" data-filter="*" class="active selected">All</a>

                                @foreach ($services as $item)
                                    <a href="#" data-filter=".image-{{ $item->id }}">{{ $item->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row isotope-wrapper masonry-layout c-mb-30" data-filters=".gallery-filters">

                        @foreach ($services as $item)
                            <?php
                            $works = App\Models\Work::where('service_id', $item->id)
                                ->where('status', 1)
                                ->get();
                            ?>
                            @foreach ($works as $work)
                                <div class="col-xl-6 col-md-6 web-design image-{{ $item->id }}">

                                    <div class="vertical-item text-center ls ms">
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

                                </div>
                            @endforeach
                        @endforeach


                    </div>


                </div>
            </div>
        </div>
        <div class="d-none d-lg-block divider-75"></div>
    </section>





@stop
