@extends('layout.index')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>List</small><span style="float: right;"><a class="btn btn-info" href="admin/create">Add</a></span>
                    </h1>

                </div>
                @if(session('notification'))
                    <div class="alert alert-success">
                        {{session('notification')}}
                    </div>
                @endif
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th style="width: 5%;">ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    @foreach($users as $user)
                        <tr class="odd gradeX" align="center">
                            <td>{{$i++}}</td>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->email}}</td>
                            <td class="" style="width: 10%;">
                                <i class="fa fa-pencil fa-fw"></i><a href="user/edit/{{$user->id}}">Edit</a> |
                                <i class="fa fa-trash-o  fa-fw"></i><a href="user/delete/{{$user->id}}" onclick = "return confirm('Are you sure?')"> Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
    </div>
@endsection
