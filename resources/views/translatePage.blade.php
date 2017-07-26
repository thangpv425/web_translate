@extends('layout.index')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <br><br>
        <form action="search" method="POST" role="form">

            <div class="row">
                <div class="col-sm-6" >    

                    {{ csrf_field() }}
                    <legend>Enter keyword</legend>
                    <select class="form-control" name='idSource' style='width:300px;'>
                        <option value="o"> Japanese</option>}
                    </select><br>
                    <div class="form-group">              
                        <textarea name="keyword" cols='73' rows = '5' placeholder="Input field">
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>                    
                </div>
                <div class="col-sm-6" >
                    <fieldset >     
                        <legend>Result</legend>
                        <select class="form-control" name='idLanguage' style='width:300px;'>
                            @if(isset($selected))
                                
                                @if($selected==0)
                                   <option value="0" selected="selected"> VietNamese</option>
                                    <option value="1"> English</option>
                                @else
                                    <option value="0" > VietNamese</option>
                                    <option value="1" selected="selected"> English</option>

                                @endif                               
                                
                            @else
                                <option value="0"> VietNamese</option>
                                <option value="1" selected="selected"> English</option>
                            @endif
                        </select><br>
                        <div class="panel panel-default">
                            <div class="panel-body" style="background-color:lavender;height:120px">
                                @if(isset($keyword))
                                    @php
                                    echo '<h4>'.$keyword.':</h4>';
                                    @endphp
                                @endif
                                @if(isset($result))
                                    @php

                                        if($result=='nullVal')
                                            echo '<font color=\'red\'>* this keyword does not exist</font>';
                                        else
                                            foreach ($result as $result)
                                                echo '- '.$result->value.'<br>';
                                                                         
                                    @endphp

                                @endif

                            </div>
                        </div>

                    </fieldset>                    
                </div>
            </div>
        </form>
        @if(count($errors)>0)
        <br>
        <div class="alert alert-danger">
            <center>
                @foreach($errors->all() as $err)
                {{$err}}<br>
                @endforeach
            </center>
            
        </div>
        @endif
    </div>
</div>
@endsection