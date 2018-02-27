<?php

Route::get('login', [ 'as' => 'login' , function()
{
	return View::make('auth.login',['title' => 'Login']);
}]);

Route::post('loginValidate',array(
	'uses' => "LoginController@loginValidate",
	'as' =>'loginValidate'
));

Route::get('logout',array(
	'uses' => "LoginController@logout",
	'as' =>'logout'
));

