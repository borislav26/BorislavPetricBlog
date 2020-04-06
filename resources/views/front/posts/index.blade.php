@extends('front._layout.layout')
@section('seo_title','Posts Page')

@section('content')
<div class="container">
    <div class="row">
        <!-- Latest Posts -->
        <main class="posts-listing col-lg-8"> 
            <div class="container">
                <div class="row">
                    @foreach($posts as $post)
                    <!-- post -->
                    <div class="post col-xl-6">
                        <div class="post-thumbnail"><a href="{{ route('front.posts.single',['post'=>$post->id])}}"><img src="{{ $post->image }}" alt="..." class="img-fluid"></a></div>
                        <div class="post-details">
                            <div class="post-meta d-flex justify-content-between">
                                <div class="date meta-last">{{ $post->giveMeHumanFriendlyDate()}}</div>
                                <div class="category"><a href="blog-category.html">{{ $post->category->name}}</a></div>
                            </div><a href="{{ route('front.posts.single',['post'=>$post->id])}}">
                                <h3 class="h4">{{ $post->title}}</h3></a>
                            <p class="text-muted">{{ $post->shortDescription}}</p>
                            <footer class="post-footer d-flex align-items-center"><a href="{{ route('front.posts.author',['author'=>$post->author->id])}}" class="author d-flex align-items-center flex-wrap">
                                    <div class="avatar"><img src="{{url('/themes/front/img/avatar-3.jpg')}}" alt="..." class="img-fluid"></div>
                                    <div class="title"><span>{{ $post->author->name}}</span></div></a>
                                <div class="date"><i class="icon-clock"></i>{{ $post->goodFormatedDate()}}</div>
                                <div class="comments meta-last"><i class="icon-comment"></i>{{ $post->comments()->count()}}</div>
                            </footer>
                        </div>
                    </div>
                    @endforeach

                </div>
                <!-- Pagination -->
                <nav aria-label="Page navigation example">

                    {{ $posts->links() }}

                </nav>
            </div>
        </main>
        @include('front.posts.partials.aside_partial',[
        'postCategories'=>$postCategories,
        'postTags'=>$postTags,
        'postWithTheMostViews'=>$postWithTheMostViews
        ])
    </div>
</div>
@endsection
