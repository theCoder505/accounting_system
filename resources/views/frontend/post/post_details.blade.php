@extends('frontend.layouts.app')

<title> {{$post->title}} | newsnarayanganjnet.com</title>


@section('head')

    <meta name="title" content="{{$post->meta_title ?? ''}}">
    <meta name="description" content="{{$post->meta_description ?? ''}}">
    <meta property="keywords" content="{{$post->meta_keywords ?? ''}}"/>
    <meta property="image" content="{{ 'https://newsnarayanganjnet.com/'.$post->image ?? ''}}"/>
    <meta property="type" content="{{$post->meta_title ?? ''}} :Post" />
    <meta property="site_name" content="{{$site_info->site_name}}" />
    <meta property="slug" content="{{ 'https://newsnarayanganjnet.com/'.$post->slug ?? ''}}" />

    <meta property="og:url"           content="{{ 'https://newsnarayanganjnet.com/'.$post->slug ?? ''}}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="{{$post->meta_title ?? ''}}" />
    <meta property="og:description"   content="{{$post->meta_description ?? ''}}" />
    <meta property="og:image"         content="{{ 'https://newsnarayanganjnet.com/'.$post->slug ?? ''}}" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="{{$site_info->site_name}}" />
    <meta name="twitter:creator" content="{{$site_info->site_name}}" />
    <meta property="twitter:url" content="{{ 'https://newsnarayanganjnet.com/'.$post->slug ?? ''}}" />
    <meta property="twitter:title" content="{{$post->meta_title ?? ''}}" />
    <meta property="twitter:description" content="{{$post->meta_description ?? ''}}" />
    <meta property="twitter:keywords" content="{{$post->meta_keywords ?? ''}}" />
    <meta property="twitter:image" content="{{ 'https://newsnarayanganjnet.com/'.$post->image ?? ''}}" />


@endsection

@section('content')


    @include('frontend.layouts.menus')



    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ URL::to('/') }}">হোম</a></li>
                        <li>{{$post->title}}</a></li>
                    </ol>
                </div><!-- Col end -->
            </div><!-- Row end -->
        </div><!-- Container end -->
    </div><!-- Page title end -->

    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    
                    <div class="single-post">


                        @if($post->video_link)
                        <div class="post-media post-featured-image">
                            <iframe  height="450" src="{{ $post->video_link ?? '' }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="w-100"></iframe>
                        </div>

                        
                        @else
                        <div class="post-media post-featured-image">
                            <img src="{{asset($post->image)}}" class="img-fluid w-100" alt="{{$post->title}}">
                        </div>
                       
                        <div class="post-title-area">
                            @foreach($post_categories as $post_category)
                                <?php  
                                    $category = App\Models\Category::where('id', $post_category->category_id)->first();
                                ?>
                                <a class="post-cat" href="{{route('/', [$category->slug])}}">{{$category->name_bn}}</a>
                            @endforeach
                            <h2 class="post-title">
                                {{$post->title}}
                            </h2>
                            <div class="post-meta">
                                <span class="post-author">
                                    <a href="#">{{$post->author->name ?? ''}}</a>
                                </span>
                                <span class="post-date"><i class="fa fa-clock-o"></i>
                                    @include('frontend.layouts.bn_time')
                                </span>
                                <span class="post-hits"><i class="fa fa-eye"></i> {{$post->total_view ?? 0}}</span>
                            </div>
                        </div><!-- Post title end -->

                        <div class="post-content-area">
                            <div class="entry-content">
                        
                               
                                {!! $post->description ?? '' !!}
                                

                            </div><!-- Entery content end -->

                            <div class="tags-area clearfix">
                                <div class="post-tags">
                                <span>এই রকম আরও টপিক:</span>

                                <?php  
                                    $post_tags = App\Models\PostTag::where('post_id', $post->id)->get();
                                ?>

                                @foreach($post_tags as $post_tag)

                                <?php  
                                    $tag = App\Models\Tag::where('id', $post_tag->tag_id)->first();
                                ?>

                                <a href="#"># {{$tag->name_bn ?? ''}}</a>
                                @endforeach
                            </div>
                            </div><!-- Tags end -->

                            <div class="share-items clearfix">
                            <ul class="post-social-icons unstyled">

                                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                <div class="addthis_inline_share_toolbox"></div>
            
                            </ul>
                        </div><!-- Share items end -->

                        </div><!-- post-content end -->
                        @endif
                    </div><!-- Single post end -->



                    <div class="related-posts block">
                        <a href=""><h3 class="block-title"><span>এই বিভাগের আরও খবর</span></h3></a>

                        <div id="latest-news-slide" class="owl-carousel owl-theme latest-news-slide">

            

                            @foreach($related_post as $key => $post)
                            <?php  


                                $post_categories = App\Models\PostCategory::where('post_id', $post->id)->get();
                            ?>
                            <div class="item">
                                <div class="post-block-style clearfix">
                                    <div class="post-thumb">
                                        <a href="{{route('/', [$post->slug])}}"><img class="img-fluid" src="{{asset($post->thumb_image ?? $post->image)}}" alt="{{$post->title}}" /></a>
                                    </div>
                                    <!-- @foreach($post_categories as $post_category)
                                        <?php  
                                            $category = App\Models\Category::where('id', $post_category->category_id)->first();
                                        ?>
                                        <a class="post-cat" href="{{route('/', [$category->slug])}}">{{$category->name_bn}}</a>
                                    @endforeach -->
                                    <div class="post-content">
                                        <h2 class="post-title title-medium">
                                            <a href="{{route('/', [$post->slug])}}">{{$post->title}}</a>
                                        </h2>
                                        <div class="post-meta">
                                            <span class="post-author">
                                                <a href="#">{{$post->author->name ?? ''}}</a>
                                            </span>
                                            <span class="post-date">
                                                
                                                @include('frontend.layouts.bn_time')

                                            </span>
                                        </div>
                                    </div><!-- Post content end -->
                                </div><!-- Post Block style end -->
                            </div><!-- Item 1 end -->
                            @endforeach
                            
                        </div><!-- Carousel end -->

                    </div><!-- Related posts end -->

          

                </div><!-- Content Col end -->

                @include('frontend.layouts.sidebar')

            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- First block end -->






@endsection