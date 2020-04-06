<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url('/themes/admin/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{url('/themes/admin/assets/vendor/fonts/circular-std/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('/themes/admin/assets/libs/css/style.css')}}">
    <link rel="stylesheet" href="{{url('/themes/admin/assets/vendor/fonts/fontawesome/css/fontawesome-all.css')}}">
    <link rel="stylesheet" href="{{url('/themes/admin/assets/vendor/charts/chartist-bundle/chartist.css')}}">
    <link rel="stylesheet" href="{{url('/themes/admin/assets/vendor/charts/morris-bundle/morris.css')}}">
    <link rel="stylesheet" href="{{url('/themes/admin/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{url('/themes/admin/assets/vendor/charts/c3charts/c3.css')}}">
    <link rel="stylesheet" href="{{url('/themes/admin/assets/vendor/fonts/flag-icon-css/flag-icon.min.css')}}">
    <link href="{{url('/themes/admin/assets/vendor/datatables/css/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css"/>
    <title>Borislav Petric Blog | @yield('seo_title')</title>
    
    @stack('head_css')
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        @include('admin._layout.partials.navbar')
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        @include('admin._layout.partials.sidebar')
        <!-- ============================================================== -->
        @yield('content')
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="{{url('/themes/admin/assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
    <!-- bootstap bundle js -->
    <script src="{{url('/themes/admin/assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <!-- slimscroll js -->
    <script src="{{url('/themes/admin/assets/vendor/slimscroll/jquery.slimscroll.js')}}"></script>
    <!-- main js -->
    <script src="{{url('/themes/admin/assets/libs/js/main-js.js')}}"></script>
    <!-- chart chartist js -->
    <script src="{{url('/themes/admin/assets/vendor/charts/chartist-bundle/chartist.min.js')}}"></script>
    <!-- sparkline js -->
    <script src="{{url('/themes/admin/assets/vendor/charts/sparkline/jquery.sparkline.js')}}"></script>
    <!-- morris js -->
    <script src="{{url('/themes/admin/assets/vendor/charts/morris-bundle/raphael.min.js')}}"></script>
    <script src="{{url('/themes/admin/assets/vendor/charts/morris-bundle/morris.js')}}"></script>
    <!-- chart c3 js -->
    <script src="{{url('/themes/admin/assets/vendor/charts/c3charts/c3.min.js')}}"></script>
    <script src="{{url('/themes/admin/assets/vendor/charts/c3charts/d3-5.4.0.min.js')}}"></script>
    <script src="{{url('/themes/admin/assets/vendor/charts/c3charts/C3chartjs.js')}}"></script>
    <script src="{{url('/themes/admin/assets/libs/js/dashboard-ecommerce.js')}}"></script>
    <script src="{{url('/themes/admin/assets/vendor/datatables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{url('/themes/admin/assets/vendor/datatables/js/dataTables.bootstrap4.min.js')}}" type="text/javascript"></script>
    @stack('footer_javascript')
</body>
 
</html>