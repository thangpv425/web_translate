@extends('guest.master')
{{ App::setLocale(session('lang')) }}
@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"> Login </h3>
				</div>
				<div class="panel-body">
				
					<form action="{{ route('login') }}" method="POST">
						{{ csrf_field() }}
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
								<input type="email" name="email" class="form-control" placeholder="example@example.com" value="{{ old('email') }}">
							</div>
						</div>

						@if ($errors->first('email'))
							<div class="alert alert-danger">
								<ul>
									<li>{{ $errors->first('email') }}</li>
								</ul>
							</div>
						@endif

						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
								<input type="password" name="password" class="form-control" placeholder="Password">
							</div>
						</div>

						@if ($errors->first('password'))
							<div class="alert alert-danger">
								<ul>
									<li>{{ $errors->first('password') }}</li>
								</ul>
							</div>
						@endif					
	
						@if (session('err'))
							<div class="alert alert-danger">
								<ul>
									<li>{{ session('err') }}</li>
								</ul>
							</div>
						@endif

						<div class="form-group">
							<input type="submit" value="Login" class="btn btn-sucess pull-right">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection