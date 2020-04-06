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
                    <h2 class="pageheader-title">@lang('Slider items list') </h2>

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index.index')}}" class="breadcrumb-link">@lang('Dashboard')</a></li>

                                <li class="breadcrumb-item active" aria-current="page">@lang('Slider Items')</li>
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
                    @lang('Slider items list')
                    <a href="{{ route('admin.slider_items.add')}}"><button style="float: right" class="btn btn-success">@lang('Add new slider item')</button></a>
                    <form style="display: none; float: right" class="btn-group" action="{{route('admin.slider_items.change_order')}}" method="post" id="change-order-form">
                        @csrf
                        <input type="hidden" id="values-of-slider-items" value="" name="orders">
                        <button  class="btn btn-dark" data-action="change-change" type="submit">@lang('Save orders')</button>
                        <button  class="btn btn-dark" data-action="cancel" type="button">@lang('Cancel')</button>
                    </form>
                    <button style="float: right" class="btn btn-dark" data-action="show-change-order-buttons">@lang('Change order')</button>

                </h5>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                            <col width="5%">
                            <col width="15%">
                            <col width="10%">
                            <col width="20%">
                            <col width="15%">
                            <col width="15%">
                            <col width="30%">
                            <tr>
                                <th>#</th>

                                <th>Title</th>
                                <th>Image</th>
                                <th>Url</th>
                                <th>Name of button</th>
                                <th>Enable</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody id="table-for-slider-items">
                                @foreach($sliderItems as $item)
                                <tr data-id="{{ $item->id}}">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->title}}</td>
                                    <td>
                                        <img class="mr-3 user-avatar-lg rounded" src="{{ $item->image}}" alt="Generic placeholder image">
                                    </td>

                                    <td>{{ $item->url}}</td>
                                    <td>{{ $item->button_name}}</td>
                                    <td>
                                        <div class="switch-button switch-button-success">
                                            <div class="text-center">{{ $item->enable}}</div>
                                            <input type="checkbox"  @if($item->enable==1) checked=""  @endif name="enable" id="switch{{$item->id}}" value="{{ $item->enable}}">
                                                   <span>
                                                <label for="switch{{ $item->id}}"></label>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group ml-auto">
                                            <a href="{{ route('admin.slider_items.edit',['sliderItem'=>$item->id])}}"><button class="btn btn-sm btn-outline-light">Edit</button></a>
                                            <button 
                                                class="btn btn-sm btn-outline-light" 
                                                data-toggle="modal" 
                                                data-target="#modalDiscount" 
                                                data-action="delete"
                                                data-id="{{$item->id}}"
                                                data-name="{{ $item->title}}"
                                                >
                                                <i class="far fa-trash-alt"></i>
                                            </button>

                                            <span class="btn btn-outline-secondary" 
                                                  style="display: none;" 
                                                  data-action="change-order-button"

                                                  >
                                                <i class="fas fa-sort">Change order</i>
                                            </span>
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
                                    <th>Url</th>
                                    <th>Name of button</th>
                                    <th>Enable</th>
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

<form  action="{{route('admin.slider_items.delete')}}" 
       method="POST"
       class="modal fade right" id="modalDiscount" tabindex="-1" role="dialog" aria-labelledby="fullHeightModalRight"
       aria-hidden="true" data-backdrop="true">
    @csrf
    <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
        <input type="hidden" name="slider_id" value="">
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
                        <p>@lang('Are you shure want delete slider with name:')</p>
                        <h3>
                            <strong id="slider_title"></strong>
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
    $('[data-action="show-change-order-buttons"]').on('click', function () {
        $(this).hide();
        $('#change-order-form').show();

        $('#table-for-slider-items [data-action="change-order-button"]').show();
    });
    $('#change-order-form [data-action="cancel"]').on('click', function () {
        $('[data-action="show-change-order-buttons"]').show();
        $('#change-order-form').hide();



        $('#table-for-slider-items [data-action="change-order-button"]').hide();
    });
    $('#table-for-slider-items').sortable({
        "handle": '.fa-sort',
        "update": function (event, ui) {
            let priorities = $('#table-for-slider-items').sortable('toArray', {
                "attribute": 'data-id'
            });
            $('#values-of-slider-items').val(priorities);
        }

    });
        $('#table-for-slider-items [data-action="delete"]').on('click', function () {
        let categoryId = $(this).attr('data-id');
        let categoryName = $(this).attr('data-name');

        $('#modalDiscount #slider_title').text(categoryName);
        $('#modalDiscount [name="slider_id"]').val(categoryId);
    });
</script>
@endpush('footer_javascript')