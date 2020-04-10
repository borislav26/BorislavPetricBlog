@extends('front._layout.layout')
@section('seo_title','#'.$tag->name)
@section('content')
<div class="container">
    <div class="row">
        <!-- Latest Posts -->
        <main class="posts-listing col-lg-8"> 
            <div class="container">
                <h2 class="mb-3">Tag "{{$tag->name}}"</h2>
                <div class="row">
                    @foreach($posts as $post)
                    <!-- post -->
                    <div class="post col-xl-6">
                        <div class="post-thumbnail"><a href="{{ route('front.posts.single',['post'=>$post->id,'name'=>\Str::slug($post->title)])}}"><img src="/themes/front/img/blog-post-1.jpeg" alt="..." class="img-fluid"></a></div>
                        <div class="post-details">
                            <div class="post-meta d-flex justify-content-between">
                                <div class="date meta-last">{{ $post->giveMeHumanFriendlyDate()}}</div>
                                @if($post->post_category_id!=0)
                                <div class="category">
                                    <a href="{{ route('front.posts.category',['category'=>$post->post_category_id,'name'=>\Str::slug(optional($post->category)->name),'description'=>\Str::slug(optional($post->category)->name)])}}">
                                        {{ optional($post->category)->name}}
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
                            </div><a href="{{ route('front.posts.single',['post'=>$post->id,'name'=>\Str::slug($post->title)])}}">
                                <h3 class="h4">{{ $post->title}}</h3></a>
                            <p class="text-muted">{{ $post->shortDescription}}</p>
                            <footer class="post-footer d-flex align-items-center"><a href="{{ route('front.posts.author',['author'=>$post->post_author_id,'name'=>\Str::slug(optional($post->author)->name)])}}" class="author d-flex align-items-center flex-wrap">
                                    <div class="avatar"><img src="/themes/front/img/avatar-3.jpg" alt="..." class="img-fluid"></div>
                                    <div class="title"><span>{{ optional($post->author)->name}}</span></div></a>
                                <div class="date"><i class="icon-clock"></i>{{ $post->goodFormatedDate()}}</div>
                                <div class="comments meta-last"><i class="icon-comment"></i>{{ optional($post->comments())->count()}}</div>
                            </footer>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Pagination -->
                <nav aria-label="Page navigation example">
                    @include('front.posts.partials.pagination', ['paginator' => $posts])
                </nav>
            </div>
        </main>

        @include('front.posts.partials.aside_partial',[
        'postCategories'=>$postCategories,
        'postTags'=>$postTags
        ])
    </div>
</div>

@endsection