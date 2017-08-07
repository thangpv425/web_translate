@extends('layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Edit word <small> {{$keyword->keyword}} </small>
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
                        <h3>Key word</h3>
                        <input class="form-control" name="txtKeyWord" value="{{$keyword->keyword}}" />
                    </div>

                    <h3>Meaning</h3>
                    @php $i=1;
                    @endphp
                    
                    @foreach($meaning as $meaning)
                    <br>#{{$i}}
                        @php $i++;
                        @endphp
                    <input class="form-control" name="meaning[]" value="{{$meaning->meaning}}" />
                    <input type="hidden" name="meaning_id[]" value='{{ $meaning->id }}' />
                    <br>
                    <input type="radio" name="language[]" value='0' @if($meaning->language==0) checked @endif /> Vietnamese<br>
                    <input type="radio" name="language[]" value='1' @if($meaning->language==1) checked @endif /> English<br>
                    @endforeach
                    <div class="form-group" id= "add_meaning">
                    </div>
                    <button type="submit" class="btn btn-default">Edit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
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
<script>
    function add_fields() {
        document.getElementById('add_meaning').innerHTML += '<br><label>Translate</label> \n\
<input class="form-control" name="txtMeaning" placeholder="Example: chơi" />\n\
<input type="radio" name="language" value=\'0\'/> Vietnamese<br>\n\
<input type="radio" name="language" value=\'1\'/> English<br>';
    }
</script>
