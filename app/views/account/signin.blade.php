@extends('layout.main')

@section('content')
	<form action="{{ URL::route('account-sign-in-post') }}" method="post">

 <div class="container">

      <form class="form-signin" role="form">
        <h2 class="form-signin-heading">Sign in</h2>

        <input type="email" class="form-control" placeholder="Email address" required autofocus name="email" value="{{ (Input::old('email')) }}">
        
			@if($errors->has('email'))
				{{ $errors->first('email') }}
			@endif	
        
       

      
        <input type="password" class="form-control" placeholder="Password" required name="password">    

			@if($errors->has('password'))
				{{ $errors->first('password') }}
			@endif	


        <label class="checkbox">
          <input type="checkbox" value="remember"> Remember me
        </label>    

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>

        {{ Form::token() }}

      </form>

    </div> <!-- /container -->

   

@stop