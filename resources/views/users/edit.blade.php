@extends('layout.index')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <h1 class="page-header">
                        <small>Edit</small>
                    </h1>
                </div>

                <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors) >0 )
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif
                    @if(session('notification'))
                        <div class="alert alert-success">
                            {{session('notification')}}
                        </div>
                    @endif
                    <form action="user/edit/{{$user->id}}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>First Name</label>
                            <input class="form-control" name="first_name"  value="{{$user->first_name}}" />
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" name="last_name"  value="{{$user->last_name}}" />
                        </div>
                        <a class="btn btn-default" href="user/view/{{$user->id}}">View</a>
                        <button class="btn btn-success">Save</button>
                        <button type="reset" class="btn btn-primary">Reset</button>
                    <form>
                </div>

            </div>
        </div>
    </div>
@endsection
