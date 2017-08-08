@extends('layout.index')
@section('content')
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Word
                            <small>List</small> 
                    <a href="admin/add/keyword" class="btn btn-default" role="button">+ Add new key word</a>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr class="odd gradeX" align="center">                           
                                <td><b>ID</b></b></td>
                                <td><b>Keyword</b></td>
                                <td><b>Meaning</b></td>
                                <td><b>Language</b></td>
                                <td><b>Delete</b></td>                                
                                <td><b>Edit</b></td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($meaning as $tl)
                            @if($tl->status == 1)
                            <tr class="odd gradeX" align="center">
                                <td>{{$tl->id}}</td>
                                <td>{{$tl->keyword->keyword}}</td>
                                <td>{{$tl->meaning}}</td>
                                @if($tl->language==0)
                                    <td>Vietnamese</td>
                                @else
                                    <td>English</td>
                                @endif
                                <td class="center"><a href="admin/deleteWord/{{$tl->id}}"><i class="fa fa-trash-o fa-fw"></i>Delete</a></td>
                                <td class="center"><a href="admin/editKeyword/{{$tl->keyword_id}}"><i class="fa fa-pencil fa-fw"></i> Edit</a></td>
                            </tr>
                            @endif
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