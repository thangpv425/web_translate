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
                        <thead>
                        <tr class="odd gradeX" align="center">
                            
                                <td><b>Id</b></b></td>
                                <td><b>keyword</b></td>
                                <td><b>Value</b></td>
                                <td><b>Language</b></td>
                                <td><b>Delete</b></td>
                                <td><b>Edit</b></td>
                        </tr>
                        </thead>
                        @php
                            define('VIETNAMESE',0,true);
                            define('ENGLISH',1,true);
                            $i=0;
                        @endphp   
                        @foreach($meaning as $meaning)
                            @php
                                $i++;
                            @endphp
                            @if($meaning->status == 1)
                            <tr class="odd gradeX" align="center">
                                <td>{{$i}}</td>
                                <td>{{$meaning->keyword->keyword}}</td>
                                <td>{{$meaning->meaning}}</td>
                                @if($meaning->language== VIETNAMESE )
                                    <td>Vietnamese</td>
                                @else
                                    <td>English</td>
                                @endif
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/deleteWord/{{$meaning->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="#">Edit</a></td>
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