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
                    <h2 class="pageheader-title">@lang('Posts tags list') </h2>

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index.index')}}" class="breadcrumb-link">@lang('Dashboard')</a></li>

                                <li class="breadcrumb-item active" aria-current="page">@lang('Posts tags')</li>
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
                    @lang('Post tags list')
                    <a href="{{ route('admin.post_tags.add')}}"><button style="float: right" class="btn btn-success">@lang('Add new post tag')</button></a>


                </h5>

                <div class="card-body">
                    <div class="table-responsive" id="post-tags-table-field">
                        <table class="table table-striped table-bordered first" id="tags-table-field">
                            <col width="33%">
                            <col width="33%">
                            <col width="33%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>

                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="table-for-post-tags">
                                @foreach($postTags as $tag)
                                <tr data-id="{{ $tag->id}}">
                                    <td>{{ $tag->id }}</td>
                                    <td>#{{ \Str::slug($tag->name)}}</td>



                                    <td>
                                        <div class="btn-group ml-auto" style="float: right;">
                                            <a href="{{ route('admin.post_tags.edit',['tag'=>$tag->id])}}"><button class="btn btn-sm btn-outline-light">@lang('Edit')</button></a>
                                            <button 
                                                class="btn btn-sm btn-outline-light" 
                                                data-toggle="modal" data-target="#modalDiscount"
                                                data-id="{{ $tag->id}}"
                                                data-name="{{ $tag->name}}"
                                                data-action="delete"
                                                >
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                            <a href="{{ route('front.posts.tag',['tag'=>$tag->id])}}">
                                                <button class="btn btn-sm btn-outline-light">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>

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
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fullHeightModalRight">Launch
  modal</button>-->

<form  action="{{route('admin.post_tags.delete')}}" 
       method="POST"
       class="modal fade right" id="modalDiscount" tabindex="-1" role="dialog" aria-labelledby="fullHeightModalRight"
       aria-hidden="true" data-backdrop="true">
    @csrf
    <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <input type="hidden" name="tag_id" value="">
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
                            <strong id="tag_name"></strong>
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
            "url": "{{ route('admin.post_tags.table_content')}}",
            "type": "get",
            "data": {

            }
        }).done(function (response) {
            $('#post-tags-table-field').html(response);

        }).fail(function () {

        });
    }
    let contentOfDataTables = $('#tags-table-field').DataTable({
        "pageLength": 5,
        "lengthMenu": [5, 10, 25, 50, 100, 250],
        "serverSide": true,
        "processing": true,
        "responsive": true,
        "ajax": {
            "url": "{{ route('admin.post_tags.table_content')}}",
            "type": "POST",
            "data": {
                "_token": "{{ csrf_token()}}"
            },

//
//            },
            "error": function (jqXHR, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + jqXHR.statusText + "\r\n" + jqXHR.responseText + "\r\n" + ajaxOptions.responseText);
            }
        },
        "columns": [
            {"name": "id", "data": "id"},
            {"name": "name", "data": "name"},
            {"name": "actions", "data": "actions", "className": "text-center"}

        ]
    });
//    $('#table-for-post-tags [data-action="delete"]').on('click', function () {
//        let categoryId = $(this).attr('data-id');
//        let categoryName = $(this).attr('data-name');
//
//        $('#modalDiscount #tag_name').text(categoryName);
//        $('#modalDiscount [name="tag_id"]').val(categoryId);
//    });
//    $('#modalDiscount').on('submit', function (e) {
//        e.preventDefault();
//        $(this).modal('hide');
//        $.ajax({
//            "url": "{{ route('admin.post_tags.delete')}}",
//            "type": "post",
//            "data": $(this).serialize(),
//            "error": function (xhr, ajaxOptions, thrownError) {
//                alert(xhr.status);
//                alert(thrownError);
//            }
//        }).done(function (response) {
//
//            loadTableContent();
//        }).fail(function () {
//            alert('negde je doslo do greske');
//        });
//    });

    $('#tags-table-field').on('click', '[data-action="delete"]', function () {
        let categoryId = $(this).attr('data-id');
        let categoryName = $(this).attr('data-name');

        $('#modalDiscount #tag_name').text(categoryName);
        $('#modalDiscount [name="tag_id"]').val(categoryId);
    });
    $('#modalDiscount').on('submit', function (e) {
        e.preventDefault();
        $(this).modal('hide');
        $.ajax({
            "url": "{{ route('admin.post_tags.delete')}}",
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
            contentOfDataTables.ajax.reload(null, false);
        }).fail(function () {
            alert('negde je doslo do greske');
        });
    });
</script>
@endpush('footer_javascript')