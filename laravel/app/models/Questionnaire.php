<?php
/*
	a questionnaire is a grouping of questions, and user answers
	the questionnaire asks one question at a time
	the users response is recorded, validated, and then processed to determine which question to ask next
	Questionnaires are stored in JSON files

	We need to bind to a basic View

	when the Q is activated, it needs to display a list of questionnaires - from which the user selects
	one, and the questionnaire begins

 */

class Questionnaire {

	/*
		This should be a json like structure. We will move this to a file later.
	 */
	public static $questionnaires=[
		'1' => [ 'title' => 'Initial Questionaire' ] ,
		'2' => [ 'title' => 'Follow Up Questionnaire']
	];

	public $clientId;
	public $client;
	public $id;
	public $title;
	public $questions=[];	// array of Question objects

	public $current_id;
	public $previous_id;	// the last question
	public $next_id;		// this is computed based on the response


	public static $load_questions;	// questions loaded from include file

	public static function loadQuestionnaires() {

		$questionnaires = [];
		foreach (self::$questionnaires as $id => $jsonQuestionnaire) {
			$questionnaire = new Questionnaire($id,$jsonQuestionnaire['title']);
			$questionnaires[$id] = $questionnaire;
		}
		return $questionnaires;
	}		

	public static function get($id) {
		$q = new Questionnaire($id,self::$questionnaires[$id]['title']);
		$q->load();
		return $q;
	}

	public function start() {
		$this->current_id=1;
		$this->previous_id=null;
		$this->next_id=null;
		$this->current_question=$this->questions[$this->current_id];
	}

	public function set_question($id) {

		$this->previous_id=$this->current_id;
		$this->current_id=$id;
		$this->current_question=$this->questions[$this->current_id];

	}

	public function is_last_question() {
		// if the current id is the last element of the array of questions
		$last_question = end($this->questions);
		$value = $last_question==$this->current_question ? "true" : "false" ;
		return $last_question==$this->current_question;
	}

	public function is_first_question() {
		// if the current id is the last element of the array of questions
		$first_question = reset($this->questions);
		$value = $first_question==$this->current_question ? "true" : "false" ;
		return $first_question==$this->current_question;
	}

	public function __construct($id,$title) {
		
		// bind the questionnaire to the client
		$this->client = Session::get("client");
		$this->id=$id;
		$this->title=$title;

		// I should now load the questions?
		// $this->load();
	}
	public function load() {

		$path = app_path() ."/questionnaires/"; 
		$path = $path.$this->id.".php";
		// I need to run the file and capture the output
		
		include($path);

		// $json = file_get_contents($path);	// this is reading it as a text file....should really run it
		
		// $result = $this->json_validate($json);
		// echo $result;
		// $questions = json_decode($json);
		$questions = self::$load_questions;

		// if(is_null($questions)) {
		// 	echo json_last_error_msg();
		// } else {
		foreach($questions as $id => $question ) {
			// echo "Question " ;
			$this->questions[$id] = Question::init($this,$id,$question);
		}
		// }
	}

	function __toString() {
		return print_r($this,true);
	}

	function json_validate($string){
	    // decode the JSON data
	    $result = json_decode($string);

	    // switch and check possible JSON errors
	    switch (json_last_error()) {
	        case JSON_ERROR_NONE:
	            $error = ''; // JSON is valid // No error has occurred
	            break;
	        case JSON_ERROR_DEPTH:
	            $error = 'The maximum stack depth has been exceeded.';
	            break;
	        case JSON_ERROR_STATE_MISMATCH:
	            $error = 'Invalid or malformed JSON.';
	            break;
	        case JSON_ERROR_CTRL_CHAR:
	            $error = 'Control character error, possibly incorrectly encoded.';
	            break;
	        case JSON_ERROR_SYNTAX:
	            $error = 'Syntax error, malformed JSON.';
	            break;
	        // PHP >= 5.3.3
	        case JSON_ERROR_UTF8:
	            $error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
	            break;
	        // PHP >= 5.5.0
	        case JSON_ERROR_RECURSION:
	            $error = 'One or more recursive references in the value to be encoded.';
	            break;
	        // PHP >= 5.5.0
	        case JSON_ERROR_INF_OR_NAN:
	            $error = 'One or more NAN or INF values in the value to be encoded.';
	            break;
	        case JSON_ERROR_UNSUPPORTED_TYPE:
	            $error = 'A value of a type that cannot be encoded was given.';
	            break;
	        default:
	            $error = 'Unknown JSON error occured.';
	            break;
	    }

	    if ($error !== '') {
	        // throw the Exception or exit // or whatever :)
	        exit($error);
	    }

	    // everything is OK
	    return $result;
	}	



}