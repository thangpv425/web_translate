@extends('layout.index')
@section('content')
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="page-header row">
                    <h1 class="col-6">Word list</h1>
                    <div class="col-6"><a href="admin/keywordAdd" class="btn btn-default" role="button">+ Add new key word</a>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr class="odd gradeX" align="center">
                            
                                <td><b>Id</b></b></td>
                                <td><b>keyword</b></td>
                                <td><b>Value</b></td>
                                <td><b>Delete</b></td>
                                <td><b>Edit</b></td>
                            </tr>
                        </thead>
                        </tbody>
                        <?php //echo count($keyword); 
                            $count=0;
                        ?>
                        @foreach($keyword as $tl)
                            @if($tl->status == 1)
                            <?php $count++; ?>
                            <tr class="odd gradeX" align="center">
                                <td>{{$count}}</td>
                                <td>{{$tl->keyword->value}}</td>
                                <td>{{$tl->value}}</td>
                                
                                <td class="center"><a href="admin/delete_word/{{$tl->meaning_id}}"><i class="fa fa-trash-o  fa-fw"></i> Delete</a></td>
                                <td class="center"><a href="admin/keywordEdit/{{$tl->keyword_id}}"> <i class="fa fa-pencil fa-fw"></i> Edit</a></td>
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