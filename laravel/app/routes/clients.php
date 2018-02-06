<?php

\Log::info("Loading Clients");

Route::get('clients',array(
	'uses'=>'ClientsController@index',
	'as' =>'clientsDisplayAll'

));

// Route::get('client/{id}',function($id) {
// 	return View::make('clients.client')->with("title","Client View")->with("id", $id);	
// });

Route::get('client/display/{id}',array(
	'uses' => "ClientsController@display",
	'as' =>'clientDisplay'
));

Route::get('client/edit/{id}',array(
	'uses' => "ClientsController@edit",
	'as' =>'clientEdit'
));

Route::get('client/add',array(
	'uses' => "ClientsController@add",
	'as' =>'clientAdd'
));

Route::get('client/delete/{id}',array(
	'uses' => "ClientsController@delete",
	'as' =>'clientDelete'
));

Route::get('client/deleteConfirm/{id}',array(
	'uses' => "ClientsController@deleteConfirm",
	'as' =>'clientDeleteConfirm'
));
// NB : POST method
Route::post('client/save/{route}',array(
	'uses' => "ClientsController@save",
	'as' =>'clientSave'
));


Route::get('client/appts/{id}',array(
	'uses' => "ClientsController@displayAppts",
	'as' =>'clientDisplayAppts'
));


