<?php

Route::get('authors',array(
	'uses'=>'AuthorsController@index',
	'as' =>'authorsDisplayAll'

));

// Route::get('author/{id}',function($id) {
// 	return View::make('authors.author')->with("title","Author View")->with("id", $id);	
// });

Route::get('author/display/{id}',array(
	'uses' => "AuthorsController@display",
	'as' =>'authorDisplay'
));

Route::get('author/edit/{id}',array(
	'uses' => "AuthorsController@edit",
	'as' =>'authorEdit'
));

Route::get('author/add',array(
	'uses' => "AuthorsController@add",
	'as' =>'authorAdd'
));

Route::get('author/delete/{id}',array(
	'uses' => "AuthorsController@delete",
	'as' =>'authorDelete'
));

Route::get('author/deleteConfirm/{id}',array(
	'uses' => "AuthorsController@deleteConfirm",
	'as' =>'authorDeleteConfirm'
));
// NB : POST method
Route::post('author/save/{route}',array(
	'uses' => "AuthorsController@save",
	'as' =>'authorSave'
));

