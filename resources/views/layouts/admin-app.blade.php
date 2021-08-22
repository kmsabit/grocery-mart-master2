<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin @yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{URL::asset('backend/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{URL::asset('backend/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{URL::asset('backend/css/vendor.bundle.addons.cssc')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{URL::asset('backend/css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{URL::asset('backend/images/logo_2H_tech.png')}}"/>
</head>
<body>
<div class="container-scroller">
    @include('admin.include.admin-navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
    @include('admin.include.admin-sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

                {{--Start Content--}}

                @yield('content')

                {{--End Content--}}
            </div>
            <!-- container-scroller -->



            <!-- plugins:js -->
            <script src="{{asset('backend/js/vendor.bundle.base.js')}}"></script>
            <script src="{{asset('backend/js/vendor.bundle.addons.js')}}"></script>
            <!-- endinject -->
            <!-- Plugin js for this page-->
            <!-- End plugin js for this page-->
            <!-- inject:js -->
            <script src="{{asset('backend/js/off-canvas.js')}}"></script>
            <script src="{{asset('backend/js/hoverable-collapse.js')}}"></script>
            <script src="{{asset('backend/js/template.js')}}"></script>
            <script src="{{asset('backend/js/settings.js')}}"></script>
            <script src="{{asset('backend/js/todolist.js')}}"></script>
            <!-- endinject -->
            <!-- Custom js for this page-->
            <script src="{{asset('backend/js/dashboard.js')}}"></script>
            <!-- End custom js for this page-->
            @yield('scripts')
</body>

</html>
