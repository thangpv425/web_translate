@extends('layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Keyword
                    <!--<small>{{$keyword->value}}</small>-->
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="form-group">
                        <label>Key word</label>
                        <input class="form-control" name="txtKeyWord" />
                    </div>
                    
                    <label>Translate</label>
                    <input class="form-control" name="txtMeaning"  />
                    <input type="radio" name="language" value='0' /> Vietnamese<br>
                    <input type="radio" name="language" value='1' /> English<br>
                    
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

@section('script')
<script>
function add_fields() {
    document.getElementById('add_meaning').innerHTML += '<br><label>Translate</label> \n\
<input class="form-control" name="txtMeaning" placeholder="Example: chơi" />\n\
<input type="radio" name="language" value=\'0\'/> Vietnamese<br>\n\
<input type="radio" name="language" value=\'1\'/> English<br>';
    $count_box++;
}
</script>
@endsection