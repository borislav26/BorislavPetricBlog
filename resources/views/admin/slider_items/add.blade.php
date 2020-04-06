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
                    <h2 class="pageheader-title">@lang('Add new slider item') </h2>

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index.index')}}" class="breadcrumb-link">@lang('Dashboard')</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.slider_items.index')}}" class="breadcrumb-link">@lang('Slider items')</a></li>

                                <li class="breadcrumb-item active" aria-current="page">@lang('Add slider item')</li>
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
                        <form action="{{ route('admin.slider_items.insert')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title" class="col-form-label">@lang('Title')</label>
                                <input id="title" type="text" class="form-control @if($errors->has('title'))  is-invalid @endif" name="title" value="{{ old('title')}}">
                                @include('admin._layout.partials.form_errors',['fieldName'=>'title'])
                            </div>
                            <div class="form-group">
                                <label for="button_name" class="col-form-label">@lang('Button name')</label>
                                <input id="button_name" type="text" class="form-control @if($errors->has('button_name'))  is-invalid @endif" name="button_name" value="{{ old('button_name')}}">
                                @include('admin._layout.partials.form_errors',['fieldName'=>'button_name'])
                            </div>
                            <div class="form-group">
                                <label for="url" class="col-form-label">@lang('Url')</label>
                                <input id="url" type="text" class="form-control @if($errors->has('url'))  is-invalid @endif" name="url" value="{{ old('url')}}">
                                @include('admin._layout.partials.form_errors',['fieldName'=>'url'])
                            </div>

                            <div class="form-group">
                                <label for="image" class="col-form-label">@lang('Image')</label>
                                <div class="custom-file mb-3"> 
                                    <input type="file" class="custom-file-input @if($errors->has('image'))  is-invalid @endif" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose image</label>
                                    @include('admin._layout.partials.form_errors',['fieldName'=>'image'])
                                </div>
                            </div>


                            <button type="submit" class="btn btn-success">@lang('Add')</button>
                            <a href="{{ route('admin.post_tags.index')}}"><button type="button" class="btn btn-danger">@lang('Cancel')</button></a>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
