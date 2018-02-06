<?php

class TherapistsController extends BaseController {

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

	public function index()
	{	

		$therapists = Therapist::all();
		return View::make('therapists.index',array(
			'therapists' => $therapists
		))->with("title","Therapists");
	}

	public function display($id) {

		$therapist = Therapist::find($id); 

		return View::make('therapists.display',array(
			'therapist' => $therapist
		))->with("title","Therapist Display");	
	}


	public function displayClients($id) {

		$therapist = Therapist::find($id); 

		$clients = $therapist->clients;

		return View::make('therapists.displayClients',array(
			'therapist' => $therapist,
			'clients' => $clients
		))->with("title","Therapist Display Clients");	
	}

	public function displayAppts($id) {

		$therapist = Therapist::find($id); 

		$appts = $therapist->appts;

		return View::make('therapists.displayAppts',array(
			'therapist' => $therapist,
			'appts' => $appts,
		))->with("title","Therapist Display Appointments");	
	}

	public function edit($id) {

		$therapist = Therapist::find($id); 

		return View::make('therapists.edit',array(
			'therapist' => $therapist
		))->with("title","Therapist Edit");	
	}

	public function add() {

		$therapist = new Therapist;

		return View::make('therapists.add',array(
			'therapist'=> $therapist
		))->with("title","Therapist Add");	
	}

	public function delete($id) {

		$therapist = Therapist::find($id); 

		return View::make('therapists.delete',array(
			'therapist' => $therapist
		))->with("title","Therapist Delete");	
	}

	public function deleteConfirm($id) {

		$therapist = Therapist::find($id)->delete(); 

		return Redirect::route("therapistsDisplayAll");	
	}

	//need to pass in the View Route to redirect to (return) on fail
	public function save($route) {
		// the data weare saving must come from the form
		
		if($route=="therapistAdd") {
			$rules = array(
				'name' => 'required|min:5' ,
				'phone' => 'required|min:5:unique:therapists',
				'email' => 'required|email|unique:therapists',
				'username' => 'required|unique:therapists',
				'password' => 'required|min:8|confirmed'
			);
		} else {
			//unique constraints not working with edit - finsing the original record!
			$rules = array(
				'name' => 'required|min:5' ,
				'phone' => 'required|min:5',
				'email' => 'required|email',
				'username' => 'required',
				'password' => 'required|min:8|confirmed'
			);

		}
		// create a new Therapist oject from inputs
		//$therapist = new Therapist(Input::all());
		if(!empty(Input::get('id'))) {
			$therapist=Therapist::find(Input::get('id'));
		}
		else {
			$therapist = new Therapist;
		}
		// update object with changes
		$therapist->name	=Input::get('name');
		$therapist->phone	=Input::get('phone');
		$therapist->email	=Input::get('email');
		$therapist->username=Input::get('username');
		$therapist->password=Input::get('password');
	

		// validate inputs - cannot pass $therapist
		$validator = Validator::make(Input::all() , $rules );

		if( $validator->fails() ) {
			// redirect to edit/add route with inputs
			return Redirect::route($route,array($therapist->id))->withInput()->withErrors($validator);
			
		} else {
			// write the data back to database
			$therapist->save();

			return Redirect::route("therapistDisplay",array($therapist->id));
			
		}



		
	}



}