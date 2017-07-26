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
                        <textarea name="keyword" style='width:90%' rows = '5' placeholder="Input field"></textarea>
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
                        <div class="form-group"> 
                        @php
                            $meaning='';
                        @endphp
                        @if(isset($keyword))
                                    @php
                                    $meaning= $meaning.'&#10;+ '.$keyword.' :&#10;';
                                    @endphp
                                @endif
                                @if(isset($result))
                                    @php
                                        if($result=='nullVal')
                                            $meaning= $meaning. '* this keyword does not exist';
                                        else
                                            foreach ($result as $result)
                                                $meaning= $meaning. ' - '.$result->value.'&#10;';
                                                                         
                                    @endphp

                                @endif             
                        <textarea name="res" style='width:90%' rows = '5' placeholder="Input field" readonly>{{$meaning}}</textarea>
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