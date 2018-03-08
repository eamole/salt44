<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


require_once('app.php');


// no filter required here - this is public
Route::get('/', [ 'as' => 'home' , function()
{
	return View::make('home',['title' => 'Home']);
}]);


Route::filter('login' , function(){

	if(!isLoggedIn()) {
		return Redirect::route('home')->withErrors(message('You need to be logged in to access this information'));
	}

});

Route::get('googleMap',[ 'as' => 'googleMap', function(){

	return View::make('googleMap', [ 'title' => 'Where we are']);
}]);



// Route::get('authors', function()
// {
// 	return "Hello world";
	
// });

// Route::get('authors', function()
// {
// 	return View::make("authors.index");

// });
include_once('routes/login.php');

Route::group( ['before'=>'login'] , function() {
	include_once('routes/therapists.php');
	include_once('routes/clients.php');
	include_once('routes/appts.php');
});

include_once('views/menu.php');