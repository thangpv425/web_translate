@extends('layout.index')
@section('content')
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Word list
                            
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <tr class="odd gradeX" align="center">
                            
                                <td><b>Id</b></b></td>
                                <td><b>keyword</b></td>
                                <td><b>Value</b></td>
                                <td><b>Delete</b></td>
                                <td><b>Edit</b></td>
                            </tr>
                            
                        @foreach($keyword as $tl)
                            @if($tl->status == 1)
                            <tr class="odd gradeX" align="center">
                                <td>{{$tl->meaning_id}}</td>
                                <td>{{$tl->keyword->value}}</td>
                                <td>{{$tl->value}}</td>
                                
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/delete_word/{{$tl->meaning_id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/keywordEdit/{{$tl->keyword_id}}">Edit</a></td>
                            </tr>
                            @endif
                        @endforeach
                        <a href="admin/keywordAdd" class="btn btn-default" role="button">+ Add new key word</a>
                        
                    </table>
                    
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection