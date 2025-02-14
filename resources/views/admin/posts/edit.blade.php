@extends('admin._layout.layout')
@section('content')
<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">

        <!-- ============================================================== -->
        <!-- basic form  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">@lang('Edit post') </h2>

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index.index')}}" class="breadcrumb-link">@lang('Dashboard')</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.posts.index')}}" class="breadcrumb-link">@lang('Posts')</a></li>

                                <li class="breadcrumb-item active" aria-current="page">@lang('Edit post')</li>
                            </ol>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                <div class="section-block" id="basicform">
                </div>
                <div class="card">

                    <div class="card-body">
                        <form action="{{ route('admin.posts.update',['post'=>$post->id])}}" method="post" id="post-form" enctype="multipart/form-data"> 
                            @csrf
                            <div class="form-group">
                                <label for="title" class="col-form-label">@lang('Title')</label>
                                <input id="title" type="text" class="form-control @if($errors->has('title'))  is-invalid @endif" name="title" value="{{ old('title',$post->title)}}">
                                @include('admin._layout.partials.form_errors',['fieldName'=>'title'])
                            </div>
                            <div class="form-group">
                                <label for="shortDescription">@lang('Short Description')</label>
                                <textarea id="shortDescription" type="text" class="form-control @if($errors->has('shortDescription'))  is-invalid @endif" name="shortDescription">{{ old('shortDescription',$post->shortDescription)}}</textarea>
                                @include('admin._layout.partials.form_errors',['fieldName'=>'shortDescription'])
                            </div>
                            <div class="form-group">
                                <label for="post_category">@lang('Choose category of post')</label>
                                <select class="form-control @if($errors->has('post_category_id'))  is-invalid @endif" id="post_category" name="post_category_id">
                                    <option value="">@lang('Choose Category')</option>
                                    @foreach($postCategories as $category)
                                    <option value="{{ $category->id }}" @if($category->id==old('post_category_id',$post->post_category_id))  selected @endif>{{ $category->name}}</option>

                                    @endforeach
                                </select>
                                @include('admin._layout.partials.form_errors',['fieldName'=>'post_category_id'])
                            </div>
                            <div class="form-group">

                                <label class="custom-control custom-checkbox">@lang('Select tags')</label>
                                @foreach($tags as $tag)
                                <label class="custom-control custom-checkbox custom-control-inline">
                                    <input 
                                        name="tag_id[]" 
                                        value="{{ $tag->id}}" 
                                        type="checkbox" 
                                        class="custom-control-input"
                                        @if( is_array(old('tag_id',$post->tags->pluck('id')->toArray())) && in_array($tag->id,old('tag_id',$post->tags->pluck('id')->toArray()))))  
                                        checked 
                                        @endif

                                        >
                                        <span class="custom-control-label">{{ $tag->name}}</span>
                                </label>
                                @endforeach


                                @include('admin._layout.partials.form_errors',['fieldName'=>'tag_id'])
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox">@lang('Important')</label>
                                <label 
                                    class="custom-control custom-radio custom-control-inline"

                                    >
                                    <input 
                                        type="radio" 

                                        name="status_important"
                                        value="1"
                                        @if(old('status_important',$post->status_important)==1)
                                        checked=""
                                        @endif
                                        class="custom-control-input @if($errors->has('status_important'))  is-invalid @endif"
                                        ><span class="custom-control-label">@lang('Yes')</span>
                                </label>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input 
                                        type="radio" 

                                        name="status_important"
                                        value="0"
                                        @if(old('status_important',$post->status_important)==0)
                                        checked=""
                                        @endif
                                        class="custom-control-input @if($errors->has('status_important'))  is-invalid @endif"
                                        ><span class="custom-control-label">@lang('No')</span>
                                </label>
                                @include('admin._layout.partials.form_errors',['fieldName'=>'status_important'])
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox">@lang('Enabled')</label>
                                <label 
                                    class="custom-control custom-radio custom-control-inline"

                                    >
                                    <input 
                                        type="radio" 

                                        name="enable"
                                        value="1"
                                        @if(old('enable',$post->enable)==1)
                                        checked=""
                                        @endif
                                        class="custom-control-input @if($errors->has('enabled'))  is-invalid @endif"
                                        ><span class="custom-control-label">@lang('Yes')</span>
                                </label>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input 
                                        type="radio" 

                                        name="enable"
                                        value="0"
                                        @if(old('enable',$post->enable)==0)
                                        checked=""
                                        @endif
                                        class="custom-control-input @if($errors->has('enabled'))  is-invalid @endif"
                                        ><span class="custom-control-label">@lang('No')</span>
                                </label>
                                @include('admin._layout.partials.form_errors',['fieldName'=>'enable'])
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-form-label">@lang('Image')</label>
                                <input id="image" type="file" class="form-control @if($errors->has('image'))  is-invalid @endif" name="image">
                                @include('admin._layout.partials.form_errors',['fieldName'=>'image'])
                            </div>
                            <div class="form-group">
                                <label for="mainContent">@lang('Content od post')</label>
                                <textarea id="mainContent" type="text" class="form-control @if($errors->has('mainContent'))  is-invalid @endif" name="mainContent">{{ old('mainContent',$post->mainContent)}}</textarea>
                                @include('admin._layout.partials.form_errors',['fieldName'=>'mainContent'])
                            </div>
                            <button type="submit" class="btn btn-success">@lang('Edit')</button>
                            <a href="{{ route('admin.posts.index')}}"><button type="button" class="btn btn-danger">@lang('Cancel')</button></a>
                        </form>
                    </div>
                    @include('admin._layout.partials.footer')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('footer_javascript')
<script src="{{url('/themes/admin/assets/vendor/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
<script src="{{url('/themes/admin/assets/vendor/ckeditor/adapters/jquery.js')}}" type="text/javascript"></script>

<script>
    $('#post-form [name="mainContent"]').ckeditor({
    "height":"400px"

    });
</script>
@endpush