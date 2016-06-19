<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>
        @yield('title') | Laravel Blog
    </title>
    {{-- Bootstrap Core CSS --}}
    <link href="{{ asset('sb-admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- MetisMenu CSS --}}
    <link href="{{ asset('sb-admin/bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">
    {{-- Custom CSS --}}
    <link href="{{ asset('sb-admin/dist/css/sb-admin-2.css') }}" rel="stylesheet">
    {{-- Custom Fonts --}}
    <link href="{{ asset('sb-admin/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

{{-- Page Specific CSS Files --}}
@stack('css')
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        @include('admin.layouts.header')
        @include('admin.layouts.sidebar')
    </nav>
    <div id="page-wrapper">
        <!-- Content -->
        @yield('content')
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

{{-- jQuery --}}
<script src="{{ asset('sb-admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
{{-- Bootstrap Core JavaScript --}}
<script src="{{ asset('sb-admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
{{-- Metis Menu Plugin JavaScript --}}
<script src="{{ asset('sb-admin/bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>
{{-- Page Specific JavaScript Files --}}
@stack('scripts')
{{-- Custom Theme JavaScript --}}
<script src="{{ asset('sb-admin/dist/js/sb-admin-2.js') }}"></script>
</body>
</html>
