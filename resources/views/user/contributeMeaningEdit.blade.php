@extends('layout.index')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Meaning
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
                <form action="user/editMeaningContribute" method="POST" id="edit_keyword_form">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <input type="hidden" name="meaningtmp_id" value="{{ $meaningtmp->id }}" />
                    
                    <div id="edit_word">
                        <label for="meaning">Meaning - {{$meaningtmp->id}}</label><font color="red"><small><span id="errNm1">  </span></small></font>
                        <input type="text" class="form-control meaning" name="meaning" value="{{$meaningtmp->new_meaning}}" data-error="#errNm1">
                        <br>
                    </div>
                    
                    <label for="">Language</label>
                    <div class="form-group">
                        <label><input type="radio" name="new_language" value={{VIETNAMESE}} @if($meaningtmp->language==VIETNAMESE) checked @endif /> Vietnamese<br></label>
                        <label><input type="radio" name="new_language" value={{ENGLISH}} @if($meaningtmp->language==ENGLISH) checked @endif/> English<br></label>
                    </div>
                    <label for="">Type</label>
                    <div class="form-group">
                        <label><input type="radio" name="new_type" value={{NOUN}} @if($meaningtmp->type==NOUN) checked @endif /> Noun <br></label>
                        <label><input type="radio" name="new_type" value={{VERB}} @if($meaningtmp->type==VERB) checked @endif/> Verb <br></label>
                        <label><input type="radio" name="new_type" value={{ADJECTIVE}} @if($meaningtmp->type==ADJECTIVE) checked @endif/> Adjective <br></label>
                        <label><input type="radio" name="new_type" value={{PREPOSITION}} @if($meaningtmp->type==PREPOSITION) checked @endif/> Preposition <br></label>
                    </div>
                    <label>Comment</label>
                    <input class="form-control" name="new_comment" placeholder="Leave your comment here..." /><br>
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
