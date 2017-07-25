@extends('layout.index')
@section('content')
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
                            <tr align="center">
                                <th>ID</th>
                                <th>OpCode</th>
                                <th>User</th>
                                <th>Keyword</th>
                                <th>Old Meaning</th>
                                <th>New Meaning</th>
                                <th>Approve</th>
                                <th>Decline</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                            <tr class="odd gradeX" align="center">
                                <td>{{$row->meaning_temp_id}}</td>
                                <td>
                                	@if ($row->opCode == 0)
                                		Add
                                	@elseif ($row->opCode == 1)
                                		Edit
                                	@else
                                		Delete
                                	@endif
                                </td>
                                <td>{{ $row->user->email }}</td>
                                <td>{{ $row->keyword['value'] }}</td>
                                <td>{{ $row->oldMeaning['value'] }}</td>
                                <td>{{ $row->new_meaning }}</td>
                                <td class="center">
                                	<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                	<a href="{{ route('approveOnMeaning', ['id' => $row->meaning_temp_id, 'opCode'=>$row->opCode]) }}"> Approve </a>
                                </td>
	                                <td class="center">
	                                <i class="fa fa-thumbs-o-down"></i> 
	                                <a href="{{ route('declineOnMeaning', ['id' => $row->meaning_temp_id, 'opCode' => $row->opCode]) }}"> Decline </a>
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