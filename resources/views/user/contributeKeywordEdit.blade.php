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
                <form action="user/editKeywordContribute" method="POST" id="edit_keyword_form">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <input type="hidden" name="keywordtmp_id" value="{{ $keywordtmp->id }}" />
                    
                    <div id="edit_word">
                        <label for="keyword">Keyword - {{$keywordtmp->id}}</label><font color="red"><small><span id="errNm0">  </span></small></font>
                        <input type="text" class="form-control keyword" name="new_keyword" value="{{$keywordtmp->new_keyword}}" data-error="#errNm0">
                        <br>
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
<!--@include('js.admin.validate_edit_keyword')-->
@endsection
