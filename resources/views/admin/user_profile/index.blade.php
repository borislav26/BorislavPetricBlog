@extends('admin._layout.layout')
@section('content')
<div class="dashboard-wrapper">
    <div class="influence-profile">
        <div class="container-fluid dashboard-content ">
            <!-- ============================================================== -->
            <!-- pageheader -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h3 class="mb-2">{{ \Auth::user()->name}} Profile </h3>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.index.index')}}" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ \Auth::user()->name}}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- content -->
            <!-- ============================================================== -->
            <div class="row">
                <!-- ============================================================== -->
                <!-- profile -->
                <!-- ============================================================== -->
                <div class="col-xl-3 col-lg-3 col-md-5 col-sm-12 col-12">
                    <!-- ============================================================== -->
                    <!-- card profile -->
                    <!-- ============================================================== -->
                    <div class="card">
                        <div class="card-body">
                            <div class="user-avatar text-center d-block">
                                <img src="/themes/admin/assets/images/avatar-1.jpg" alt="User Avatar" class="rounded-circle user-avatar-xxl">
                            </div>
                            <div class="text-center">
                                <h2 class="font-24 mb-0">{{ \Auth::user()->name}}</h2>

                            </div>
                        </div>
                        <div class="card-body border-top">
                            <h3 class="font-16">Contact Information</h3>
                            <div class="">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><i class="fas fa-fw fa-envelope mr-2"></i>{{ \Auth::user()->email}}</li>
                                    <li class="mb-0"><i class="fas fa-fw fa-phone mr-2"></i>{{ \Auth::user()->phone_number}}</li>
                                </ul>
                            </div>
                        </div>


                        <div class="card-body border-top">
                            <h1 class="mb-1">{{ \Auth::user()->posts()->count()}}</h1>
                            <p>Total posts</p>
                        </div>


                    </div>
                    <!-- ============================================================== -->
                    <!-- end card profile -->
                    <!-- ============================================================== -->
                </div>
                <!-- ============================================================== -->
                <!-- end profile -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- campaign data -->
                <!-- ============================================================== -->
                <div class="col-xl-9 col-lg-9 col-md-7 col-sm-12 col-12">
                    <!-- ============================================================== -->
                    <!-- campaign tab one -->
                    <!-- ============================================================== -->
                    <div class="influence-profile-content pills-regular">

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-campaign" role="tabpanel" aria-labelledby="pills-campaign-tab">

                                <!--<div class="tab-pane fade" id="pills-msg" role="tabpanel" aria-labelledby="pills-msg-tab">-->
                                <div class="card">
                                    <h5 class="card-header">Chage your profile</h5>
                                    <div class="card-body">
                                        <form action="{{ route('admin.user_profile.change_profile',['userName'=>\Str::slug(\Auth::user()->name)])}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="offset-xl-3 col-xl-6 offset-lg-3 col-lg-3 col-md-12 col-sm-12 col-12 p-4">
                                                    <div class="form-group">
                                                        <label for="name">Your Name</label>
                                                        <input type="text" class="form-control form-control-lg @if($errors->has('name')) is-invalid @endif" id="name" name="name" placeholder="" value="{{old('name',\Auth::user()->name)}}">
                                                        @include('admin._layout.partials.form_errors',['fieldName'=>'name'])
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Your phone</label>
                                                        <input type="text" class="form-control form-control-lg @if($errors->has('phone_number')) is-invalid @endif" name="phone_number" id="email" placeholder="" value="{{old('name',\Auth::user()->phone_number)}}">
                                                        @include('admin._layout.partials.form_errors',['fieldName'=>'name'])
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="subject">Your image</label>
                                                        <input type="file" class="form-control form-control-lg @if($errors->has('image')) is-invalid @endif" id="subject" placeholder="" name="image">
                                                        @include('admin._layout.partials.form_errors',['fieldName'=>'name'])
                                                    </div>

                                                    <button type="submit" class="btn btn-primary float-right">Change</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!--</div>-->

                            </div>

                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end campaign tab one -->
                    <!-- ============================================================== -->
                </div>
                <!-- ============================================================== -->
                <!-- end campaign data -->
                <!-- ============================================================== -->
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end content -->
    <!-- ============================================================== -->
    @include('admin._layout.partials.footer')
    <!-- ============================================================== -->
    <!-- end footer -->
    <!-- ============================================================== -->
</div>
@endsection
