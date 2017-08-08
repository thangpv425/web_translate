@extends('layout.index')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Approval
                    <small>Keyword List
                    </small>
                    
                </h1>
                
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr class="odd gradeX" align="center">
                        <td><b>ID</b></td>
                        <td><b>OpCode</b></td>
                        <td><b>User</b></td>
                         <td><b>Old Keyword</b></td>
                        <td><b>New Keyword</b></td>
                        <td><b>Approve</b></td>
                        <td><b>Decline</b></td>
                        <td><b>Delete</b></td>
                    </tr>
                </thead>
                <tbody align="center">
                </tbody>
            </table>
        </div>
    <!-- /.row -->
    </div>
<!-- /.container-fluid -->
</div>
@endsection
@section('script')
    @include('js.admin.approve.keyword.list')
    @include('js.admin.approve.list_common')
@endsection