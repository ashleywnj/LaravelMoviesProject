 <div class="container">

      <!-- Static navbar -->
      <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::route('home') }}">Home</a>
          </div>




	@if (Auth::check())	
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              
              <li><a href="#">Link</a></li>
              
            </ul>

             <ul class="nav navbar-nav navbar-right">
              <li><a href="{{ URL::route('account-change-password') }}">Change Password</a></li>
              <li><a href="{{ URL::route('account-sign-out') }}">Sign Out</a></li>
              <li><a href="{{ URL::route('profile-user') }}">Profile</a></li>
            </ul>
    @else  
			<ul class="nav navbar-nav">

              <li class="active"><a href="{{ URL::route('account-sign-in') }}">Sign In</a></li>
	            
            </ul>

            <ul class="nav navbar-nav navbar-right">
              
              <li><a href="{{ URL::route('account-create') }}">Create Account</a></li>
              <li><a href="{{ URL::route('account-forgot-password') }}">Forgot Password</a></li>
            </ul>

	@endif
            </ul>
            
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>