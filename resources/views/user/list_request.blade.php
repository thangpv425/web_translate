@extends('layout.index')
@section('content')
<style>
    select#list.form-control{
        height: 30px;
        margin: auto;
        border: none;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Declined
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
                        <td><b>Old Keyword</b></td>
                        <td><b>New Keyword</b></td>
                        <td><b>Edit</b></td>
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
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o fa-fw"></i>Edit</button>
                            </form>
                        </td>
                        <td class="center">
                        <form action="{{ route('deleteRequest') }}" method="POST" id="delete">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $row->id }}">
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-fw"></i>Delete</button>
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
@endsection