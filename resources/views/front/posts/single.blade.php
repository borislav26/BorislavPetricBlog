@extends('front._layout.layout')
@section('seo_title',' $post->title')
@section('content')
<div class="container">
    <div class="row">
        <!-- Latest Posts -->
        <main class="post blog-post col-lg-8"> 
            <div class="container">
                <div class="post-single">
                    <div class="post-thumbnail"><img src="{{ $post->image}}" alt="..." class="img-fluid"></div>
                    <div class="post-details">
                        <div class="post-meta d-flex justify-content-between">
                            <div class="category"><a href="blog-category.html">{{$post->category->name}}</a></div>
                        </div>
                        <h1>{{$post->title}}<a href="#"><i class="fa fa-bookmark-o"></i></a></h1>
                        <div class="post-footer d-flex align-items-center flex-column flex-sm-row"><a href="{{  route('front.posts.author',['author'=>$post->author->id])}}" class="author d-flex align-items-center flex-wrap">
                                <div class="avatar"><img src="{{ $post->image}}" alt="..." class="img-fluid"></div>
                                <div class="title"><span>{{ $post->author->name}}</span></div></a>
                            <div class="d-flex align-items-center flex-wrap">       
                                <div class="date"><i class="icon-clock"></i> {{ $post->goodFormatedDate()}}</div>
                                <div class="views"><i class="icon-eye"></i> {{ $post->reviews}}</div>
                                <div class="comments meta-last"><a href="#post-comments"><i class="icon-comment"></i>{{ $post->comments()->count() }}</a></div>
                            </div>
                        </div>
                        <div class="post-body">
                            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            <p> <img src="{{ $post->image}}" alt="..." class="img-fluid"></p>
                            <h3>Lorem Ipsum Dolor</h3>
                            <p>div Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda temporibus iusto voluptates deleniti similique rerum ducimus sint ex odio saepe. Sapiente quae pariatur ratione quis perspiciatis deleniti accusantium</p>
                            <blockquote class="blockquote">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                                <footer class="blockquote-footer">Someone famous in
                                    <cite title="Source Title">Source Title</cite>
                                </footer>
                            </blockquote>
                            <p>quasi nam. Libero dicta eum recusandae, commodi, ad, autem at ea iusto numquam veritatis, officiis. Accusantium optio minus, voluptatem? Quia reprehenderit, veniam quibusdam provident, fugit iusto ullam voluptas neque soluta adipisci ad.</p>
                        </div>
                        <div class="post-tags">
                            @foreach($post->tags as $tag)
                            <a href="{{ route('front.posts.tag',['tag'=>$tag->id])}}" class="tag">#{{ $tag->name}}</a>
                            @endforeach

                        </div>
                        <div class="posts-nav d-flex justify-content-between align-items-stretch flex-column flex-md-row">
                            @if($post->id!=1)
                            <a href="{{ route('front.posts.single',['post'=>$post->giveMePreviousPost()->id,'postName'=>\Str::slug($post->giveMeNextPost()->title)])}}" class="prev-post text-left d-flex align-items-center">
                                <div class="icon prev">
                                    <i class="fa fa-angle-left"></i>
                                </div>
                                <div class="text">
                                    <strong class="text-primary">
                                        Previous Post 
                                    </strong>
                                    <h6>{{ $post->giveMePreviousPost()->title}}</h6>

                                </div>
                            </a>
                            @endif
                            @if($post->id!=$lastPost->id)
                            <a href="{{ route('front.posts.single',['post'=>$post->giveMeNextPost()->id,'postName'=>\Str::slug($post->giveMeNextPost()->title)])}}" class="next-post text-right d-flex align-items-center justify-content-end">
                                <div class="text">
                                    <strong class="text-primary">
                                        Next Post 
                                    </strong>
                                    <h6>{{ $post->giveMeNextPost()->title}}</h6>
                                </div>
                                <div class="icon next">
                                    <i class="fa fa-angle-right"></i>
                                </div>
                            </a>
                            @endif
                        </div>
                        <div class="post-comments" id="post-comments">


                        </div>
                        <div class="add-comment">
                            <header>
                                <h3 class="h6">Leave a reply</h3>
                            </header>
                            <form action="{{ route('front.posts.leave_comment') }}" method="post" class="commenting-form" id="comment_field">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id}}">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input type="text" name="name_of_visitor" id="username" placeholder="Name" class="form-control @if($errors->has('name_of_visitor')) is-invalid @endif" value="{{ old('name_of_visitor') }}">
                                        @include('front._layout.partials.form_errors',['fieldName'=>'name_of_visitor'])
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="email" name="email_of_visitor" id="useremail" placeholder="Email Address (will not be published)" class="form-control @if($errors->has('email_of_visitor')) is-invalid @endif" value="{{ old('email_of_visitor') }}">
                                         @include('front._layout.partials.form_errors',['fieldName'=>'email_of_visitor'])
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea name="content" id="usercomment" placeholder="Type your comment" class="form-control @if($errors->has('content')) is-invalid @endif">{{ old('content')}}</textarea>
                                         @include('front._layout.partials.form_errors',['fieldName'=>'content'])
                                    </div>
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-secondary" data-action="leave-comment">Submit Comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        @include('front.posts.partials.aside_partial',[
            'postCategories'=>$postCategories,
            'postTags'=>$postTags
        ])
    </div>
</div>
@endsection
@push('footer_javascript')
<script>
    function loadComments(){
    let postId="{{ $post->id}}";
    $.ajax({
        "url":"{{route('front.posts.comments',['post'=>$post->id])}}",
        "type":"GET",
        "data":{
            
        },
        "error": function(ts) { alert(ts.responseText) }
    }).done(function(response){
        //alert(response);
        console.log('sve je dobro odradjeno');
        $('#post-comments').html(response);
    }).fail(function(response){
        console.log('nege je doslo do greske');
    });
    }
   loadComments();
    $('#comment_field [data-action="leave-comment"]').on('click',function(e){
        e.preventDefault();
        let postId="{{ $post->id}}";
        let name=$('#comment_field [name="name_of_visitor"]').val();
        let email=$('#comment_field [name="email_of_visitor"]').val();
        let content=$('#comment_field [name="content"]').val();
        $.ajax({
            "url":"{{route('front.posts.leave_comment')}}",
            "type":"POST",
            "data":{
                "post_id":postId,
                "name_of_visitor":name,
                "email_of_visitor":email,
                "content":content,
                "_token":"{{ csrf_token()}}"
            },
            "error": function(ts) { alert(ts.responseText) }
        }).done(function(response){
            loadComments();
            console.log('dobro je sve odradjeno');
        }).fail(function(response){
            alert(reponse);
        })
    });
</script>
@endpush