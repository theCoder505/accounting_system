    <div class="main-nav clearfix">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-expand-lg col">
                    <div class="site-nav-inner float-left">
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
               </button>
               <!-- End of Navbar toggler -->

                        <div id="navbarSupportedContent" class="collapse navbar-collapse navbar-responsive-collapse">
                            <ul class="nav navbar-nav">
                                <li class="nav-item dropdown active">
                                    <a href="{{URL::to('/')}}" class="nav-link" data-toggle="dropdown">হোম</a>
                                </li>

                                <?php
                                    $categories = App\Models\Category::orderBy('serial_no', 'asc')->where('parent_id', 0)->where('status', 1)->get();
                                ?>
                                @foreach($categories as $category)
                                <?php
                                    $sub_categories = App\Models\Category::where('parent_id', $category->id)->where('status', 1)->get();
                                ?>

                                <li class="dropdown">
                                    <a href="{{route('/', [$category->slug])}}" class="dropdown-toggle" >{{$category->name_bn}} 
                                        @if(count($sub_categories)>0)
                                        <i class="fa fa-angle-down"></i>
                                        @endif
                                    </a>
                                    @if(count($sub_categories)>0)
                                    <ul class="dropdown-menu" role="menu">
                                        @foreach($sub_categories as $sub_category)
                                        <?php
                                            $pro_sub_categories = App\Models\Category::where('parent_id', $sub_category->id)->where('status', 1)->get();
                                        ?>

                                        @if(count($pro_sub_categories)>0)
                                        <li class="dropdown-submenu">
                                        @else
                                        <li class="">
                                        @endif
                                            <a href="{{route('/', [$sub_category->slug])}}">{{$sub_category->name_bn}}</a>

                                            @if(count($pro_sub_categories)>0)
                                            <ul class="dropdown-menu">

                                                @foreach($pro_sub_categories as $pro_sub_category)
                                                <li><a href="{{route('/', [$pro_sub_category->slug])}}">{{$pro_sub_category->name_bn}}</a></li>
                                                @endforeach

                                            </ul>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul><!-- End dropdown -->
                                    @endif
                                </li><!-- Features menu end -->
                                @endforeach
                            </ul><!--/ Nav ul end -->
                        </div><!--/ Collapse end -->

                    </div><!-- Site Navbar inner end -->
                </nav><!--/ Navigation end -->

                @include('frontend.layouts.searchbox')
            </div><!--/ Row end -->
        </div><!--/ Container end -->

    </div><!-- Menu wrapper end -->


