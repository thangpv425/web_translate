@extends('layout.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Approval
                    <small>Keyword List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr class="odd gradeX" align="center">
                        <th>ID</th>
                        <th>OpCode</th>
                        <th>User</th>
                        <th>Old Keyword</th>
                        <th>New Keyword</th>
                        <th>Approve</th>
                        <th>Decline</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $row)
                    <tr class="odd gradeX" align="center">
                        <td>{{$row->keyword_temp_id}}</td>
                        <td>
                            <span class="drop-comment" title="{{ $row->comment }}">
                               @if ($row->opCode == 0)
                               Add
                               @elseif ($row->opCode == 1)
                               Edit
                               @else
                               Delete
                               @endif
                           </span>
                       </td>
                       <td>{{ $row->user->email }}</td>
                       <td>
                           @if ($row->opCode == 0)

                           @else
                           {{ $row->keyword['value'] }}
                           @endif
                       </td>
                       <td>{{ $row->new_keyword }}</td>
                       <td class="center">
                           <a href="{{ route('approveOnKeyword', ['id' => $row->keyword_temp_id, 'opCode'=>$row->opCode]) }}"><i class="fa fa-thumbs-o-up fa-fw" aria-hidden="true"></i> Approve </a>
                       </td>
                       <td class="center">
                           <a href="{{ route('declineOnKeyword', ['id' => $row->keyword_temp_id, 'opCode' => $row->opCode]) }}"><i class="fa fa-thumbs-o-down fa-fw"></i>  Decline </a>
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