<?php
class AccountController extends BaseController {

	public function getSignIn()	{
			return View::make('account.signin');
	}

	
	
	public function postSignIn() {
			$validator = Validator::make(Input::all(),
				array(
						'email' => 'required|email',
						'password' => 'required'
					)
				);

			if($validator->fails()) {
				return Redirect::route('account-sign-in')
					->withErrors($validator)
					->withInput();
			} else {

				$remember = (Input::has('remember')) ? true : false;

				$auth = Auth::attempt(array(
					'email' => Input::get('email'),
					'password' => Input::get('password'),
					'active' => 1
				), $remember);


			if($auth){
				return Redirect::intended('/');
			}	else {
				return Redirect::route('account-sign-in')
						->with('global', '<div class="alert alert-danger"><span class="glyphicon glyphicon-hand-right"></span> <strong>Message</strong><hr class="message-inner-separator">
                <p>Sorry, there seems to be an issue with your email or password or the account was not activated. Please verify and try again</p>
            </div>');
			}
		}

		return Redirect::route('account-sign-in')
				->with('global', 'Sorry, there was a problem signing in. Please try again later');

	}

	/*
	| Sign Out
	*/

	public function getSignOut(){
		Auth::logout();
		return Redirect::route('home');
	}

	/*
	| Profile
	*/
	public function user(){
			return View::make('account.user');
		}
				


	/* 
	| Create Account
	*/
	public function getCreate() {
		return View::make('account.create');
	}


	public function postCreate() {
		$validator = Validator::make(Input::all(), 
			array(
				'email' 			=> 	'required|max:50|email|unique:users',
				'username' 			=> 	'required|max:20|min:3|unique:users',
				'password' 			=> 	'required|min:6',
				'password_again' 	=> 'required|same:password'
				)
			);

		if($validator->fails()) {
			return Redirect::route('account-create')
				->witherrors($validator)
				->withInput();
		} else {

			$email 		= Input::get('email');
			$username 	= Input::get('username');
			$password 	= Input::get('password');

			$code 		= str_random(60);

			$user = User::create(array(
				'email' => $email,
				'username' => $username,
				'password' => Hash::make($password),
				'code' => $code,
				'active' => 0
				));
			if($user) {
				Mail::send('emails.auth.activate', array('link' => URL::route('account-activate', $code), 'username' => $username), function($message) use ($user) {
					$message->to($user->email, $user->username)->subject('Activate your account');
				});

				return Redirect::route('home')
					->with('global', 'Your account has been created. We sent you an email to activate your account.');
			}

		}
	}

	public function getActivate($code) {
		$user = User::where('code', '=', $code)->where('active', '=', 0);
		if($user->count()) {
			$user = $user->first();

			$user->active 	=1;
			$user->code 	='';

			if($user->save()); {
				return Redirect::route('home')
				->with('global', 'Your account has been activated - you van now sign in.');
			}

		}

		return Redirect::route('home')
				->with('global', 'We could not activate your account, please try again.');

	}

		public function getChangePassword()
		{
			return View::make('account.password');
		}

		public function postChangePassword()
		{
			$validator = Validator::make(Input::all(),
				array(
						'old_password'		=> 'required',
						'password'			=> 'required|min:6',
						'password_again'	=> 'required|same:password'
					)

				);	

			if($validator->fails()){
				return Redirect::route('account-change-password')
					->withErrors($validator);
			} else {
				$user = User::find(Auth::user()->id);

				$old_password 	= Input::get('old_password');
				$password 		= Input::get('password');

				if(Hash::check($old_password, $user->getAuthPassword())) {
					$user->password = Hash::make($password);

					if($user->save()){
						return Redirect::route('home')
							->with('global', 'Your password has been successfuly changed');
					} 
				} else {
						return Redirect::route('account-change-password')
					->with('global', 'Your old password was incorrect');
					}
			}

			return Redirect::route('account-change-password')
					->with('global', 'We cannot change your password at this time');
		
	}	

		public function getForgotPassword()
		{
			return View::make('account.forgot');
		}

		public function postForgotPassword() {
			$validator = Validator::make(Input::all(),
				array(
						'email' => 'required|email'
					)
				);
			if($validator->fails()) {
				return Redirect::route('account-forgot-password')
						->withErrors($validator)
						->withInput();

			} else {
				$user = User::where('email', '=', Input::get('email'));

				if($user->count()) {
					$user = $user->first();

					//Generate a new code and password

					$code = str_random(60);
					$password = str_random(10);

					$user->code = $code;
					$user->password_temp = Hash::make($password);

					if($user->save()) {
						
						Mail::send('emails.auth.recover', array('link' => URL::route('account-recover', $code), 'username' => $user->username, 'password' => $password), function($message) use($user){
								$message->to($user->email, $user->username)->subject('Your New Password');
						});
						return Redirect::route('home')
							->with('global', 'We have sent you a password reset link by email');
					}
				}
				
			}

			return Redirect::route('account-forgot-password')
				->with('global', 'Could not request new password');
		}
	
		public function getRecover($code){
			$user = User::where('code', '=', $code)
				->where('password_temp', '!=', '');

				if($user->count()){
					$user = $user->first();

					$user->password = $user->password_temp;
					$user->password_temp = '';
					$user->code = '';

					if($user->save()){
						return Redirect::route('home')
							->with('global', 'Your temporary password has been sent via email');

					}
		}

		return Redirect::route('home')
			->with('global', 'Could not reset your password at this time');
}
}



