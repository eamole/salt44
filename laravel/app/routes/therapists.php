<?php

Route::get('therapists',array(
	'uses'=>'TherapistsController@index',
	'as' =>'therapistsDisplayAll'

));

// Route::get('therapist/{id}',function($id) {
// 	return View::make('therapists.therapist')->with("title","Therapist View")->with("id", $id);	
// });

Route::get('therapist/display/{id}',array(
	'uses' => "TherapistsController@display",
	'as' =>'therapistDisplay'
));

Route::get('therapist/edit/{id}',array(
	'uses' => "TherapistsController@edit",
	'as' =>'therapistEdit'
));

Route::get('therapist/add',array(
	'uses' => "TherapistsController@add",
	'as' =>'therapistAdd'
));

Route::get('therapist/delete/{id}',array(
	'uses' => "TherapistsController@delete",
	'as' =>'therapistDelete'
));

Route::get('therapist/deleteConfirm/{id}',array(
	'uses' => "TherapistsController@deleteConfirm",
	'as' =>'therapistDeleteConfirm'
));
// NB : POST method
Route::post('therapist/save/{route}',array(
	'uses' => "TherapistsController@save",
	'as' =>'therapistSave'
));

Route::get('therapist/clients/{id}',array(
	'uses' => "TherapistsController@displayClients",
	'as' =>'therapistDisplayClients'
));

Route::get('therapist/appts/{id}',array(
	'uses' => "TherapistsController@displayAppts",
	'as' =>'therapistDisplayAppts'
));


