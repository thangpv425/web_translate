@extends('layout.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Your contribution
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr class="odd gradeX" align="center">
                        <th>Your action</th>
                        <th>Old Item</th>
                        <th>New Item</th>
                        <th>Status</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataKeyword as $row)
                    <tr class="primary">
                        <td>
                            @if ($row->opCode == 0) Add keyword
                            @elseif ($row->opCode == 1) Edit keyword
                            @endif
                        </td>
                        <td>
                            @if ($row->opCode == 1)
                            {{ $row->keyword['keyword'] }}
                            @endif
                        </td>

                        <td>{{ $row->new_keyword }}</td>

                        <td>
                            @if ($row->status == -1)
                            Pending
                            @elseif ($row->status == 0)
                            Admin deleted
                            @elseif ($row->status == 1)
                            Admin approved
                            @elseif ($row->status == 2)
                            Admin declined
                            @endif
                        </td>                        
                        <td>{{ $row->comment }}</td>
                        <td>{{ $row->created_at }}</td>
                        <td class="center"><a href="user/deleteKeywordContribute/{{$row->id}}"><i class="fa fa-trash-o fa-fw"></i>Cancel this contribution</a></td>
                    </tr>
                    @endforeach

                    @foreach($dataMeaning as $row)
                    <tr class="primary" >
                        <td>
                            @if ($row->opCode == 0) Add meaning
                            @elseif ($row->opCode == 1) Edit meaning for '{{$row->keyword['keyword']}}'
                            @endif
                        </td>
                        <td>
                            @if ($row->opCode == 1) 
                            Meaning: {{ $row->oldMeaning['meaning'] }}<br>
                            Language: 
                            @if ($row->oldMeaning['language']==0) 
                            Vietnamese 
                            @else English 
                            @endif 
                            <br>
                            Type: 
                            @if ($row->oldMeaning['type']==0) 
                            Noun 
                            @elseif ($row->oldMeaning['type']==1) 
                            Verb
                            @elseif ($row->oldMeaning['type']==2) 
                            Adjective
                            @elseif ($row->oldMeaning['type']==3) 
                            Preposition
                            @endif 
                            @endif
                        </td>

                        <td>
                            Meaning: {{ $row->new_meaning }}
                            <br>
                            Language:
                            @if ($row->language==0) 
                            Vietnamese 
                            @else English 
                            @endif 
                            <br>
                            Type: 
                            @if ($row->type==0) 
                            Noun 
                            @elseif ($row->type==1) 
                            Verb
                            @elseif ($row->type==2) 
                            Adjective
                            @elseif ($row->type==3) 
                            Preposition
                            @endif 
                        </td>

                        <td>
                            @if ($row->status == -1)
                            Pending
                            @elseif ($row->status == 0)
                            Admin deleted
                            @elseif ($row->status == 1)
                            Admin approved
                            @elseif ($row->status == 2)
                            Admin declined
                            @endif
                        </td>
                        <td>{{ $row->comment }}</td>
                        <td>{{ $row->created_at }}</td>
                        <td class="center"><a href="user/deleteMeaningContribute/{{$row->id}}"><i class="fa fa-trash-o fa-fw"></i>Cancel this contribution</a></td>
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
<!--@section('script')
    @include('js.admin.ListKeyword')
@endsection-->
