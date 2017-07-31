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
                    <select class="form-control" name='idSource' style='width:50%;'>
                        <option value="o"> Japanese</option>}
                    </select><br>
                    <div class="form-group">              
                        <textarea  name="keyword" style='width:90%;resize: none;' rows='8' placeholder="Input field"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>                    
                </div>
                <div class="col-sm-6" >
                    <fieldset >     
                        <legend>Result</legend>
                        <select class="form-control" name='language' style='width:50%;'>
                            @if(isset($language))
                                <option value="0" @if($language==0) selected @endif> VietNamese</option>
                                <option value="1" @if($language==1) selected @endif> English</option>                                                                                            
                            @else
                                <option value="0" selected> VietNamese</option>
                                <option value="1"> English</option>
                            @endif
                        </select><br>
                        <div class="form-group"> 
                        @php
                            $meaning='';
                        @endphp
                        @if(isset($keyword))
                                    @php
                                    $meaning= $meaning.'&#10;+ '.$keyword->keyword.' :&#10;';
                                    @endphp
                                @endif
                                @if(isset($result))
                                    @php                                        
                                        if($result==NOT_EXIST)
                                            $meaning= $meaning. '* sorry! this keyword does not exist';
                                        else
                                            foreach ($result as $result)
                                                $meaning= $meaning. ' - '.$result->meaning.'&#10;';
                                                                         
                                    @endphp

                                @endif  
                        <textarea name="res" style='width:90%;resize: none;'  rows = '8' placeholder="Input field" readonly>{{$meaning}}</textarea>
                    </div>
                    <a href="user/keywordAdd" class="btn btn-primary">Add word</a> 
                    @if(isset($result) && $result!= NOT_EXIST) 
                        <a href="user/keywordEdit/{{$keyword->id}}" class="btn btn-primary">Edit</a> 
                        <a href="" class="btn btn-primary">Delete</a> 
                    @endif

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