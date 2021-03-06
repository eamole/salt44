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

	// list of all questionnaires
	public static $questionnaires=[];

	public $isSavedToClient = false;

	public $client;
	public $path;
	public $id;
	public $title;
	public $questions=[];	// array of Question objects
	public $next_question_id=0;	// pre incr

	// questions can be attached to sections. All a section has is a header?
	public $sections=[];
	public $current_section;
	public $current_section_id=0;

	// must keep these in sync
	public $current_id=1;	// for some reason, it has no current value!!
	public $current_question;

	public $question_stack=[];	// each question is pushed onto stack to allow back()!!
	public $next_id;		// this is computed based on the response
	public $anchors=[];		// array of jumpTo anchors - anchor,id pairs 

	public static $load_questions;	// questions loaded from include file
	
	public static $this_questionnaire;	// the current questionnaire being defined

	public function __construct($id,$title,$path) {
		
		// bind the questionnaire to the client
		$this->client = Session::get("client");
		$this->id=$id;
		$this->title=$title;
		$this->path=$path;

		// I should now load the questions?
		// $this->load();
	}
	/*
		this is the "constructor" called from the questionnaire def file
	 */
	public static function init($id,$title,$path) {
		// !!! Make sure a client has been selected into Session
		// 
		// I really could restore a saved version easily here!!
		$q = new Questionnaire($id,$title,$path);
		self::$this_questionnaire=$q;
		self::$questionnaires[$id] = $q;
		return $q;
	}
	/*
		load them from the folder - 
	 */
	public static function loadQuestionnaires() {

		$path = app_path() ."/questionnaires/"; 
		$files = glob($path . "*.php");
		foreach ($files as $file) {
			include($file);
			/*
				we can now determine if there is a saved version on client
			*/
			if(self::$this_questionnaire->isSavedToClient()) {
				$q = self::$this_questionnaire->loadFromClient();
				$q->isSavedToClient=true;
				self::$this_questionnaire = $q;
				self::$questionnaires[$q->id]=$q;	// should replace
			}
		}
		Session::put("questionnaires" , self::$questionnaires );
		return self::$questionnaires;
	}		

	/*
		the name of the file used to save a questionnaire for a client
	 */
	public function filenameSaveToClient($includePath=false) {
		// really should have this stored in the QuestionnaireContrller object
		// and persisted
		$path = ($includePath) ? $path = storage_path() ."/questionnaires/" : "" ;		
		return 	$path . 
				$this->client->name . 
				"." . 
				$this->title . 
				".save";
	}
	/*
		this will save 
	 */
	public function saveToClient() {
		
		$path = $this->filenameSaveToClient(true) ;
		$this->isSavedToClient = true;
		$data = serialize($this);
		$dir='';
		$parts = explode('/', $path);
		$filename = array_pop($parts);	// lose the filename
        foreach($parts as $part) {
            if (! is_dir($dir .= "{$part}/")) mkdir($dir);
        }

		file_put_contents($path , $data );

	}
	public function isSavedToClient() {
		$filename = $this->filenameSaveToClient(true) ;
		return file_exists($filename);
	}
	/*
		I need the original blank object first
	 */
	public function loadFromClient() {

		$filename = $this->filenameSaveToClient(true) ;

		$data = file_get_contents($filename );

		$obj = unserialize($data);
	
		return $obj;
	} 


	/*
	
		allow each question to be attached to a section - maybe repeat the section
		for each question

	 */
	public function section($params) {

		$this->current_section = $params ;
		$this->section[ ++$this->current_section_id ] = $this->current_section ;	//pre increment
		return $this;
	}

	public function questions($questions) {
		foreach($questions as $question ) {
			// pre increment id
			$q = Question::init($this,++$this->next_question_id,$question);
			$this->questions[$this->next_question_id] = $q;
			if(isset($q->anchor)) {
				$this->anchors[$q->anchor] = $this->next_question_id; 
			} 
		}
		return $this;
	}
	/*
		this now scans the questionnaires folder
	 */
	public static function get($id) {

		self::$questionnaires = Session::get("questionnaires");
		$q = self::$questionnaires[$id]; 
		self::$this_questionnaire=$q;

		return $q;
	}

	public function count() {
		return count($this->questions);
	}

	public function start($restart = false) {
		if(!$this->isSavedToClient || $restart) {
			if($restart) {
				msg("Restarting questionnaire");
			}
			// msg("not saved");
			$this->current_id=1;
			$this->current_question=$this->questions[$this->current_id];
		} else {
			msg("Resuming questionnaire");
		}
	}
	function get_question($id=null) {
		// msg("questionnaire->get_question(id=$id)");
		if (is_null($id)) {
			$id = $this->current_id;
			// msg("questionnaire->get_question() : use current_id ($id) ");
		} else {
			// msg("questionnaire->question() : set new current_id ($id) ");			
			$this->current_id = $id;	// make sure you set it!!			
		}
		// msg("get_question() return questions[$id]");
		if(is_null($id)) {
			msg("Warning : for some reason, we are not setting the current question ID.");
			return null;
		}
		return $this->questions[$id];
	}
	/*
		returns the next id 
	 */
	function next_default() {
		if(!$this->is_last_question()) {
			$id = $this->current_question->id + 1;	// by default, the next question
		} else {
			$id = $this->current_question->id;
		} 
		return $id;		
	}	
	/*
		this gets the ID of the jumpTo anchor
	 */
	function jumpTo($anchor) {
		// msg("jump to  : $anchor ");
		if(isset($this->anchors[$anchor])) {
			$id = $this->anchors[$anchor];
			// msg("jump to id  : $id ");
			return $id;
		} else {
			// TODO raise an anchor missing error
			msg("Error : Cannot find Anchor ($anchor) in Questionnnaire ");
			return $this->next_default();
		}
	}
	/*
		this sets the next question - the next id is identified by the Question itself
	 */
	public function next($id) {
		// msg("Questionnaire->next($id)");
		if(is_null($id)) msg('Error : Questionnaire->next($id); $id is null');
		$last_question = $this->get_question();
		if(is_null($last_question)) {
			msg("Warning : not getting a last question from get_question(). Probably no ID set");
		}
		if(is_null($this->current_question)) {
			msg("Warning : for some reason the current question is not set");
		} else {
			$last_question = $this->current_question;			
		}
		array_push($this->question_stack,$last_question);
		// $this->previous_id=$this->current_id;
		$this->current_id=$id;
		$this->current_question=$this->get_question();

	}
	public function back() {
		if(count($this->question_stack)>0) {
			$this->current_question = array_pop($this->question_stack);
			$this->current_id=$this->current_question->id;
		} else {
			// TODO should record a warning
		}
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

	/*
		old load
	 */
	public function old_load() {

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

	public static function old_loadQuestionnaires() {

		$questionnaires = [];
		foreach (self::$questionnaires as $id => $jsonQuestionnaire) {
			$questionnaire = new Questionnaire($id,$jsonQuestionnaire['title']);
			$questionnaires[$id] = $questionnaire;
		}
		return $questionnaires;
	}		


}