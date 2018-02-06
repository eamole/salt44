<?php

class ClientsController extends BaseController {

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
		$clients = Client::with('therapist')->get();

		return View::make('clients.index',array(
			'clients' => $clients
		))->with("title","Clients");
	}

	public function display($id) {

		$client = Client::find($id); 

		$therapist=$client->therapist->name;

		return View::make('clients.display',array(
			'client' => $client,
			'therapist' =>$therapist
		))->with("title","Client Display");	
	}

	public function displayAppts($id) {

		$client = Client::find($id); 

		$therapist=$client->therapist->name;

		$appts = $client->appts;

		return View::make('clients.displayAppts',array(
			'client' => $client,
			'therapist' =>$therapist,
			'appts' => $appts,
		))->with("title","Client Display Appointments");	
	}

	public function delete($id) {

		$client = Client::find($id); 

		$therapist=$client->therapist->name;

		return View::make('clients.delete',array(
			'client' => $client,
			'therapist' =>$therapist
		))->with("title","Client Delete");	
	}


	public function edit($id) {

		$client = Client::find($id); 

		$therapists = Therapist::lists('name','id');

		return View::make('clients.edit',array(
			'client' => $client,
			'therapists' => $therapists
		))->with("title","Client Edit");	
	}

	public function add() {

		$client = new Client;

		$therapists = Therapist::lists('name','id');


		return View::make('clients.add',array(
			'client'=> $client,
			'therapists' => $therapists
		))->with("title","Client Add");	
	}


	public function deleteConfirm($id) {

		$client = Client::find($id)->delete(); 

		return Redirect::route("clientsDisplayAll");	
	}

	//need to pass in the View Route to redirect to (return) on fail
	public function save($route) {
		// the data weare saving must come from the form
		
		if($route=="clientAdd") {
			$rules = array(
				'name' => 'required|min:5' ,
				'phone' => 'required|min:5:unique:clients',
				'email' => 'required|email|unique:clients',
				'dob' =>  'date',
				'pps' => 'required|min:8',
				'therapist_id' =>'required|exists:therapists,id',	
				'username' => 'required|unique:clients',
				'password' => 'required|min:8|confirmed'
			);
		} else {
			//unique constraints not working with edit - finsing the original record!
			$rules = array(
				'name' => 'required|min:5' ,
				'phone' => 'required|min:5',
				'email' => 'required|email',
				'dob' =>  'date',
				'pps' => 'required|min:8',
				'therapist_id' =>'required|exists:therapists,id',	
				'username' => 'required',
				'password' => 'required|min:8|confirmed'
			);

		}
		// create a new Client oject from inputs
		//$client = new Client(Input::all());
		if(!empty(Input::get('id'))) {
			$client=Client::find(Input::get('id'));
		}
		else {
			$client = new Client;
		}
		// update object with changes
		$client->name	=Input::get('name');
		$client->phone	=Input::get('phone');
		$client->email	=Input::get('email');
		$client->address	=Input::get('address');
		$client->pps	=Input::get('pps');
		$client->dob	=Input::get('dob');
		$client->therapist_id	=Input::get('therapist_id');
		$client->notes	=Input::get('notes');
		$client->username=Input::get('username');
		$client->password=Input::get('password');
	

		// validate inputs - cannot pass $client
		$validator = Validator::make(Input::all() , $rules );

		if( $validator->fails() ) {

			// redirect to edit/add route with inputs
			return Redirect::route($route,array($client->id))->withInput()->withErrors($validator);
			
		} else {

			// write the data back to database
			$client->save();

			return Redirect::route("clientDisplay",array($client->id));
			
		}



		
	}



}