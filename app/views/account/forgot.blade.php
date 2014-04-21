@extends('layout.main')

@section('content') 

<div class="container">
	<form action="{{ URL::route('account-forgot-password-post') }}" method="post" class="form-signin" role="form">

        <h2 class="form-signin-heading">Recover Password</h2>

        <input type="email" class="form-control" placeholder="Email address" required autofocus name="email" value="{{ e(Input::old('email')) }}">

			@if($errors->has('email'))
				{{ $errors->first('email') }}
			@endif	       
          

        <button class="btn btn-lg btn-primary btn-block" type="submit">Recover Password</button>

        {{ Form::token() }}

      </form>

    </div> <!-- /container -->

   



@stop 