@extends('layout.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <form action="search" method="POST" role="form">
            {{ csrf_field() }}
            <legend>Search</legend>

            <div class="form-group">
                <label for="">Enter keyword</label>
                <input type="text" class="form-control" name='keyword' placeholder="Input field">

            </div>




            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        @if(isset($result))
        <form method="POST" role="form">
            <br><br><br>
           <legend>Result: </legend>

           <fieldset class="col-md-12">     
            <legend>{{$keyword}}</legend>

            <div class="panel panel-default">
                <div class="panel-body">

                    @php
                    echo '&#10;';
                    for($i=0;$i<count($result);$i++){
                        echo '- '.$result[$i]->value.'<br>';
                    }
                    @endphp

                </div>
            </div>

        </fieldset>




    </form> 
    @endif 
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
@endsection