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
                        <th>Date</th>
                        <th>Your action</th>
                        <th>Old Item</th>
                        <th>New Item</th>
                        <th>Status</th>
                        <th>Comment</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataKeyword as $row)
                    <tr class="primary">
                        <td>{{ $row->created_at }}</td>
                        <td>
                            @if ($row->opCode == ADD) Add keyword
                            @elseif ($row->opCode == EDIT) Edit keyword
                            @endif
                        </td>
                        <td>
                            @if ($row->opCode == EDIT)
                            {{ $row->keyword['keyword'] }}
                            @endif
                        </td>

                        <td>{{ $row->new_keyword }}</td>

                        <td>
                            @if ($row->status == IN_QUEUE)
                            Pending
                            @elseif ($row->status == DELETED)
                            Admin deleted
                            @elseif ($row->status == APPROVED)
                            Admin approved
                            @elseif ($row->status == DECLINED)
                            Admin declined
                            @endif
                        </td>
                        <td>{{ $row->comment }}</td>
                        <td class="center">

                            @if ($row->status == IN_QUEUE)
                            <a href="user/deleteKeywordContribute/{{$row->id}}"><i class="fa fa-trash-o fa-fw"></i>Cancel this contribution</a>
                            @elseif ($row->status == DECLINED)
                            <a href="user/editKeywordContribute/{{$row->id}}"><i class="fa fa-pencil fa-fw"></i>Edit this contribution</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                    @foreach($dataMeaning as $row)
                    <tr class="primary" >
                        <td>{{ $row->created_at }}</td>
                        <td>
                            @if ($row->opCode == ADD) Add meaning for '{{$row->keyword['keyword']}}'
                            @elseif ($row->opCode == EDIT) Edit meaning for '{{$row->keyword['keyword']}}'
                            @endif
                        </td>
                        <td>
                            @if ($row->opCode == EDIT) 
                            Meaning: {{ $row->oldMeaning['meaning'] }}<br>
                            Language: 
                            @if ($row->oldMeaning['language']==VIETNAMESE) 
                            Vietnamese 
                            @else English 
                            @endif 
                            <br>
                            Type: 
                            @if ($row->oldMeaning['type']==NOUN) 
                            Noun 
                            @elseif ($row->oldMeaning['type']==VERB) 
                            Verb
                            @elseif ($row->oldMeaning['type']==ADJECTIVE) 
                            Adjective
                            @elseif ($row->oldMeaning['type']==PREPOSITION) 
                            Preposition
                            @endif 
                            @endif
                        </td>

                        <td>
                            Meaning: {{ $row->new_meaning }}
                            <br>
                            Language:
                            @if ($row->language == VIETNAMESE) 
                            Vietnamese 
                            @else English 
                            @endif 
                            <br>
                            Type: 
                            @if ($row->type == NOUN) 
                            Noun 
                            @elseif ($row->type == VERB) 
                            Verb
                            @elseif ($row->type == ADJECTIVE) 
                            Adjective
                            @elseif ($row->type == PREPOSITION) 
                            Preposition
                            @endif 
                        </td>

                        <td>
                            @if ($row->status == IN_QUEUE)
                            Pending
                            @elseif ($row->status == DELETED)
                            Admin deleted
                            @elseif ($row->status == APPROVED)
                            Admin approved
                            @elseif ($row->status == DECLINED)
                            Admin declined
                            @endif
                        </td>
                        <td>{{ $row->comment }}</td>
                        <td class="center">

                            @if ($row->status == IN_QUEUE)
                            <a href="user/deleteMeaningContribute/{{$row->id}}"><i class="fa fa-trash-o fa-fw"></i>Cancel this contribution</a>
                            @endif
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
@include('js.admin.ListKeyword')
@endsection
