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
</script>
@endpush