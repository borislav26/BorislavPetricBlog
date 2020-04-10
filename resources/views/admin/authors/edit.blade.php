@extends('admin._layout.layout')
@section('seo_title','Author Editing')
@section('content')
<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">

        <!-- ============================================================== -->
        <!-- basic form  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">@lang('Edit author') </h2>

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index.index')}}" class="breadcrumb-link">@lang('Dashboard')</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.authors.index')}}" class="breadcrumb-link">@lang('Authors')</a></li>

                                <li class="breadcrumb-item active" aria-current="page">@lang('Edit author')</li>
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
                        <form action="{{ route('admin.authors.update',['author'=>$author->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="col-form-label">@lang('Name')</label>
                                <input id="name" type="text" class="form-control @if($errors->has('name'))  is-invalid @endif" name="name" value="{{ old('name',$author->name)}}">
                                @include('admin._layout.partials.form_errors',['fieldName'=>'name'])
                            </div>
                            <div class="form-group">
                                <label for="email">@lang('Email')</label>
                                <input id="email" type="text" class="form-control @if($errors->has('email'))  is-invalid @endif" name="email" value="{{ old('email',$author->email)}}">
                                @include('admin._layout.partials.form_errors',['fieldName'=>'email'])
                            </div>
                            <div class="form-group">
                                <label for="phone_number">@lang('Phone number')</label>
                                <input id="phone_number" type="text" class="form-control @if($errors->has('phone_number'))  is-invalid @endif" name="phone_number" value="{{ old('phone_number',$author->phone_number)}}">
                                @include('admin._layout.partials.form_errors',['fieldName'=>'phone_number'])
                            </div>


                            <div class="form-group">
                                <label for="image" class="col-form-label">@lang('Image')</label>
                                <input id="image" type="file" class="form-control @if($errors->has('image'))  is-invalid @endif" name="image">
                                @include('admin._layout.partials.form_errors',['fieldName'=>'image'])
                            </div>
                            <button type="submit" class="btn btn-success">@lang('Edit')</button>
                            <a href="{{ route('admin.authors.index')}}"><button type="button" class="btn btn-danger">@lang('Cancel')</button></a>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection