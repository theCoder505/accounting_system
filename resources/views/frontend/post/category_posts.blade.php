@extends('frontend.layouts.app')

<title> {{$category->name}} | Newsnarayanganjbd</title>

@section('head')
    <meta name="title" content="{{$category->meta_title}}">
    <meta name="description" content="{{$category->meta_des}}">
    <meta property="keywords" content="{{$category->meta_keywords}}" />
    <meta property="type" content="category" />
    <meta property="site_name" content="{{$site_info->site_name}}" />
    <meta property="image" content="{{$category->meta_image}}" />

    <meta property="og:url" content="https://newsnarayanganjbd.com/{{$category->slug}}" />
    <meta property="og:type" content="category" />
    <meta property="og:title" content="{{$category->meta_title}}" />
    <meta property="og:description" content="{{$category->meta_des}}" />
    <meta property="og:keywords" content="{{$category->meta_keywords}}" />
    <meta property="og:image" content="{{$category->meta_image}}" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@newsnarayanganjbd" />
    <meta name="twitter:creator" content="@newsnarayanganjbd" />
    <meta property="twitter:url" content="https://newsnarayanganjbd.com/{{$category->slug}}" />
    <meta property="twitter:title" content="{{$category->meta_title}}" />
    <meta property="twitter:description" content="{{$category->meta_des}}" />
    <meta property="twitter:keywords" content="{{$category->meta_keywords}}" />
    <meta property="twitter:image" content="{{$category->meta_image}}" />
@endsection

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
                        @if(isset($category->parent->name_bn))
                        <li><a href="{{route('/', [$category->parent->slug])}}">{{$category->parent->name_bn ?? ''}}</a></li>
                        @endif
                        <li>{{$category->name_bn ?? ''}}</li>
                    </ol>
                </div><!-- Col end -->
            </div><!-- Row end -->
        </div><!-- Container end -->
    </div><!-- Page title end -->

    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">

                    <div class="block category-listing category-style2">
                        <h3 class="block-title"><span>{{$category->name_bn ?? ''}}</span></h3>

                        @if(isset($latest_news))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="post-block-style top-larget-post clearfix">
                                    <div class="post-thumb">
                                        <a href="{{route('/', [$latest_news->slug])}}">
                                            <img class="img-fluid" src="{{asset($latest_news->thumb_image)}}" alt="{{$latest_news->title}}" />
                                        </a>
                                    </div>
                                    <?php  
                                        $post_categories = App\Models\PostCategory::where('post_id', $latest_news->id)->get();
                                    ?>

                                    <!-- @foreach($post_categories as $post_category)
                                        <?php  
                                            $category = App\Models\Category::where('id', $post_category->category_id)->first();
                                        ?>
                                        <a class="post-cat" href="{{route('/', [$category->slug])}}">{{$category->name_bn}}</a>
                                    @endforeach -->
                                    <div class="post-content">
                                        <h2 class="post-title title-large">
                                            <a href="{{route('/', [$latest_news->slug])}}">{{$latest_news->title}}</a>
                                        </h2>
                                        <div class="post-meta">
                                            <span class="post-author"><a href="#">{{$latest_news->author->name ?? ''}}</a></span>
                                            <span class="post-date">
                                                <?php  
                                                    $date = Carbon\Carbon::parse($latest_news->created_at);
                                                    $bangla_date = bangla_date(strtotime($date),"en"); // OUTPUT ২৬ মার্চ ২০১৯

                                                ?>
                                                {{$bangla_date}}
                                            </span>
                                            <span class="post-comment pull-right"><i class="fa fa-eye"></i>
                                            <a href="#" class="comments-link"><span>{{$latest_news->total_view ?? 0}}</span></a></span>
                                        </div>
                                        <p>{!! Str::limit( $latest_news->small_description, 300 ) !!}</p>
                                    </div><!-- Post content end -->
                                </div><!-- Post Block style end -->
                            </div><!-- Col end -->
                        </div><!-- Top Big post end -->
                        @endif

                        @foreach($posts as $post)

                        <?php  
                            $post_categories = App\Models\PostCategory::where('post_id', $post->id)->get();
                        ?>

                        <div class="post-block-style post-list clearfix">
                            <div class="row">
                                <div class="col-lg-5 col-md-6">
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

                                <div class="col-lg-7 col-md-6">
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
                                        </div>
                                        <p>{!! Str::limit( $post->small_description, 300 ) !!}</p>
                                    </div><!-- Post content end -->
                                </div><!-- Post col end -->
                            </div><!-- 2nd row end -->
                        </div><!-- 2nd Post list end -->
                        @endforeach

                    </div><!-- Block Technology end -->

                    <div class="paging">
                        {{ $posts->links() }}
                        <!-- <ul class="pagination">
                          <li class="active"><a href="#">1</a></li>
                          <li><a href="#">2</a></li>
                          <li><a href="#">3</a></li>
                          <li><a href="#">4</a></li>
                          <li><a href="#">»</a></li>
                          <li>
                            <span class="page-numbers">Page 1 of 2</span>
                          </li>
                        </ul> -->
                    </div>

                </div><!-- Content Col end -->

                @include('frontend.layouts.sidebar')

            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- First block end -->



@endsection
