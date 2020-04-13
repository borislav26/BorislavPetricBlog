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
                    <h2 class="pageheader-title">@lang('Edit post tag') </h2>

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index.index')}}" class="breadcrumb-link">@lang('Dashboard')</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.post_tags.index')}}" class="breadcrumb-link">@lang('Posts tags')</a></li>

                                <li class="breadcrumb-item active" aria-current="page">@lang('Edit post tag')</li>
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
                        <form action="{{ route('admin.post_tags.update',['tag'=>$tag->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="col-form-label">@lang('Name')</label>
                                <input id="name" type="text" class="form-control @if($errors->has('name'))  is-invalid @endif" name="name" value="{{ old('name',$tag->name)}}">
                                @include('admin._layout.partials.form_errors',['fieldName'=>'name'])
                            </div>
                            

                            <button type="submit" class="btn btn-success">@lang('Edit')</button>
                            <a href="{{ route('admin.post_tags.index')}}"><button type="button" class="btn btn-danger">@lang('Cancel')</button></a>
                        </form>
                    </div>
                   @include('admin._layout.partials.footer')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
