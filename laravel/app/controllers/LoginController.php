<?php

class LoginController extends BaseController {


	public static function logInOutButton() {

		if(Session::has('user')) {
			$user = Session::get('user');
			$html = "<span class='userLogin'>";
			$html .= "<span class='username'>User : ".$user->name."</span>";
			$html .= HTML::linkRoute('logout',"Logout" , null , ['class' => 'button']);
			$html .= "</span>";
		} else {

			$html = "<span class='userLogin'>";
			$html .= HTML::linkRoute('login',"Login" , null , ['class' => 'button']) ;
			$html .= "</span>";
		}
		return $html;

	}

	public function logout() {
		// pulling the value deletes it from the Session
		$user = Session::pull('user');
		$mb = new Illuminate\Support\MessageBag();
		$mb->add('login',$user->name." has been logged out");
		return Redirect::route('home')->withErrors($mb);


	}

	public function loginValidate()
	{	
		// for messages
		$mb = new Illuminate\Support\MessageBag();

		$username=Input::get('username');
		$user=Therapist::where('username','=',$username)->first();
		
		if(!is_null($user)){
			
			//validate password
			$password = Input::get('password');
			if($password===$user->password) {
				// add a message
				$mb->add("login",$user->name." has been logged in");
				
				// store $user in session
				Session::put('user',$user);

				// return to home page
				return Redirect::route('home')->withErrors($mb);
				
			} else {			
				// add a amessage
				$mb->add("login","Invalid user name or password");
				//no user by that name - generate error message and return to login view
				return Redirect::route('login')->withErrors($mb);
			}

		} else {
			//no user by that name - generate error message and return to login view

			// add a message
			$mb->add("login","Invalid user name or password");
			return Redirect::route('login')->withErrors($mb);
		}

		
	}

	

		


	


		




}