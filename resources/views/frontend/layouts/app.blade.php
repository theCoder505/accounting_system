<!DOCTYPE html>

<html class="no-js">


<head>
  <title>{{ config('app.name', 'Laravel') }} </title>
    <meta charset="utf-8">
    @yield('title')

    @yield('head')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="stylesheet" href="{{asset('assets/frontend/')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/frontend/')}}/css/animations.css">
    <link rel="stylesheet" href="{{asset('assets/frontend/')}}/css/font-awesome.css">
    <link rel="stylesheet" href="{{asset('assets/frontend/')}}/css/main.css" class="color-switcher-link">
    <link rel="stylesheet" href="{{asset('assets/frontend/')}}/css/shop.css" class="color-switcher-link">
    <script src="{{asset('assets/frontend/')}}/js/vendor/modernizr-2.6.2.min.js"></script>

</head>

<body>


    <div class="preloader">
        <div class="preloader_image"></div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" aria-labelledby="search_modal" id="search_modal">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="widget widget_search">
            <form method="get" class="searchform search-form" action="https://html.modernwebtemplates.com/">
                <div class="form-group">
                    <input type="text" value name="search" class="form-control" placeholder="Search keyword"
                        id="modal-search-input">
                </div>
                <button type="submit" class="btn">Search</button>
            </form>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="messages_modal">
        <div class="fw-messages-wrap ls p-normal">


        </div>
    </div>

    <div id="canvas">
        <div id="box_wrapper">

            @include('frontend.layouts.header')

            @yield('content')

            @include('frontend.layouts.footer')


        </div>

        <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="{{asset('assets/frontend/')}}/js/compressed.js"></script>
        <script src="{{asset('assets/frontend/')}}/js/main.js"></script>
        <script src="{{asset('assets/frontend/')}}/js/switcher.js"></script>

</body>


</html>
