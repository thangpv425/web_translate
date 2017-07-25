@extends('layout.index')
@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Category
                        <small>List</small>
                    </h1>
                </div>
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th style="width: 5%;">ID</th>
                            <th>Slug</th>
                            <th>Name</th>
                            <th>Permission</th>
                            <th style="width: 10%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr class="odd gradeX" >
                            <td>{{$role->id}}</td>
                            <td>{{$role->slug}}</td>
                       		<td>{{$role->name}}</td>
                       		<td></td>
                            <td>
                            	<i class="fa fa-trash-o  fa-fw"></i><a href="#"> Delete</a>  |  <i class="fa fa-pencil fa-fw"></i> <a href="admin/role/edit/{{$role->id}}">Edit</a>
                            </td>
                        </tr>
                    @endforeach   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection