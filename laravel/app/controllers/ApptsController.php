<?php

class ApptsController extends BaseController {

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
		
		$appts = Appt::all();
		return View::make('appts.index',array(
			'appts' => $appts
		))->with("title","Appointments");
	}

	public function display($id) {

		$appt = Appt::findOrFail($id); 

		$client 	= $appt->client->name;

		$therapist 	= $appt->therapist->name;

		return View::make('appts.display',array(
			'appt' 		=> $appt,
			'therapist' => $therapist,
			'client' 	=> $client,
		))->with("title","Appointment Display");	
	}

	public function delete($id) {

		$appt = Appt::findOrFail($id); 

		$client 	= $appt->client->name;

		$therapist 	= $appt->therapist->name;

		return View::make('appts.delete',array(
			'appt' 		=> $appt,
			'therapist' => $therapist,
			'client' 	=> $client,
		))->with("title","Appointment Delete");	
	}

	public function deleteConfirm($id) {

		$appt = Appt::find($id)->delete(); 

		return Redirect::route("apptsDisplayAll");	
	}

	public function setEditOptions($id=null) {

		$appt = Appt::find($id); 

		$therapists = Therapist::lists('name','id');	//    $appt->therapists;

		$clients = Client::lists('name','id'); // $appt->clients;
		
		return array(
			'appt' 			=> $appt,
			'therapists' 	=> $therapists,
			'clients' 		=> $clients,
		);		
	}

	public function edit($id) {

		return View::make('appts.edit', 
			$this->setEditOptions($id) 
		)->with("title","Appointment Edit");	
	}

	// $id is optiona. If provided, use the client and patient ids
	public function add($id=null) {
		
		$appt = new Appt;

		if(!empty($id)) {
			$old = Appt::findOrFail($id);
			$appt->client_id = $old->client_id;
			$appt->therapist_id = $old->therapist_id;
		} 

		$therapists = Therapist::lists('name','id');	//    $appt->therapists;

		$clients = Client::lists('name','id'); // $appt->clients;

		return View::make('appts.add',array(
			'appt'			=> $appt,
			'therapists' 	=> $therapists,
			'clients' 		=> $clients,
		))->with("title","Appointment Add");	
	}

	public function addFromClient($id) {

		$appt = new Appt;

		$client=Client::findOrFail($id);

		$appt->client_id = $id;
		// default to clients therapist
		$appt->therapist_id = $client->therapist_id;

		$therapists = Therapist::lists('name','id');	//    $appt->therapists;

		$clients = Client::lists('name','id'); // $appt->clients;

		return View::make('appts.add',array(
			'appt'			=> $appt,
			'therapists' 	=> $therapists,
			'clients' 		=> $clients,
		))->with("title","Appointment Add");	

	}

	public function addFromTherapist($id) {

		$appt = new Appt;

		$appt->therapist_id = $id;

		$therapists = Therapist::lists('name','id');	//    $appt->therapists;

		$clients = Client::lists('name','id'); // $appt->clients;

		return View::make('appts.add',array(
			'appt'			=> $appt,
			'therapists' 	=> $therapists,
			'clients' 		=> $clients,
		))->with("title","Appointment Add");	

	}


	//need to pass in the View Route to redirect to (return) on fail
	public function save($route) {
		// the data weare saving must come from the form
		
		if($route=="apptAdd") {
			$rules = array(
				'therapist_id' =>'required|exists:therapists,id',	
				'client_id' =>'required|exists:clients,id',	
				'date' =>  'date|after:'.date('Y-m-d',time() - 60 * 60 * 24),
				'finish' =>  'after:start',
			);
		} else {
			//unique constraints not working with edit - finsing the original record!
			$rules = array(
				'therapist_id' =>'required|exists:therapists,id',	
				'client_id' =>'required|exists:clients,id',	
				'date' =>  'date|after:'.date('Y-m-d',time() - 60 * 60 * 24),
				'finish' =>  'after:start',
			);

		}

		// create a new Appt oject from inputs
		if(!empty(Input::get('id'))) {
			$appt=Appt::find(Input::get('id'));
		}
		else {
			$appt = new Appt;
		}

		// update object with changes
		$appt->therapist_id	=Input::get('therapist_id');
		$appt->client_id	=Input::get('client_id');
		$appt->date 	=Input::get('date');
		$appt->start	=Input::get('start');
		$appt->finish	=Input::get('finish');
		$appt->attended	=Input::has('attended');
		$appt->notes	=Input::get('notes');
	

		// validate inputs - cannot pass $appt
		$validator = Validator::make(Input::all() , $rules );

		if( $validator->fails() ) {
			// redirect to edit/add route with inputs
			return Redirect::route($route,array($appt->id))->withInput()->withErrors($validator);
			
		} else {
			// write the data back to database
			$appt->save();

			return Redirect::route("apptDisplay",array($appt->id));
			
		}



		
	}



}