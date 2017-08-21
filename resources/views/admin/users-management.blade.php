@extends('layout.index')
@section('content')
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Users
                            <small>Management</small> 
                        </h1>
                        @if(session('notification'))
                            <div class="alert alert-success">
                                {{session('notification')}}
                            </div>
                        @endif
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr class="odd gradeX" align="center">                           
                                <td><b>ID</b></b></td>
                                <td><b>Email</b></td>
                                <td><b>Name</b></td>
                                <td><b>Role</b></td>
                                <td><b>Last Login</b></td>
                                <td><b>Action</b></td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr class="odd gradeX" align="center">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->first_name." ".$user->last_name }}</td>
                                <td>
                                    @if (Sentinel::findById($user->id)->inRole('admin'))
                                        Admin
                                    @else
                                        User
                                    @endif
                                </td>
                                <td>{{ $user->last_login }}</td>
                                <td>
                                    <form action="
                                        @if (Sentinel::findById($user->id)->inRole('admin'))
                                            {{ route('users-management.cancel-admin') }}
                                        @else
                                            {{ route('users-management.make-admin') }}
                                        @endif" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <button class="btn 
                                            @if (Sentinel::findById($user->id)->inRole('admin')) 
                                                btn-danger
                                            @else
                                                btn-primary
                                            @endif
                                        " style="border: none; width: 133.62px;" type="submit">
                                            <i class="fa fa-bolt fa-fw" aria-hidden="true"></i>
                                            @if (Sentinel::findById($user->id)->inRole('admin'))
                                                Cancel Admin
                                            @else
                                                Make Admin
                                            @endif
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection
@section('script')
@include('js.admin.ListKeyword')
@endsection