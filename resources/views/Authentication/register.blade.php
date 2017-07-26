@extends('layouts.master')
@section('content')
<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"> Register </h3>
				</div>
				<div class="panel-body">
					<form action="{{ route('register') }}" method="POST">
						@if(session('err'))
							<div class="alert alert-warning" role="alert"> { { session('err')}}</div>
						@endif
						{{ csrf_field() }}
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
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
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								<input type="text" name="first_name" class="form-control" placeholder="First Name">
							</div>
						</div>



						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								<input type="text" name="last_name" class="form-control" placeholder="Last Name">
							</div>
						</div>

						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-lock"></i></span>
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

						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-lock"></i></span>
								<input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation">
							</div>
						</div>

						@if ($errors->first('password_confirmation'))
							<div class="alert alert-danger">
								<ul>
									<li>{{ $errors->first('password_confirmation') }}</li>
								</ul>
							</div>
						@endif

						<div class="form-group">
							<input type="submit" value="Register" class="btn btn-sucess pull-right">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection