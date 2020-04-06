@extends('admin._layout.layout')
@section('content')

<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- wrapper  -->
<!-- ============================================================== -->
<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">@lang('Posts list') </h2>

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index.index')}}" class="breadcrumb-link">@lang('Dashboard')</a></li>

                                <li class="breadcrumb-item active" aria-current="page">@lang('Posts list')</li>
                            </ol>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end pageheader -->
        <!-- ============================================================== -->

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">
                    @lang('Posts list')
                    <a href="{{ route('admin.posts.add')}}"><button style="float: right" class="btn btn-success">Add new post</button></a>
                </h5>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Enable</th>
                                    <th>Important</th>
                                    <th>Short description</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>Number of comments</th>
                                    <th>Number of reviews</th>
                                    <th>Date created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title}}</td>
                                    <td>
                                        <img class="mr-3 user-avatar-lg rounded" src="/themes/admin/assets/images/avatar-1.jpg" alt="Generic placeholder image">
                                    </td>
                                    <td>
                                        <div class="text-center">{{ $post->enable}}</div>
                                        <div class="switch-button switch-button-success">
                                            <input type="checkbox" checked="" name="enable" id="switch{{$post->id}}" value="{{ $post->enable}}">
                                            <span>
                                                <label for="switch{{ $post->id}}"></label>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            {{ $post->status_important}}
                                        </div>
                                        <div class="switch-button switch-button-success">
                                            <input type="checkbox" checked="" name="important" id="switch_{{ $post->id}}" value="{{ $post->important}}">
                                            <span>
                                                <label for="switch_{{ $post->id}}"></label>
                                            </span>
                                        </div>
                                    </td>
                                    <td>{{ $post->shortDescription}}</td>
                                    <td>{{ $post->author->name}}</td>
                                    <td>{{ $post->category->name}}</td>
                                    <td>{{ $post->comments()->count()}}</td>
                                    <td>{{ $post->reviews}}</td>
                                    <td>{{ $post->giveMeHumanFriendlyDate()}}</td>
                                    <td>
                                        <div class="btn-group ml-auto">
                                            <a href="{{ route('admin.posts.edit',['post'=>$post->id])}}"><button class="btn btn-sm btn-outline-light">Edit</button></a>
                                            <button class="btn btn-sm btn-outline-light">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-light">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                     <th>#</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Enable</th>
                                    <th>Important</th>
                                    <th>Short description</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>Number of comments</th>
                                    <th>Number of reviews</th>
                                    <th>Date created</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        

    </div>
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <div class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    Copyright © 2018 Concept. All rights reserved. Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>.
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="text-md-right footer-links d-none d-sm-block">
                        <a href="javascript: void(0);">About</a>
                        <a href="javascript: void(0);">Support</a>
                        <a href="javascript: void(0);">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end footer -->
    <!-- ============================================================== -->
</div>
@endsection