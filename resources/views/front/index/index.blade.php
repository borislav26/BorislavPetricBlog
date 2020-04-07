@extends('front._layout.layout')
@section('seo_title','Home Page')
@section('content')
<!-- Hero Section-->

<div id="index-slider" class="owl-carousel">
    @foreach($sliderItems as $sliderItem)
    <section style="background: url('{{$sliderItem->getPhotoUrl()}}'); background-size: cover; background-position: center center" class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h1>{{ $sliderItem->title}}</h1>
                    <a href="{{ $sliderItem->url}}" class="hero-link">{{ $sliderItem->button_name}}</a>
                </div>
            </div>
        </div>
    </section>
    @endforeach

</div>

<!-- Intro Section-->
<section class="intro">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h2 class="h3">Some great intro here</h2>
                <p class="text-big">Place a nice <strong>introduction</strong> here <strong>to catch reader's attention</strong>.</p>
            </div>
        </div>
    </div>
</section>
<section class="featured-posts no-padding-top">
    <div class="container">
        @foreach($introBlogPosts as $key=>$post)
        <!-- Post-->
        <div class="row d-flex align-items-stretch">
            @if($key%2!=0)
            <div class="image col-lg-5"><img src="{{url('/themes/front/img/featured-pic-2.jpeg')}}" alt="..."></div>
            @endif
            <div class="text col-lg-7">
                <div class="text-inner d-flex align-items-center">
                    <div class="content">
                        <header class="post-header">
                            @if($post->post_category_id!=0)
                            <div class="category">
                                <a href="{{ route('front.posts.category',['category'=>$post->post_category_id])}}">
                                    {{ $post->category->name}}
                                </a>
                            </div>
                            @endif
                            @if($post->post_category_id==0)
                            <div class="category">
                                <a href="">
                                    @lang('Uncategorized')
                                </a>
                            </div>
                            @endif
                            <a href="{{ route('front.posts.single',['post'=>$post->id])}}">
                                <h2 class="h4">{{ $post->title}}</h2></a>
                        </header>
                        <p>{{ $post->shortDescription}}</p>
                        <footer class="post-footer d-flex align-items-center"><a href="{{ route('front.posts.author',['author'=>$post->post_author_id])}}" class="author d-flex align-items-center flex-wrap">
                                <div class="avatar"><img src="{{$post->image}}" alt="..." class="img-fluid"></div>
                                <div class="title"><span>{{ $post->author->name}}</span></div></a>
                            <div class="date"><i class="icon-clock"></i>{{$post->goodFormatedDate()}}</div>
                            <div class="comments"><i class="icon-comment"></i>{{ $post->comments()->count()}}</div>
                        </footer>
                    </div>
                </div>
            </div>
            @if($key%2==0)
            <div class="image col-lg-5"><img src="{{url('/themes/front/img/featured-pic-1.jpeg')}}" alt="..."></div>
            @endif
        </div>
        @endforeach

    </div>
</section>
<!-- Divider Section-->
<section style="background: url(/themes/front/img/divider-bg.jpg); background-size: cover; background-position: center bottom; background-attachment: fixed;" 
         class="divider" 
         data-stellar-background-ratio="0.3"
         >
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</h2>
                <a href="{{ route('front.contact.index')}}" class="hero-link">@lang('Contact Us')</a>
            </div>
        </div>
    </div>
</section>
<!-- Latest Posts -->
<section class="latest-posts"> 
    <div class="container">
        <header> 
            <h2>Latest from the blog</h2>
            <p class="text-big">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        </header>
        <div class="owl-carousel" id="latest-posts-slider">


            @foreach($latestPosts as $key=>$post)
            @if($key%3==0)
            <div class="row">
                @endif
                <div class="post col-md-4">
                    <div class="post-thumbnail"><a href="{{ route('front.posts.single',['post'=>$post->id])}}"><img src="{{url('/themes/front/img/blog-2.jpg')}}" alt="..." class="img-fluid"></a></div>
                    <div class="post-details">
                        <div class="post-meta d-flex justify-content-between">
                            <div class="date">{{ $post->giveMeHumanFriendlyDate()}}</div>
                            @if($post->post_category_id!=0)
                            <div class="category">
                                <a href="{{ route('front.posts.category',['category'=>$post->post_category_id])}}">
                                    {{ $post->category->name}}
                                </a>
                            </div>
                            @endif
                            @if($post->post_category_id==0)
                            <div class="category">
                                <a href="">
                                    @lang('Uncategorized')
                                </a>
                            </div>
                            @endif
                        </div><a href="{{ route('front.posts.single',['post'=>$post->id])}}">
                            <h3 class="h4">{{$post->title}}</h3></a>
                        <p class="text-muted">{{$post->shortDescription}}</p>
                    </div>
                </div>
                @if(($key+1)%3==0)
            </div>
            @endif
            @endforeach

            </section>
            <!-- Gallery Section-->
            <section class="gallery no-padding">    
                <div class="row">
                    <div class="mix col-lg-3 col-md-3 col-sm-6">
                        <div class="item">
                            <a href="{{url('/themes/front/img/gallery-1.jpg')}}" data-fancybox="gallery" class="image">
                                <img src="{{url('/themes/front/img/gallery-1.jpg')}}" alt="gallery image alt 1" class="img-fluid" title="gallery image title 1">
                                <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div>
                            </a>
                        </div>
                    </div>
                    <div class="mix col-lg-3 col-md-3 col-sm-6">
                        <div class="item">
                            <a href="{{url('/themes/front/img/gallery-2.jpg')}}" data-fancybox="gallery" class="image">
                                <img src="{{url('/themes/front/img/gallery-2.jpg')}}" alt="gallery image alt 2" class="img-fluid" title="gallery image title 2">
                                <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div>
                            </a>
                        </div>
                    </div>
                    <div class="mix col-lg-3 col-md-3 col-sm-6">
                        <div class="item">
                            <a href="{{url('/themes/front/img/gallery-3.jpg')}}" data-fancybox="gallery" class="image">
                                <img src="{{url('/themes/front/img/gallery-3.jpg')}}" alt="gallery image alt 3" class="img-fluid" title="gallery image title 3">
                                <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div>
                            </a>
                        </div>
                    </div>
                    <div class="mix col-lg-3 col-md-3 col-sm-6">
                        <div class="item">
                            <a href="{{url('/themes/front/img/gallery-4.jpg')}}" data-fancybox="gallery" class="image">
                                <img src="{{url('/themes/front/img/gallery-4.jpg')}}" alt="gallery image alt 4" class="img-fluid" title="gallery image title 4">
                                <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div>
                            </a>
                        </div>
                    </div>

                </div>
            </section>
            @endsection

            @push('footer_javascript')
            <script src="{{url('/themes/admin/assets/vendor/stellar.js-master/jquery.stellar.min.js')}}" type="text/javascript"></script>]
            <script type="text/javascript">
                $.stellar();
            </script>
            @endpush
