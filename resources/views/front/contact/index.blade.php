@extends('front._layout.layout')
@section('seo_title','Contact Page')
@section('seo_description','The contact page of Borislav Petric Blog')
@section('content')
<!-- Hero Section -->
<section style="background: url(/themes/front/img/hero.jpg); background-size: cover; background-position: center center; background-attachment: fixed;" 
         class="hero" 
         data-stellar-background-ratio="0.3"
         >
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Have an interesting news or idea? Don't hesitate to contact us!</h1>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <!-- Latest Posts -->
        <main class="col-lg-8"> 
            <div class="container">
                <form action="{{ route('front.contact.send_email')}}" class="commenting-form" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" placeholder="Your Name" class="form-control @if($errors->has('name')) is-invalid @endif" name="name" value="{{ old('name')}}">
                             @include('front._layout.partials.form_errors',['fieldName'=>'name'])
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" placeholder="Email Address (will not be published)" class="form-control @if($errors->has('email')) is-invalid @endif" name="email" value="{{ old('email')}}">
                             @include('front._layout.partials.form_errors',['fieldName'=>'email'])
                        </div>
                        <div class="form-group col-md-12">
                            <textarea placeholder="Type your message" class="form-control @if($errors->has('email_content')) is-invalid @endif" rows="20" name="email_content">{{ old('email_content')}}</textarea>
                            @include('front._layout.partials.form_errors',['fieldName'=>'email_content'])
                        </div>
                        <div class="form-group col-md-12">
                        {!! htmlFormSnippet() !!}
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-secondary">Submit Your Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
        <aside class="col-lg-4">
            <!-- Widget [Contact Widget]-->
            <div class="widget categories">
                <header>
                    <h3 class="h6">Contact Info</h3>
                    <div class="item d-flex justify-content-between">
                        <span>15 Yemen Road, Yemen</span>
                        <span><i class="fa fa-map-marker"></i></span>
                    </div>
                    <div class="item d-flex justify-content-between">
                        <span>(020) 123 456 789</span>
                        <span><i class="fa fa-phone"></i></span>
                    </div>
                    <div class="item d-flex justify-content-between">
                        <span>info@company.com</span>
                        <span><i class="fa fa-envelope"></i></span>
                    </div>
                </header>

            </div>
            <div class="widget latest-posts">
                <header>
                    <h3 class="h6">Latest Posts</h3>
                </header>
                <div class="blog-posts">
                    @foreach($postWithTheMostViews as $post)
                    <a href="{{ route('front.posts.single',['post'=>$post->id])}}">
                        <div class="item d-flex align-items-center">
                            <div class="image"><img src="{{url('/themes/front/img/small-thumbnail-1.jpg')}}" alt="..." class="img-fluid"></div>
                            <div class="title"><strong>{{ $post->title}}</strong>
                                <div class="d-flex align-items-center">
                                    <div class="views"><i class="icon-eye"></i>{{ $post->reviews}}</div>
                                    <div class="comments"><i class="icon-comment"></i>{{ $post->comments()->count()}}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
@push('head_css')
{!! htmlScriptTagJsApi() !!}
@endpush
@push('footer_javascript')
<script src="{{url('/themes/admin/assets/vendor/stellar.js-master/jquery.stellar.min.js')}}" type="text/javascript"></script>]
<script type="text/javascript">
    $.stellar();
</script>
@endpush