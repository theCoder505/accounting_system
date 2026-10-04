@extends('frontend.layouts.app')

<title> এলাকার খবর  | Newsnarayanganjbd</title>



@section('content')

<style>
    .w-5{
        width: 30px;
    }
    .flex.justify-between.flex-1{
        display: none;
    }

/*    span>.leading-5:hover{
        color: #fff;
        background: red;
        border: 1px solid transparent;
    }
*/

</style>

    @include('frontend.layouts.menus')

    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li><a href="{{URL::to('/')}}">হোম</a></li>
                        <li> {{ $division->name_bn }}   </li>

                        @if(isset($zila))
                        <li> {{ $zila->name_bn }}   </li>
                        @endif

                        @if(isset($upazila))
                        <li> {{ $upazila->name_bn }}   </li>
                        @endif
                    </ol>
                </div><!-- Col end -->
            </div><!-- Row end -->
        </div><!-- Container end -->
    </div><!-- Page title end -->

    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">

                    <div class="block category-listing category-style2">
                        <h3 class="block-title">
                            <span> 
                                {{ $division->name_bn }} 

                                @if(isset($zila))
                                - {{ $zila->name_bn }}
                                @endif

                                @if(isset($upazila))
                                - {{ $upazila->name_bn }}
                                @endif

                            </span>
                        </h3>


                        @foreach($posts as $post)

                        <?php  
                            $post_categories = App\Models\PostCategory::where('post_id', $post->id)->get();
                        ?>

                        <div class="post-block-style post-list clearfix">
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <div class="post-thumb thumb-float-style">
                                        <a href="{{route('/', [$post->slug])}}">
                                            <img class="img-fluid" src="{{asset($post->thumb_image ?? $post->image)}}" alt="{{$post->title}}" />
                                        </a>
                                        <!-- @foreach($post_categories as $post_category)
                                            <?php  
                                                $category = App\Models\Category::where('id', $post_category->category_id)->first();
                                            ?>
                                            <a class="post-cat" href="{{route('/', [$category->slug])}}">{{$category->name_bn}}</a>
                                        @endforeach -->
                                    </div>
                                </div><!-- Img thumb col end -->

                                <div class="col-lg-9 col-md-8">
                                    <div class="post-content">
                                        <h2 class="post-title title-large">
                                            <a href="{{route('/', [$post->slug])}}">{{$post->title}}</a>
                                        </h2>
                                        <div class="post-meta">
                                            <span class="post-author"><a href="#">{{$post->author->name ?? ''}}</a></span>
                                            <span class="post-date">
                                                @include('frontend.layouts.bn_time')
                                            </span>
                                            <span class="post-comment pull-right"><i class="fa fa-eye"></i>
                                            <a href="#" class="comments-link"><span>{{$post->total_view ?? 0}}</span></a></span>
                                            <p>{{ $post->small_description }}</p>
                                        </div>
                                    </div><!-- Post content end -->
                                </div><!-- Post col end -->
                            </div><!-- 2nd row end -->
                        </div><!-- 2nd Post list end -->
                        @endforeach

                    </div><!-- Block Technology end -->


                </div><!-- Content Col end -->


            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- First block end -->



@endsection
