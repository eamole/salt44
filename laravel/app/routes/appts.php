<?php

\Log::info("Loading Appts");

Route::get('appts',array(
	'uses'=>'ApptsController@index',
	'as' =>'apptsDisplayAll'

));

// Route::get('appt/{id}',function($id) {
// 	return View::make('appts.appt')->with("title","Appt View")->with("id", $id);	
// });

Route::get('appt/display/{id}',array(
	'uses' => "ApptsController@display",
	'as' =>'apptDisplay'
));

Route::get('appt/edit/{id}',array(
	'uses' => "ApptsController@edit",
	'as' =>'apptEdit'
));

Route::get('appt/add/{id?}',array(
	'uses' => "ApptsController@add",
	'as' =>'apptAdd'
));

Route::get('appt/add/client/{id}',array(
	'uses' => "ApptsController@addFromClient",
	'as' =>'apptAddFromClient'
));

Route::get('appt/add/therapist/{id}',array(
	'uses' => "ApptsController@addFromTherapist",
	'as' =>'apptAddFromTherapist'
));

Route::get('appt/delete/{id}',array(
	'uses' => "ApptsController@delete",
	'as' =>'apptDelete'
));

Route::get('appt/deleteConfirm/{id}',array(
	'uses' => "ApptsController@deleteConfirm",
	'as' =>'apptDeleteConfirm'
));
// NB : POST method
Route::post('appt/save/{route}',array(
	'uses' => "ApptsController@save",
	'as' =>'apptSave'
));

