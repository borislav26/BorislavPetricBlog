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
                        <form action="" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title" class="col-form-label">@lang('Title')</label>
                                <input id="title" type="text" class="form-control @if($errors->has('title'))  is-invalid @endif" name="title" value="{{ old('title',$post->title)}}">
                            </div>
                            <div class="form-group">
                                <label for="shortDescription">@lang('Short Description')</label>
                                <textarea id="shortDescription" type="text" class="form-control @if($errors->has('shortDescription'))  is-invalid @endif" name="shortDescription">{{ old('shortDescription',$post->shortDescription)}}</textarea>

                            </div>
                            <div class="form-group">
                                <label for="post_category">@lang('Choose category of post')</label>
                                <select class="form-control" id="post_category" name="post_category_id">
                                    <option value="">@lang('Choose Category')</option>
                                    @foreach($postCategories as $category)
                                    <option 
                                        value="{{ $category->id}}" 
                                        @if($category->id==old('post_category_id',$post->post_category_id))  
                                        selected 
                                        @endif
                                        >{{ $category->name}}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox">@lang('Select tags')</label>
                                @foreach($tags as $tag)
                                <label class="custom-control custom-checkbox custom-control-inline">
                                    <input 
                                        name="tag_id" 
                                        value="{{ $tag->id}}" 
                                        type="checkbox" 
                                        class="custom-control-input"
                                        @if($category->id==old('post_tag_id'))  
                                        checked 
                                        @endif

                                        >
                                        <span class="custom-control-label">{{ $tag->name}}</span>
                                </label>
                                @endforeach

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
                                        class="custom-control-input"
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
                                        class="custom-control-input"
                                        ><span class="custom-control-label">@lang('No')</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox">@lang('Enabled')</label>
                                <label 
                                    class="custom-control custom-radio custom-control-inline"

                                    >
                                    <input 
                                        type="radio" 
                                    
                                        name="enabled"
                                        value="1"
                                        @if(old('enable',$post->enable)==1)
                                        checked=""
                                        @endif
                                        class="custom-control-input"
                                        ><span class="custom-control-label">@lang('Yes')</span>
                                </label>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input 
                                        type="radio" 
                                    
                                        name="enabled"
                                        value="0"
                                        @if(old('enable',$post->enable)==0)
                                        checked=""
                                        @endif
                                        class="custom-control-input"
                                        ><span class="custom-control-label">@lang('No')</span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-success">@lang('Add')</button>
                            <a href="{{ route('admin.posts.index')}}"><button type="button" class="btn btn-danger">@lang('Cancel')</button></a>
                        </form>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection