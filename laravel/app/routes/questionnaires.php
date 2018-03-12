<?php

Route::get('questionnaires/{id}',array(
	'uses'=>'QuestionnairesController@index',
	'as' =>'questionnairesDisplayAll'

));

/*
	start the Questionnaire wizard
 */
Route::get('questionnaire/start/{id}',array(
	'uses' => "QuestionnairesController@start",
	'as' =>'questionnaireStart'
));

/*
	display a specific question in a questionnaire
 */
Route::get('questionnaire/question/{id}',array(
	'uses' => "QuestionnairesController@question",
	'as' =>'questionnaireQuestion'
));

Route::post('questionnaire/answer/{id}/{question_id}',array(
	'uses' => "QuestionnairesController@answer",
	'as' =>'questionnaireAnswer'
));

Route::get('questionnaire/finish/{id}',array(
	'uses' => "QuestionnairesController@finish",
	'as' =>'questionnaireFinish'
));

Route::get('questionnaire/back/{id}',array(
	'uses' => "QuestionnairesController@back",
	'as' =>'questionnaireBack'
));

Route::get('questionnaire/saveToClient/',array(
	'uses' => "QuestionnairesController@saveToClient",
	'as' =>'questionnaireSaveToClient'
));

