@extends('front._layout.layout')
@section('seo_title', $post->title)
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
                            @if($post->post_category_id!=0)
                            <div class="category">
                                <a href="{{ route('front.posts.category',['category'=>$post->post_category_id,'name'=>\Str::slug(optional($post->category)->name),'description'=>\Str::slug(optional($post->category)->description)])}}">
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
                        </div>
                        <h1>{{$post->title}}<a href="#"><i class="fa fa-bookmark-o"></i></a></h1>
                        <div class="post-footer d-flex align-items-center flex-column flex-sm-row"><a href="{{  route('front.posts.author',['author'=>$post->post_author_id,'name'=>\Str::slug(optional($post->author)->name)])}}" class="author d-flex align-items-center flex-wrap">
                                <div class="avatar"><img src="{{ $post->getPhotoUrl()}}" alt="..." class="img-fluid"></div>
                                <div class="title"><span>{{ optional($post->author)->name}}</span></div></a>
                            <div class="d-flex align-items-center flex-wrap">       
                                <div class="date"><i class="icon-clock"></i> {{ $post->goodFormatedDate()}}</div>
                                <div class="views"><i class="icon-eye"></i> {{ $post->reviews}}</div>
                                <div class="comments meta-last"><a href="#post-comments"><i class="icon-comment"></i>{{ optional($post->comments())->count() }}</a></div>
                            </div>
                        </div>
                        <div class="post-body">
                            {!! $post->mainContent !!}
                        </div>
                        <div class="post-tags">
                            @foreach(optional($post->tags) as $tag)
                            <a href="{{ route('front.posts.tag',['tag'=>$tag->id])}}" class="tag">#{{ $tag->name}}</a>
                            @endforeach

                        </div>
                        <div class="posts-nav d-flex justify-content-between align-items-stretch flex-column flex-md-row">
                            @if($post->id!=$firstPost->id)
                            <a href="{{ route('front.posts.single',['post'=>$post->giveMePreviousPost()->id,'name'=>\Str::slug($post->giveMePreviousPost()->title)])}}" class="prev-post text-left d-flex align-items-center">
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
                            <a href="{{ route('front.posts.single',['post'=>$post->giveMeNextPost()->id,'name'=>\Str::slug($post->giveMeNextPost()->title)])}}" class="next-post text-right d-flex align-items-center justify-content-end">
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
                        <div class="post-comments" id="field-for-comments">


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
@push('head_css')
<link href="{{url('/themes/front/plugins/overhang.js-master/dist/overhang.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush
@push('footer_javascript')
<script src="{{url('/themes/front/plugins/overhang.js-master/dist/overhang.min.js')}}" type="text/javascript"></script>
<script src="{{url('/themes/admin/assets/vendor/jquery-validation/jquery.validate.min.js')}}" typ e="text/javascript"></script>

@endpush
@push('footer_javascript')
<script>
    $('#comment_field').validate({
    "rules": {

    "name_of_visitor": {
    required: true,
            maxlength: 30
    },
            "email_of_visitor": {
            required: false

            },
            "content": {
            required: true

            }

    },
            errorElement: 'span',
            errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            }
    });
    function incrementViews() {
    $.ajax({
    "url": "{{ route('front.posts.increment_views') }}",
            "type": "post",
            "data": {
            'post_id': "{{ $post->id}}",
                    '_token': "{{ csrf_token()}}"
            }
    }).done(function (response) {

    }).fail(function () {

    });
    }
    function loadComments() {

    $.ajax({
    "url": "{{route('front.posts.comments',['post'=>$post->id])}}",
            "type": "GET",
            "error": function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
            }
    }).done(function (response) {

    console.log('sve je dobro odradjeno');
    $('#field-for-comments').html(response);
    }).fail(function (response) {
    console.log('nege je doslo do greske');
    });
    }
    loadComments();
    incrementViews();
    $('#comment_field [data-action="leave-comment"]').on('click', function (e) {
    e.preventDefault();
    let postId = "{{ $post->id}}";
    let name = $('#comment_field [name="name_of_visitor"]').val();
    let email = $('#comment_field [name="email_of_visitor"]').val();
    let content = $('#comment_field [name="content"]').val();
    $.ajax({
    "url": "{{route('front.posts.leave_comment')}}",
            "type": "POST",
            "data": {
            "post_id": postId,
                    "name_of_visitor": name,
                    "email_of_visitor": email,
                    "content": content,
                    "_token": "{{ csrf_token()}}"
            },
            "error": function (ts) {

            }
    }).done(function (response) {

    loadComments();
   
    }).fail(function (response) {
    alert(reponse);
    });
    });

</script>
@endpush