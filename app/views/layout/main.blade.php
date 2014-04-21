<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>User</title>


{{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js') }}

{{ HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css') }}

{{ HTML::script('//getbootstrap.com/dist/js/bootstrap.min.js')}}

{{ HTML::style('custom.css')}}


</head>

<body>

@if(Session::has('global'))
  <p>{{ Session::get('global') }}</p>
@endif  
  

@include('layout.navigation')

<Div class="Jumbtron">

@yield('content')

</Div>
	
</body>
</html>