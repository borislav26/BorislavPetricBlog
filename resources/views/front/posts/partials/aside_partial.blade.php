<aside class="col-lg-4">
    <!-- Widget [Search Bar Widget]-->
    <div class="widget search">
        <header>
            <h3 class="h6">@lang('Search the blog')</h3>
        </header>
        <form action="{{ route('front.posts.search')}}" method="get" class="search-form">
            
            <div class="form-group">
                <input type="search" placeholder="What are you looking for?" name="value" value="{{ old('value')}}">
                <button type="submit" class="submit"><i class="icon-search"></i></button>
            </div>
        </form>
    </div>
    <!-- Widget [Latest Posts Widget]        -->
    <div class="widget latest-posts">
        <header>
            <h3 class="h6">Latest Posts</h3>
        </header>
        <div class="blog-posts">
            @foreach($postWithTheMostViews as $post)
            <a href="{{ route('front.posts.single',['post'=>$post->id])}}">
                <div class="item d-flex align-items-center">
                    <div class="image"><img src="/themes/front/img/small-thumbnail-1.jpg" alt="..." class="img-fluid"></div>
                    <div class="title"><strong>{{ $post->title}}</strong>
                        <div class="d-flex align-items-center">
                            <div class="views"><i class="icon-eye"></i>{{ $post->reviews}}</div>
                            <div class="comments"><i class="icon-comment"></i>{{ $post->comments()->count() }}</div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
      
        </div>
    </div>
    <!-- Widget [Categories Widget]-->
    <div class="widget categories">
        <header>
            <h3 class="h6">Categories</h3>
        </header>
        @foreach($postCategories as $category)
        <div class="item d-flex justify-content-between"><a href="{{route('front.posts.category',['category'=>$category->id])}}">{{ $category->name}}</a><span>{{ $category->posts_count }}</span></div>
        @endforeach
    </div>
    <!-- Widget [Tags Cloud Widget]-->
    <div class="widget tags">       
        <header>
            <h3 class="h6">@lang('Tags')</h3>
        </header>
        <ul class="list-inline">
             @foreach($postTags as $tag)
             <li class="list-inline-item"><a href="{{ route('front.posts.tag',['tag'=>$tag->id])}}" class="tag">#{{ $tag->name }}</a></li>
              @endforeach
        </ul>
    </div>
</aside>