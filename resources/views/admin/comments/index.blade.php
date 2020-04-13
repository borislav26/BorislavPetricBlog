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
                    <h2 class="pageheader-title">@lang('Comments list') </h2>

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index.index')}}" class="breadcrumb-link">@lang('Dashboard')</a></li>

                                <li class="breadcrumb-item active" aria-current="page">@lang('Comments')</li>
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
                    @lang('Comments list')

                </h5>

                <div class="card-body">
                    <div class="table-responsive" >
                        <table class="table table-striped table-bordered first" id="comments-table-field">
                            <col width="5%">
                            <col width="15%">
                            <col width="15%">
                            <col width="25%">
                            <col width="30%">
                            <col width="10%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Author of comment</th>
                                    <th>Email of author</th>
                                    <th>Content of comment</th>
                                    <th>Post where is comment</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody id="comments-table-field-body">


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Author of comment</th>
                                    <th>Email of author</th>
                                    <th>Content of comment</th>
                                    <th>Post where is comment</th>
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
    @include('admin._layout.partials.footer')
    <!-- ============================================================== -->
    <!-- end footer -->
    <!-- ============================================================== -->
</div>
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fullHeightModalRight">Launch
  modal</button>-->

<!--Modal: modalDiscount-->
<div class="modal fade right" id="modalDiscount" tabindex="-1" role="dialog" aria-labelledby="fullHeightModalRight"
     aria-hidden="true" data-backdrop="true">
    <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading">Discount offer:
                    <strong>10% off</strong>
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
                            <i class="fas fa-gift fa-4x"></i>
                        </p>
                    </div>

                    <div class="col-9">
                        <p>Sharing is caring. Therefore, from time to time we like to give our visitors small gifts. Today is
                            one of those days.</p>
                        <p>
                            <strong>Copy the following code and use it at the checkout. It's valid for
                                <u>one day</u>.</strong>
                        </p>
                        <h2>
                            <span class="badge">v52gs1</span>
                        </h2>

                    </div>
                </div>
            </div>

            <!--Footer-->
            <div class="modal-footer flex-center">
                <a href="https://mdbootstrap.com/products/jquery-ui-kit/" class="btn btn-danger">Get it
                    now
                    <i class="far fa-gem ml-1 white-text"></i>
                </a>
                <a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">No, thanks</a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
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
            "url": "{{ route('admin.comments.table_content')}}",
            "type": "get",
            "data": {

            },
            "error": function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        }).done(function (response) {
            $('#commennts-table-field').html(response);

        }).fail(function (reponse) {
            alert(response);
        });
    }
    $('[data-action="show-change-priority-buttons"]').on('click', function () {
        $(this).hide();
        $('body [data-action="change-priority-button"]').show();
    });
//    $('#table-for-comments').sortable({
//        "handle": '.fa-sort',
//        "update": function (event, ui) {
//            let priorities = $('#table-for-post-categories').sortable('toArray', {
//                "attribute": 'data-id'
//            });
//            $('[data-form="change-priority"] #id-for-sorting').val(priorities);
//        },
//
//    });
//    loadTableContent();
//

    let contentOfDataTables = $('#comments-table-field').DataTable({
        "pageLength": 5,
        "lengthMenu": [5, 10, 25, 50, 100, 250],
        "serverSide": true,
        "processing": true,
        "responsive": true,
        "ajax": {
            "url": "{{ route('admin.comments.table_content')}}",
            "type": "POST",
            "data": {
                "_token": "{{ csrf_token()}}"
            },
//            "data": function (dataFromDataTable) {
//                dataFromDataTable['_token'] = "{{ csrf_token() }}";
//                dataFromDataTable['status'] = $('#entities-filter-form [name="status"]').val();
//                dataFromDataTable['email'] = $('#entities-filter-form [name="email"]').val();
//                dataFromDataTable['name'] = $('#entities-filter-form [name="name"]').val();
//
//
//            },
            "error": function (jqXHR, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + jqXHR.statusText + "\r\n" + jqXHR.responseText + "\r\n" + ajaxOptions.responseText);
            }
        },
        "columns": [
            {"name": "id", "data": "id"},
            {"name": "author", "data": "author", "orderable": false, "searchable": false},
            {"name": "email", "data": "email", "orderable": false, "searchable": false},
            {"name": "content", "data": "content", "orderable": false, "searchable": false},

            {"name": "post_info", "data": "post_info"},
            {"name": "actions", "data": "actions", "className": "text-center"}

        ]
    });

    $('#comments-table-field').on('click', '[data-action="enable"]', function (e) {
        e.stopPropagation();
        let commentId = $(this).attr('data-id');
        let checked = $(this).attr('data-value');
        if (checked == 1) {
            $.ajax({
                "url": "{{ route('admin.comments.disable')}}",
                "type": "POST",
                "data": {
                    "comment_id": commentId,
                    "_token": "{{  csrf_token()}}"
                },
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
        }
        if (checked == 0) {
            $.ajax({
                "url": "{{ route('admin.comments.enable')}}",
                "type": "POST",
                "data": {
                    "comment_id": commentId,
                    "_token": "{{  csrf_token()}}"
                },
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
        }


    });
</script>
@endpush('footer_javascript')