<?php

class LoginController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function loginValidate()
	{	
		$username=Input::get('username');
		$user=Therapist::where('username','=',$username)->first();
		
		if(is_null($user)){

			//validate password

			//if valid 
			//set is logged in, user id , is admin 
			//redirect to homepage

			//if not valid 
			//return to login screen with error message 

		}else{

			//no user by that name - generate error message and return to login view
			Redirect::route('login');
		}

		
	}

	

		


	


		




}