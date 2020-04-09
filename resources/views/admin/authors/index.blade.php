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
                    <h2 class="pageheader-title">@lang('Authors list') </h2>

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index.index')}}" class="breadcrumb-link">@lang('Dashboard')</a></li>

                                <li class="breadcrumb-item active" aria-current="page">@lang('Authors')</li>
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
                    @lang('Authors list')
                    <a href="{{ route('admin.authors.add')}}"><button style="float: right" class="btn btn-success">@lang('Add new user')</button></a>

                </h5>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first" id="users-table">
                            <col width="5%">
                            <col width="15%">
                            <col width="10%">
                            <col width="15%">
                            <col width="20%">
                            <col width="15%">
                            <col width="20%">

                            <thead>
                                <tr>
                                    <th>#</th>

                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>

                                    <th>Ban</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($authors as $author)
                                <tr data-id="{{ $author->id}}">
                                    <td>{{ $author->id }}</td>
                                    <td>{{ $author->name}}</td>
                                    <td>
                                        <img class="mr-3 user-avatar-lg rounded" src="{{ $author->getPhotoUrl()}}" alt="Generic placeholder image">
                                    </td>

                                    <td>{{ $author->email}}</td>
                                    <td>{{ $author->phone_number}}</td>

                                    <td>
                                        @if(\Auth::id()!=$author->id)
                                        <div class="">{{ $author->enable}}</div>
                                        <div class="switch-button switch-button-success">
                                            <input 
                                                type="checkbox" 
                                                @if($author->ban==1)checked="" @endif 
                                                name="ban" 
                                                id="switch{{$author->id}}" 
                                                value="{{ $author->ban}}" 
                                                data-action="ban"
                                                data-id="{{ $author->id}}"
                                                >
                                                <span>
                                                <label for="switch{{ $author->id}}"></label>
                                            </span>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group ml-auto">
                                            <a href="{{ route('admin.authors.edit',['author'=>$author->id])}}"><button class="btn btn-sm btn-outline-light">Edit</button></a>
                                            <button class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#modalDiscount">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-light">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <span class="btn btn-outline-secondary" data-action="button-for-priority"  style="display: none;" data-action="change-priority-button">
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
                                    <th>Image</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>

                                    <th>Ban</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <form  action="{{route('admin.post_tags.delete')}}" 
               method="POST"
               class="modal fade right" id="modalDiscount" tabindex="-1" role="dialog" aria-labelledby="fullHeightModalRight"
               aria-hidden="true" data-backdrop="true">
            @csrf
            <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
                <input type="hidden" name="author_id" value="">
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
                                <p>@lang('Are you shure want delete author with name:')</p>
                                <h3>
                                    <strong id="author_name"></strong>
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
@push('footer_javascript')
<script>
    let contentOfDataTables = $('#users-table').DataTable({
        "pageLength": 5,
        "lengthMenu": [5, 10, 25, 50, 100, 250],
        "serverSide": true,
        "processing": true,
        "ajax": {
            "url": "{{ route('admin.authors.table_content')}}",
            "type": "POST",
            "data": {
                "_token": "{{ csrf_token()}}"
            },
            "error": function (jqXHR, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + jqXHR.statusText + "\r\n" + jqXHR.responseText + "\r\n" + ajaxOptions.responseText);
            }
        },
        "columns": [
            {"name": "id", "data": "id"},
            {"name": "name", "data": "name"},
            {"name": "image", "data": "image", "orderable": false, "searchable": false},
            {"name": "email", "data": "email"},
            {"name": "phone_number", "data": "phone_number"},
            {"name": "ban", "data": "ban", "orderable": false, "searchable": false},
            {"name": "actions", "data": "actions", "className": "text-center", "orderable": false, "searchable": false}

        ]
    });
    $('#users-table').on('click', '[data-action="delete"]', function () {
        let authorId = $(this).attr('data-id');
        let authorName = $(this).attr('data-name');

        $('#modalDiscount #author_name').text(authorName);
        $('#modalDiscount [name="author_id"]').val(authorId);
    });
    $('#modalDiscount').on('submit', function (e) {
        e.preventDefault();
        $(this).modal('hide');
        $.ajax({
            "url": "{{ route('admin.authors.delete')}}",
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
    $('#users-table').on('click', '[data-action="ban"]', function (e) {
        e.stopPropagation();
        let authorId = $(this).attr('data-id');
        let checked = $(this).attr('data-value');
        if (checked) {
            $.ajax({
                "url": "{{ route('admin.authors.ban')}}",
                "type": "POST",
                "data": {
                    "author_id": authorId,
                    "_token": "{{  csrf_token()}}"
                },
                "error": function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            }).done(function (response) {

                contentOfDataTables.ajax.reload(null, false);
            }).fail(function () {
                alert('negde je doslo do greske');
            });
        }
        if (!checked) {
            $.ajax({
                "url": "{{ route('admin.authors.not_ban')}}",
                "type": "POST",
                "data": {
                    "author_id": authorId,
                    "_token": "{{  csrf_token()}}"
                },
                "error": function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            }).done(function (response) {

                contentOfDataTables.ajax.reload(null, false);
            }).fail(function () {
                alert('negde je doslo do greske');
            });
        }


    });
</script>
@endpush