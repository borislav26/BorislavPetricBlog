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

        <div class="card-body">
            <form id="filter-form">
                <div class="row">
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title"> 
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 form-group">
                        <label>Category</label>
                        <input type="text" class="form-control" name="post_category"> 
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 form-group">
                        <label>Author</label>
                        <input type="text" class="form-control" name="post_author"> 
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 form-group">
                        <label>Enabled</label>
                        <select type="text" class="form-control" name="enable">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select> 
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 form-group">
                        <label>Important</label>
                        <select type="text" class="form-control" name="important">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select> 
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 form-group">
                        <label>Tag</label>
                        <input type="text" class="form-control" name="tag_id"> 
                    </div>
                </div>
            </form>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">
                    @lang('Posts list')
                    <a href="{{ route('admin.posts.add')}}"><button style="float: right" class="btn btn-success">Add new post</button></a>
                </h5>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first" id="posts-table-field">

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
                            <tbody id="post-table-field">
                                <!--                                @foreach($posts as $post)
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
                                                                    <td>
                                                                        @if($post->post_category_id==0)
                                                                        <span class="text-warning">Uncategorized</span>
                                                                        @endif
                                                                        @if($post->post_category_id!=0)
                                                                        {{ $post->category->name}}
                                                                        @endif
                                                                    </td>
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
                                                                @endforeach-->

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
<!--Modal: modalDiscount-->
<form  action="{{route('admin.posts.delete')}}" 
       method="POST"
       class="modal fade right" id="modalDiscount" tabindex="-1" role="dialog" aria-labelledby="fullHeightModalRight"
       aria-hidden="true" data-backdrop="true">
    @csrf
    <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <input type="hidden" name="post_id" value="">
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
                            <strong id="post_title"></strong>
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
@push('footer_javascript')
<script>
    $('#filter-form').on('submit', function (e) {
        e.preventDefault();
        contentOfDataTables.ajax.reload(null, true);
    });
    $('#filter-form [name="important"]').on('change', function (e) {
        $('#filter-form').trigger('submit');
    });
    $('#filter-form [name="enable"]').on('change', function (e) {
        $('#filter-form').trigger('submit');
    });
    $('#filter-form [name]').on('keyup', function (e) {
        $('#filter-form').trigger('submit');
    });
    let contentOfDataTables = $('#posts-table-field').DataTable({
        "pageLength": 5,
        "lengthMenu": [5, 10, 25, 50, 100, 250],
        "serverSide": true,
        "processing": true,
        "responsive": true,
        "ajax": {
            "url": "{{ route('admin.posts.table_content')}}",
            "type": "POST",
            "data": function (dataFromDataTable) {
                dataFromDataTable['_token'] = "{{ csrf_token() }}";
                dataFromDataTable['title'] = $('#filter-form [name="title"]').val();
                dataFromDataTable['post_category'] = $('#filter-form [name="post_category"]').val();
                dataFromDataTable['post_author'] = $('#filter-form [name="post_author"]').val();
                dataFromDataTable['enable'] = $('#filter-form [name="enable"]').val();
                dataFromDataTable['important'] = $('#filter-form [name="important"]').val();
                dataFromDataTable['tag_id'] = $('#filter-form [name="tag_id"]').val();
            },

            "error": function (jqXHR, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + jqXHR.statusText + "\r\n" + jqXHR.responseText + "\r\n" + ajaxOptions.responseText);
            }
        },
        "columns": [
            {"name": "id", "data": "id"},
            {"name": "title", "data": "title"},
            {"name": "image", "data": "image", "orderable": false, "searchable": false},
            {"name": "enable", "data": "enable", "orderable": false, "searchable": false},
            {"name": "important", "data": "important", "orderable": false, "searchable": false},
            {"name": "shortDescription", "data": "shortDescription", "orderable": false, "searchable": false},
            {"name": "author", "data": "author", "orderable": false, "searchable": false},
            {"name": "category", "data": "category", "orderable": false, "searchable": false},
            {"name": "comments_number", "data": "comments_number", "orderable": false, "searchable": false},
            {"name": "reviews", "data": "reviews", "orderable": false, "searchable": false},
            {"name": "created_at", "data": "created_at", "orderable": false, "searchable": false},
            {"name": "actions", "data": "actions", "className": "text-center"}

        ]
    });
    $('#posts-table-field').on('click', '[data-action="delete"]', function () {
        let postId = $(this).attr('data-id');
        let postTitle = $(this).attr('data-name');
        $('#modalDiscount #post_title').text(postTitle);
        $('#modalDiscount [name="post_id"]').val(postId);
    });
    $('#modalDiscount').on('submit', function (e) {
        e.preventDefault();
        $(this).modal('hide');
        $.ajax({
            "url": "{{ route('admin.posts.delete')}}",
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
@endpush
