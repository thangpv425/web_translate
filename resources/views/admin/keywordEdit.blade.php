@extends('layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>Keyword 
                    {{$keyword->value}} </small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if(count($errors)>0)
                    <div class="alert alert-danger">
                       @foreach($errors->all() as $err)
                       {{$err}}<br>
                       @endforeach
                    </div>
                @endif
                <form action="{{ route('keywordEditRoute') }}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <input type="hidden" name="keyword_id" value='{{ $keyword['keyword_id'] }}' />
                    <div class="form-group">
                        <label>Key word</label>
                        <input class="form-control" name="txtKeyWord" value="{{$keyword->value}}" />
                    </div>
                    
                    <label>Translate</label>
                    <input class="form-control" name="txtMeaning" value="{{$meaning->value}}" />
                    <input type="radio" name="language" value='0' @if($meaning->language==0) checked @endif /> Vietnamese<br>
                    <input type="radio" name="language" value='1' @if($meaning->language==1) checked @endif /> English<br>
                    
                    <div class="form-group" id= "add_meaning">
                    </div>
                    <button type="submit" class="btn btn-default">Edit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
