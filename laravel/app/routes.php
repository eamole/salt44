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


/*
	this is a global function to render labels with a std html class
	need to find a better location for this function - somewhere that is loaded for every page 

	$name : the name of the element to attach the label to
	$test : the text to display 
 */
function myLabel($name, $text) {

	$tag = Form::label($name,$text,['class' => 'label']);

	return $tag;

}	


Route::get('/', [ 'as' => 'home' , function()
{
	return View::make('home',['title' => 'Home']);
}]);

// Route::get('authors', function()
// {
// 	return "Hello world";
	
// });

// Route::get('authors', function()
// {
// 	return View::make("authors.index");

// });
include_once('routes/authors.php');
include_once('routes/therapists.php');
include_once('routes/clients.php');
include_once('routes/appts.php');


include_once('views/menu.php');