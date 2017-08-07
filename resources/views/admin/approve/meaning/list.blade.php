@extends('layout.index')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Approval
                    <small>Meaning List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr class="odd gradeX" align="center">
                        <td><b>ID</b></td>
                        <td><b>OpCode</b></td>
                        <td><b>User</b></td>
                        <td><b>Keyword</b></td>
                        <td><b>Old Meaning</b></td>
                        <td><b>New Meaning</b></td>
                        <td><b>Approve</b></td>
                        <td><b>Decline</b></td>
                        <td><b>Delete</b></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $index => $row)
                    <tr class="odd gradeX" align="center">
                        <td>{{$index}}</td>
                        <td>
                            <span class="drop-comment" title="{{ $row->comment }}">
                             @if ($row->opCode == ADD)
                             ADD
                             @elseif ($row->opCode == EDIT)
                             EDIT
                             @else
                             DELETE
                             @endif
                         </span>
                        </td>
                        <td>{{ $row->user->email }}</td>
                        <td>{{ $row->keyword['keyword'] }}</td>
                        <td>{{ $row->oldMeaning['meaning'] }}</td>
                        <td>{{ $row->new_meaning }}</td>
                        <td class="center">
                             <form action="{{ route('approveOnMeaning') }}" method="POST" id="approve">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $row->id }}">
                                <input type="hidden" name="opCode" value="{{ $row->opCode }}">
                                <button type="submit" class="btn btn-success"><i class="fa fa-thumbs-o-up fa-fw"></i>Approve</button>
                            </form> 
                        </td>
                        <td class="center">
                        <form action="{{ route('declineOnMeaning') }}" method="POST" id="decline">
                            {{ csrf_field() }}
                            <label for="id"></label>
                            <input type="hidden" name="id" value="{{ $row->id }}">
                            <label for="opCode"></label>
                            <input type="hidden" name="opCode" value="{{ $row->opCode }}">
                            <button class="btn btn-warning"><i class="fa fa-thumbs-o-down fa-fw"></i>Decline</button>
                        </form>
                        </td>
                        <td class="center">
                        <form action="{{ route('deleteRequestMeaning') }}" method="POST" id="delete">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $row->id }}">
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i>Delete</button>
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
@include('js.admin.approve.list')
@endsection