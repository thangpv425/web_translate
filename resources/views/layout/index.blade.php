<!DOCTYPE html>
<html lang="en">
<head>
<style>
    .toolbar, .lenght, .info{
        float: left;
    }
    select#list.form-control{
        height: 30px;
        margin: auto;
        border: none;
    }

    span#box-text{
        padding-left: 5px;
    }
</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Web Translate">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>D3 Dictionary</title>
    <base href="{{asset('')}}">
    <!-- Bootstrap Core CSS -->
    {{-- <link href="admin_asset/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    <!-- MetisMenu CSS -->
    {{-- <link href="admin_asset/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet"> --}}

    <!-- Custom CSS -->
    <link href="admin_asset/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="admin_asset/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="admin_asset/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="admin_asset/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="admin_asset/dist/css/comment.css"> --}}
    <link rel="stylesheet" href="css/app.css">
    {{-- notification css --}}
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

</head>

<body>
    <div id="wrapper">

         <!-- Navigation -->
        @include('layout.header')

        <!-- Page Content -->
        @yield('content')
        <!-- /#page-wrapper -->
    @yield('modal')

    </div>

    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/app.js"></script>
    {{-- <script src="admin_asset/bower_components/jquery/dist/jquery.min.js"></script> --}}

    <!-- Bootstrap Core JavaScript -->
    {{-- <script src="admin_asset/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> --}}

    <!-- Metis Menu Plugin JavaScript -->
    <script src="admin_asset/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="admin_asset/dist/js/sb-admin-2.js"></script>

    <!-- DataTables JavaScript -->
    <script src="admin_asset/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="admin_asset/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->

    {{-- Pretty popup notification --}}
    @include('js.common')
    {{-- Custom script here --}}
    @yield('script')
</body>
</html>
