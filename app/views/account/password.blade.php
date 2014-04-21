@extends('layout.main')

@section('content')
	Change Password
	<div class="container">
	<form action="{{ URL::route('account-change-password-post') }}" method="post" class="form-signin" role="form">

        <h2 class="form-signin-heading">Change Password</h2>

     
         <input type="password" class="form-control" placeholder="Old Password" required name="old_password">    

			@if($errors->has('old_password'))
				{{ $errors->first('old_password') }}
			@endif	

        <input type="password" class="form-control" placeholder="New Password" required name="password">    

			@if($errors->has('password'))
				{{ $errors->first('password') }}
			@endif	


        <input type="password" class="form-control" placeholder="Repeat New Password" required name="password_again">    

			@if($errors->has('password_again'))
				{{ $errors->first('password_again') }}
			@endif	
        

        <button class="btn btn-lg btn-primary btn-block" type="submit">Change Password</button>

        {{ Form::token() }}

      </form>

    </div> <!-- /container -->


@stop