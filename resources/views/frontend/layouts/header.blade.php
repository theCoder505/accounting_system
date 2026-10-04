<?php 
    $site_info = App\Models\Siteinfo::first();
    $site_image = App\Models\SiteImage::first();
    $clientId = Session::get('clientId');
    $services = App\Models\Service::where('status', 1)->get();
?>

    <header class="page_header ds">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-3 col-11">
                    <a href="{{URL::to('/')}}" class="logo text-center">
                        <img src="{{asset($site_image->logo)}}" alt="{{$site_info->site_name}}">
                    </a>
                </div>
                <div class="col-xl-8 col-lg-6 col-1 text-sm-center">
                    <!-- main nav start -->
                    <nav class="top-nav">
                        <ul class="nav sf-menu">

                            <li class="active">
                                <a href="{{URL::to('/')}}">Home</a>
                            </li>
                            <li>
                                <a href="{{ route('aboutus') }}">About</a>
                            </li>
                            <li>
                                <a href="#">Services</a>
                                <ul>

                                    @foreach($services as $item)
                                    <li>
                                        <a href="{{ route('service', $item->slug) }}">{{$item->name}}</a>
                                    </li>
                                    @endforeach
                                
                                </ul>
                            </li>
                            <!-- blog -->

                            <!-- gallery -->
                            <li>
                                <a href="{{ route('works') }}">Works</a>
                            </li>
                            <!-- eof Gallery -->

                           

                            {{-- <li>
                                <a href="#">Blog</a>
                            </li> --}}
                            <!-- eof blog -->

                            <li>
                                <a href="{{ route('contactus') }}">Contacts</a>
                            </li>
                            <!-- eof contacts -->


                            <li>
                                @if($clientId)

                                    <a href="{{ route('client.dashboard') }}">Dashboard</a>

                                @else

                                    <a href="{{ route('client.login') }}">Login</a>
                                
                                @endif
                                
                            </li>
                            <!-- eof login -->

                            <li>
                                <a href="{{ route('enquiry') }}">Enquiry</a>
                            </li>
                       

                            <!-- contacts -->

                        </ul>

                    </nav>
                    <!-- eof main nav -->
                </div>
                <div
                    class="col-xl-2 col-lg-3 text-lg-left text-xl-right d-none d-lg-block">
                    <div class="header_phone">
                        <h6>
                            <a href="tel:+88{{$site_info->phone}}"><span>+88</span>{{$site_info->phone}}</a>
                        </h6>
                    </div>
                </div>
                {{-- <div class="search-box">
                    <input type="text" name="search" placeholder="search keyword"
                        class="search-text">
                    <a href="#" class="search-btn">
                        <i class="fa fa-search"></i>
                    </a>
                </div> --}}
            </div>
        </div>
        <span class="toggle_menu">
            <span></span>
        </span>
    </header>

<span class="toggle_menu_side header-slide">
    <span></span>
</span>