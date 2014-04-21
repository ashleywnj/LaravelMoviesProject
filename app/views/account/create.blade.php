@extends('layout.main')

@section('content')

 <div class="container">
	<form action="{{ URL::route('account-create-post') }}" method="post" class="form-signin" role="form">

        <h2 class="form-signin-heading">Sign up</h2>

        <input type="email" class="form-control" placeholder="Email address" required autofocus name="email" value="{{ (Input::old('email')) }}">

			@if($errors->has('email'))
				{{ $errors->first('email') }}
			@endif	
        
        <input type="text" class="form-control" placeholder="User Name" required  name="username" value="{{ (Input::old('username')) }}">    

			@if($errors->has('username'))
				{{ $errors->first('username') }}
			@endif	

      
        <input type="password" class="form-control" placeholder="Password" required name="password">    

			@if($errors->has('password'))
				{{ $errors->first('password') }}
			@endif	


        <input type="password" class="form-control" placeholder="Repeat Password" required name="password_again">    

			@if($errors->has('password_again'))
				{{ $errors->first('password_again') }}
			@endif	
        

        <button class="btn btn-lg btn-primary btn-block" type="submit">Create Account</button>

        {{ Form::token() }}

      </form>

    </div> <!-- /container -->

   

@stop