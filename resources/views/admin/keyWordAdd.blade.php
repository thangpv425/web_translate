@extends('layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Keyword
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <button id="more_fields" onclick="add_fields();" class="btn btn-default">+ Translate</button>
                <form action="" method="POST">
                    <div class="form-group">
                        <label>Key word</label>
                        <input class="form-control" name="txtKeyWord" placeholder="Example: play" />
                    </div>
                    <div class="form-group" id= "add_meaning">
                        <label>Translate</label>
                        <input class="form-control" name="txtMeaning" placeholder="Example: chơi" />
                    </div>
                    <button type="submit" class="btn btn-default">Keyword Add</button>
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
    document.getElementById('add_meaning').innerHTML += '<br><label>Translate</label> <input class="form-control" name="txtMeaning" placeholder="Example: chơi" />';
}
</script>
@endsection