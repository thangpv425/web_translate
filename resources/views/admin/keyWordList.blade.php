@extends('layout.index')
@section('content')
	<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Keyword-Meaning
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Keyword</th>
                                <th>Meaning</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($meaning as $tl)
                            <tr class="odd gradeX" align="center">
                                <td>{{$tl->keyword->value}}</td>
                                <td>{{$tl->value}}</td>
                                
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="#"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/keywordEdit{{$tl->keyword->id}}">Edit</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-default" onclick="location.href='admin/keywordAdd';"> + Add new Keyword</button>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection