@extends('layout.index')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Keyword
                    <small>Edit</small>
                </h1>
            </div>

            <div class="col-sm-4">
                @if(count($errors)>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                    {{$err}}<br>
                    @endforeach
                </div>
                @endif
                <form action="{{ route('keywordEditRoute') }}" method="POST" id="edit_keyword_form">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <input type="hidden" name="keyword_id" value="{{ $keyword->id }}" />
                    
                    <div id="edit_word">
                        <label for="keyword">Keyword - {{$keyword->id}}</label><font color="red"><small><span id="errNm0">  </span></small></font>
                        <input type="text" class="form-control keyword" name="keyword" value="{{$keyword->keyword}}" data-error="#errNm0">
                        <br>

                        @php 
                        $i=1;
                        @endphp

                        @foreach($meaning as $meaning)
                        <label>Meaning</label><font color="red"><small><span id="errNm1"> </span></small></font>
                        <div class="form-group" id="number{{$i}}">
                            <div class="input-group">
                                <input type="text" class="form-control meaning" name="translate[{{$i}}][meaning]" value="{{$meaning->meaning}}" data-error="#errNm{{$i}}">
                                <input type="hidden" name="translate[{{$i}}][meaning_id]" value="{{ $meaning->id }}" />
                            </div>
                            <label for="">Language</label>
                            <div class="form-group">
                                <label><input type="radio" name="translate[{{$i}}][language]" value='0' @if($meaning->language==0) checked @endif /> Vietnamese<br></label>
                                <label><input type="radio" name="translate[{{$i}}][language]" value='1' @if($meaning->language==1) checked @endif /> English<br></label>
                            </div>
                            <label for="">Type</label>
                            <div class="form-group">

                                <label><input type="radio" name="translate[{{$i}}][type]" value='0' @if($meaning->type==0) checked @endif /> Noun <br></label>
                                <label><input type="radio" name="translate[{{$i}}][type]" value='1' @if($meaning->type==1) checked @endif /> Verb <br></label>
                                <label><input type="radio" name="translate[{{$i}}][type]" value='2' @if($meaning->type==2) checked @endif /> Adjective <br></label>
                                <label><input type="radio" name="translate[{{$i}}][type]" value='3' @if($meaning->type==3) checked @endif /> Preposition <br></label>

                            </div>
                            @php $i++;@endphp
                        </div>
                        @endforeach
                    <hr>
                    </div> 
                    <button id="submit" type="submit" class="btn btn-success">
                        <i class="fa fa-floppy-o fa-fw" aria-hidden="true"></i>Save
                    </button>
                    <button type="reset" class="btn btn-danger"><i class="fa fa-refresh fa-fw"></i>Reset</button>
                </form>

            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection

@section('script')
@include('js.admin.validate_edit_keyword')
@endsection
