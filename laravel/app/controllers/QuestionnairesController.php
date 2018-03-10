<?php

class QuestionnairesController extends BaseController {


	/*
		produce a list of questionnaires to select from
	 */
	public function index($clientId){	
		
		$client = Client::findOrFail($clientId);
		Session::put("client" , $client );	// need to save the client somewhere
		
		$questionnaires = Questionnaire::loadQuestionnaires();

		return View::make('questionnaires.index',array(
			'questionnaires' => $questionnaires, 
			'client' => $client 
		))->with("title","Questionnaires");
	}

	public function start($id) {

		$questionnaire = Questionnaire::get($id);
		$questionnaire->start();

		Session::put( "questionnaire" , $questionnaire );

		// pose the question
		return View::make('questionnaires.question',array(
			'question' => $questionnaire->current_question 
		))->with("title",$questionnaire->title);

	}

	public function question($id) {
		
		// save the started questionaire in the Session - allws answers to be saved as well
		$questionnaire = Session::get( "questionnaire" );

		// pose the question
		return View::make('questionnaires.question',array(
			'question' => $questionnaire->current_question 
		))->with("title",$questionnaire->title);


	}
	public function back($id) {
		$questionnaire = Session::get('questionnaire');		
		// go back to prev question 
		// this is not repeatable!! needs a stack
		$questionnaire->set_question($questionnaire->previous_id);

		// save the started questionaire in the Session - allws answers to be saved as well
		Session::put( "questionnaire" , $questionnaire );

		return Redirect::route('questionnaireQuestion' , array($questionnaire->id));

	}
	// this is the eqiv of next()
	public function answer($questionnaire_id,$question_id) {

		$questionnaire = Session::get('questionnaire');		

		$question = $questionnaire->current_question;

		if($question->is_last_question()) {
			return $this->finish();	// save last question
		}
		// I don't like the idea of saving the value in the questionnaire, but we'll do that for now
		// $question->value = Input::get($question->html_id());
		
		$question->getInputValue();

		// validate the value using the laravel rules

		if($question->rules) {
			if(!is_array($question->rules)) $question->rules=[ $question->html_id() => $question->rules ];
			$validator = Validator::make( Input::all() , $question->rules );
			if( $validator->fails() ) {
				return Redirect::route('questionnaireQuestion' , array($questionnaire->id))
					->withErrors($validator)
					->withInput();
			}
		}
		
		// next - determine the next question to ask 
		$question->next();

		// save the started questionaire in the Session - allws answers to be saved as well
		Session::put( "questionnaire" , $questionnaire );

		return Redirect::route('questionnaireQuestion' , array($questionnaire->id));
		// pose the question
		return View::make('questionnaires.question',array(
			'question' => $questionnaire->current_question 
		))->with("title",$questionnaire->title);
	}

	public function finish() {

		// need to save the last question!!
		$questionnaire = Session::get('questionnaire');		

		$question = $questionnaire->current_question;
		// I don't like the idea of saving the value in the questionnaire, but we'll do that for now
		// $question->value = Input::get($question->html_id());
		$question->getInputValue();
		
		// I should probably save the questions and answers 
		// into the Client Notes!!
		// 
		$view = View::make('questionnaires.answers',array(
					'questionnaire' => $questionnaire 
					))->with("title",$questionnaire->title);

		// note : this is the entre page including menu
		$sections = $view->renderSections();
		$section = $sections['content'];
		
		// insert the answers into the top of the notes - need a p tag to allow insert
		$questionnaire->client->notes ="<p/><hr/>" . $section . "<br/><hr/>" . $questionnaire->client->notes;
		$questionnaire->client->save();

		return $view;


	}

}