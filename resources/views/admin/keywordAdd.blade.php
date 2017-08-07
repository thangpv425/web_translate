
@extends('layout.index')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Keyword
                    <small>Add</small>
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
                <form action="{{ route('adminAddKeyword') }}" method="POST" id="add_keyword_form">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div id="add_word">
                        <label for="keyword">Keyword</label><font color="red"><small><span id="errNm0">  </span></small></font>
                        <input type="text" class="form-control keyword" name="keyword" placeholder="Example: play" data-error="#errNm0">
                        <br>
                        <label>Meaning</label><font color="red"><small><span id="errNm1"> </span></small></font>
                        <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control meaning" name="translate[1][meaning]" placeholder="VD: chơi" data-error="#errNm1">
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="more_meaning" type="button">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </span>
                        </div>
                        </div>
                        <label for="">Language</label>
                        <div class="form-group">
                            <label><input type="radio" name="translate[1][language]" value='0' checked /> Vietnamese<br></label>
                            <label><input type="radio" name="translate[1][language]" value='1' /> English<br></label>
                        </div>
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
@include('js.validate_add_keyword')
@endsection