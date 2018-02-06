<?php

class AuthorsController extends BaseController {

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
		// $data = array( "var1" => "value 1","var2" => "value 2");
		$data = Author::all();
		return View::make('authors.index',array(
			'data' => $data
		))->with("title","Authors Blade View from controller.index");
	}

	public function display($id) {
		// use eloquest to retrieve the recvord/object from Author model and then pass it to View to render the data
		$author = Author::find($id); 

		return View::make('authors.display',array(
			'author' => $author
		))->with("title","Author Display View from controller.display");	
	}

	public function edit($id) {
		// use eloquest to retrieve the recvord/object from Author model and then pass it to View to render the data
		$author = Author::find($id); 

		return View::make('authors.edit',array(
			'author' => $author
		))->with("title","Author Edit View from controller.edit");	
	}

	public function add() {
		// use eloquest to retrieve the recvord/object from Author model and then pass it to View to render the data
		$author = new Author;
		return View::make('authors.add',array(
			'author'=> $author
		))->with("title","Author Add View from controller.add");	
	}

	public function delete($id) {
		// use eloquest to retrieve the recvord/object from Author model and then pass it to View to render the data
		$author = Author::find($id); 

		return View::make('authors.delete',array(
			'author' => $author
		))->with("title","Author Delete View from controller.delete");	
	}

	public function deleteConfirm($id) {
		// use eloquest to retrieve the recvord/object from Author model and then pass it to View to render the data
		$author = Author::find($id)->delete(); 

		return Redirect::route("authorsDisplayAll");	
	}
	//need to pass in the View Route to redirect to (return) on fail
	public function save($route) {
		// the data weare saving must come from the form
		

		$rules = array(
			'name' => 'required|min:5' ,
			'bio' => 'required|min:5'
		);

		// create a new Author oject from inputs
		//$author = new Author(Input::all());
		if(!empty(Input::get('id'))) {
			$author=Author::find(Input::get('id'));
		}
		else {
			$author = new Author;
		}
		// update object with changes
		$author->name=Input::get('name');
		$author->bio=Input::get('bio');

		Log::info("Author data : ".$author);
		// validate inputs - cannot pass $author
		$validator = Validator::make(Input::all() , $rules );

		if( $validator->fails() ) {
			$this->msg("Validation failed Author : {$author->id}");
			// redirect to edit/add route with inputs
			return Redirect::route($route,array($author->id))->withInput()->withErrors($validator);
			
		} else {
			$this->msg("Saving Author : ".$author->id);
			// write the data back to database
			$author->save();
			$this->msg("Redirecting to Author : ".$author->id );
			return Redirect::route("authorDisplay",array($author->id));
			
		}



		
	}



}