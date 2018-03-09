<?php 
/*
	The Question class reneders the question, gets the response, validates the response, and then 
	determines the next question

 */

class Question {

	public $questionnaire;	// the questionnaire object (parent)
	public $id;
	public $label;	// this will be the label
	public $type;	// this is the input type - one of types
	public static $types = ['text','password','email','file','checkbox','radio','number','select','selectRange','selectMonth']; 

	public $defaultValue;
	public $attribs=[];		// for html
	public $value;			// input value - maybe multiple eg multi select
	public $values=[];		// for select, checkboxes and radios
	public $multiple = false;
	public $next;			// next question - either blank (ie next), an id, or a function
	public $text_after;		// if there is text to appear after the input eg units
	public $help_text;		// this may be help provided to the user
	public $rules = [];		// laravel validation rules

	public static $jsonQuestion;	// a holder for  question while

	function __construct($questionnaire,$id) {
		$this->id=$id;
		$this->questionnaire = $questionnaire;
	}

	/*
		no longer using json - just php arrays
	 */
	public static function init($questionnaire,$id,$json) {
		
		self::$jsonQuestion = $json;

		$q = new Question($questionnaire,$id);

		$q->label 	= self::get('label');
		$q->type 	= self::get('type','text');
		$q->values 	= self::get('values');
		$q->multiple= self::get('multiple',false);
		$q->text_after 	= self::get('text_after');
		$q->help_text 	= self::get('help_text');
		$q->rules 	= self::get('rules');
		return $q;

	}
	public static function get($field,$default=null) {
		if(isset(self::$jsonQuestion[$field])) {
			$value = self::$jsonQuestion[$field];
		} else {
			$value = $default;
		}
		// if(!is_array($value)) {
		// 	echo "$field : $value <br/>";
		// }else{
		// 	echo "$field : array <br/>";
		// }
		return $value;

	}

	/*
		the next question to ask
	 */
	function next() {
		if(is_null($this->next)) {
			if(!$this->questionnaire->is_last_question()) {
				$next = $this->id + 1;	// by default, the next question
			} else {
				$next = $this->id;
			} 
		} else {
			// its either a speicifc question - maybe in another questionnaire
			// // or a function
			if(is_callable($this->next)) {
				$this->next();
			} else if( is_array($this->next)) {
				// assume a questionnaire and a question id
			} else {
				$next = $this->next;
			}
		}

		$this->questionnaire->set_question($next);  
	}

	function __toString() {
		return print_r($this,true);
	}
	function is_last_question() {
		return $this->questionnaire->is_last_question();
	}
	/*
		retrieve the value(s) fromthe form
	 */
	function getInputValue() {

		$this->value = Input::get($this->html_id());			
		
		$values=[];
		if($this->type=='checkbox') {
			// we actually want the labels!!
			foreach ($this->value as $value) {
				$values[] = $this->values[$value];
			}
			$this->value=$values;
		}

		if($this->type=='radio') {
			$this->value=$this->values[$this->value];	// label
		}

		if($this->type=='select') {
			if(is_array($this->value)) {
				// we actually want the labels!!
				foreach ($this->value as $value) {
					$values[] = $this->values[$value];
				}
				$this->value=$values;
			} else {
				$this->value = $this->values[$this->value];
			}
		}
	}

	/*
		render this into the view
	 */
	public function render() {
		
		$html = myLabel($this->html_id() , $this->label , $this->attribs);

		if($this->type=='checkbox') {
			$index = 1;
			foreach($this->values as $key => $value) {
				$html .= Form::label($this->html_id($index) , $value , $this->attribs);
				// name is common to all values,id is unique to use label as click region
				$html .= Form::checkbox($this->html_id()."[]",$key,null,array("id" => $this->html_id($index++)));
			}
		}
		// radio buttons MUST use the same name for each element
		if($this->type=='radio') {
			$index = 1;
			foreach($this->values as $key => $value) {
				$html .= Form::label($this->html_id($index) , $value , $this->attribs);
				// name is common to all values,id is unique to use label as click region
				$html .= Form::radio($this->html_id(),$key,null,array("id" => $this->html_id($index++)));
			}
		}

		if($this->type=='select') {
			$options=[];
			$index=0;
			foreach($this->values as $value) {
				$options[$index++]=$value;
			}
			$html .= Form::select($this->html_id(),$options);
		}
		if($this->type=='text') {
			$html .= Form::text($this->html_id(),$this->value);			
		}
		if($this->type=='number') {
			$html .= Form::number($this->html_id(),$this->value);			
		}
		if($this->type=='email') {
			$html .= Form::email($this->html_id(),$this->value);			
		}
		if($this->type=='date') {
			$html .= Form::input('date' , $this->html_id(),$this->value);			
		}
		if($this->type=='password') {
			$html .= Form::password($this->html_id(),$this->value);			
		}

		return $html;
	}
	// convert array into attrib string
	public function attribs() {

		$attribs = "";
		foreach($this->attribs as $attrib => $value ) {
			$attribs .= "$attrib = '$value'";
		}
		return $attribs;

	}
	/*
		ensure the label and the input field are bound by id - unique name!!
	 */
	public function html_id($index=null) {
		$id = "id_".$this->id;
		if(!is_null($index)) {
			$id .= "_" . $index ;	// for multi values
		}
		return $id;
	}


}