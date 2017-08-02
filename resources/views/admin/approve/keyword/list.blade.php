@extends('layout.index')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Approval
                    <small>Keyword List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            @if (session('mess'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ session('mess') }}</li>
                </ul>
            </div>
            @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr class="odd gradeX" align="center">
                        <td><b>ID</b></td>
                        <td><b>OpCode</b></td>
                        <td><b>User</b></td>
                        <td><b>Old Keyword</b></td>
                        <td><b>New Keyword</b></td>
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
                             {{ $row->keyword['keyword'] }}
                             @endif
                        </td>
                        <td>{{ $row->new_keyword }}</td>
                        <td class="center">
                             <form action="{{ route('approveOnKeyword') }}" method="POST" id="approve">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $row->id }}">
                                <input type="hidden" name="opCode" value="{{ $row->opCode }}">
                                <button type="submit" class="btn btn-success"><i class="fa fa-thumbs-o-up fa-fw"></i>Approve</button>
                            </form> 
                        </td>
                        <td class="center">
                         <form action="{{ route('declineOnKeyword') }}" method="POST" id="decline">
                            {{ csrf_field() }}
                            <label for="id"></label>
                            <input type="hidden" name="id" value="{{ $row->id }}">
                            <label for="opCode"></label>
                            <input type="hidden" name="opCode" value="{{ $row->opCode }}">
                            <button class="btn btn-warning"><i class="fa fa-thumbs-o-down fa-fw"></i>Decline</button>
                        </form>
                        </td>
                        <td class="center">
                        <form action="{{ route('deleteRequest') }}" method="POST" id="delete">
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
<script>
$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#decline').on('submit', function(e){
        e.preventDefault();
        var cmt = prompt("Please enter comment", "This word is ...");
        var id = $('input[name=id]').val();
        var opCode = $('input[name=opCode]').val();
        var url = $(this).attr('action');
        var post = $(this).attr('method');
        $.ajax({
            type : post,
            url : url,
            data : {'id' : id, 'opCode' : opCode, 'cmt' : cmt},
            success:function(data){
                console.log(data)
            }
        });
        location.reload();
    });
});
</script>
@endsection