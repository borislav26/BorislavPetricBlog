@extends('admin._layout.layout')
@section('content')
<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">@lang('Posts categories list') </h2>

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index.index')}}" class="breadcrumb-link">@lang('Dashboard')</a></li>

                                <li class="breadcrumb-item active" aria-current="page">@lang('Posts categories')</li>
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
                    @lang('Post categories list')
                    <a href="{{ route('admin.post_categories.add')}}"><button style="float: right" class="btn btn-success">Add new post category</button></a>
                    <form style="display: none; float: right" class="btn-group" action="{{ route('admin.post_categories.change_priority')}}" method="post" id="change-priorities-form">
                        @csrf
                        <input type="hidden" id="values-of-post-categories" value="" name="priorities">
                        <button  class="btn btn-dark" data-action="change-priorities" type="submit">@lang('Save priorities')</button>
                        <button  class="btn btn-dark" data-action="cancel" type="button">@lang('Cancel')</button>
                    </form>
                    <button style="float: right" class="btn btn-dark" data-action="show-change-priority-buttons">@lang('Change priority')</button>
                </h5>

                <div class="card-body">
                    <div class="table-responsive" id="post-categories-table-field">
<!--                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="table-for-post-categories">
                                @foreach($postCategories as $category)
                                <tr data-id="{{ $category->id}}">
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name}}</td>

                                    <td>{{ $category->description}}</td>

                                    <td>
                                        <div class="btn-group ml-auto">
                                            <a href="{{ route('admin.post_categories.edit',['category'=>$category->id])}}"><button class="btn btn-sm btn-outline-light">Edit</button></a>
                                            <button 
                                                class="btn btn-sm btn-outline-light" 
                                                data-toggle="modal" 
                                                data-target="#modalDiscount"
                                                data-id="{{ $category->id}}"
                                                data-action="delete"
                                                data-name="{{ $category->name}}"
                                                >
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                            <a href="{{ route('front.posts.category',['category'=>$category->id])}}"> 
                                                <button class="btn btn-sm btn-outline-light">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </a>
                                            <span class="btn btn-outline-secondary"  style="display: none;" data-action="change-priority-button">
                                                <i class="fas fa-sort">Change priority</i>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>-->
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
<!--Modal: modalDiscount-->
<form  action="{{route('admin.post_categories.delete')}}" 
       method="POST"
       class="modal fade right" id="modalDiscount" tabindex="-1" role="dialog" aria-labelledby="fullHeightModalRight"
       aria-hidden="true" data-backdrop="true">
    @csrf
    <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <input type="hidden" name="category_id" value="">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading">@lang('Delete action')
                    <strong></strong>
                </p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">

                <div class="row">
                    <div class="col-3">
                        <p></p>
                        <p class="text-center">
                            <i class="fas fa-trash fa-4x"></i>
                        </p>
                    </div>

                    <div class="col-9">
                        <p>@lang('Are you shure want delete category with name:')</p>
                        <h3>
                            <strong id="category_name"></strong>
                        </h3>


                    </div>
                </div>
            </div>

            <!--Footer-->
            <div class="modal-footer flex-center">
                <button type="submit" class="btn btn-danger">Delete
                    <i class="fas fa-trash ml-1 white-text"></i>
                </button>
                <button type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">No, thanks</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</form>
<!--Modal: modalDiscount-->
@endsection

@push('head_css')

<link href="{{url('/themes/admin/assets/vendor/jquery-ui/jquery-ui.structure.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{url('/themes/admin/assets/vendor/jquery-ui/jquery-ui.theme.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@push('footer_javascript')
<script src="{{url('/themes/admin/assets/vendor/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    function loadTableContent() {
        $.ajax({
            "url": "{{ route('admin.post_categories.table_content')}}",
            "type": "get",
            "data": {

            }
        }).done(function (response) {
            $('#post-categories-table-field').html(response);

        }).fail(function () {

        });
    }
    loadTableContent();
    $('[data-action="show-change-priority-buttons"]').on('click', function () {
        $(this).hide();
        $('#change-priorities-form').show();

        $('#table-for-post-categories [data-action="change-priority-button"]').show();
    });
    $('#change-priorities-form [data-action="cancel"]').on('click', function () {
        $('[data-action="show-change-priority-buttons"]').show();
        $('#change-priorities-form').hide();



        $('#table-for-post-categories [data-action="change-priority-button"]').hide();
    });
    $('#table-for-post-categories').sortable({
        "handle": '.fa-sort',
        "update": function (event, ui) {
            let priorities = $('#table-for-post-categories').sortable('toArray', {
                "attribute": 'data-id'
            });
            $('#values-of-post-categories').val(priorities);
        }

    });
//    loadTableContent();
    $('#table-for-post-categories [data-action="delete"]').on('click', function () {
        let categoryId = $(this).attr('data-id');
        let categoryName = $(this).attr('data-name');

        $('#modalDiscount #category_name').text(categoryName);
        $('#modalDiscount [name="category_id"]').val(categoryId);
    });
    $('#modalDiscount').on('submit', function (e) {
        e.preventDefault();
        $(this).modal('hide');
        $.ajax({
            "url": "{{ route('admin.post_categories.delete')}}",
            "type": "post",
            "data": $(this).serialize(),
            "error": function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        }).done(function (response) {
            $.amaran({
                'message': response.success_message,
                'position': 'top right',
                'inEffect': 'slideLeft',
                'cssanimationIn': 'boundeInDown',
                'cssanimationOut': 'zoomOutUp'
            });
            loadTableContent();
        }).fail(function () {
            alert('negde je doslo do greske');
        });
    });
</script>
@endpush('footer_javascript')