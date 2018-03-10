<?php 
/*
	The Question class reneders the question, gets the response, validates the response, and then 
	determines the next question

 */

class Question {

	public $questionnaire;	// the questionnaire object (parent)
	public $id;
	public $section;
	public $params=[];		// settings
	public $label;			// this will be the label
	public $type;			// this is the input type - one of types
	public static $types = ['text','password','email','file','checkbox','radio','number','select','selectRange','selectMonth']; 

	public $default;
	public $attribs=[];		// for html
	public $value;			// input value - maybe multiple eg multi select
	public $values=[];		// for select, checkboxes and radios
	public $multiple = false;
	public $next;			// next question - either blank (ie next), an id, or a function
	public $text_after;		// if there is text to appear after the input eg units
	public $help_text;		// this may be help provided to the user
	public $rules = [];		// laravel validation rules

	public static $jsonQuestion;	// a holder for  question while

	function __construct($questionnaire,$id,$params) {
		$this->id 				= $id;
		$this->questionnaire 	= $questionnaire;
		$this->section 			= $this->questionnaire->current_section;
		$this->params 			= $params;

		$this->label 		= $this->param('label');
		$this->type 		= $this->param('type','text');
		$this->scale 		= $this->param('scale');
		$this->values 		= $this->param('values');
		$this->multiple		= $this->param('multiple',false);
		$this->text_after 	= $this->param('text_after');
		$this->help_text 	= $this->param('help_text');
		$this->rules 		= $this->param('rules');
		$this->default 		= $this->param('default');

	}

	/*
		no longer using json - just php arrays
	 */
	public static function init($questionnaire,$id,$params) {
		
		$q = new Question($questionnaire,$id,$params);

		return $q;

	}
	public function param($field,$default=null) {

		if(isset($this->params[$field])) {
			$value = $this->params[$field];
		} else {
			//see if the section has a default value set
			if(isset($this->section[$field])) {
				$value = $this->section[$field];
			} else {
				$value = $default;
			}
		}
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
			if(empty($this->value)) $this->value=[];	// trap no data
			// we actually want the labels!!
			foreach ($this->value as $value) {
				$values[] = $this->values[$value];
			}
			$this->value=$values;
		}

		if($this->type=='radio') {
			if($this->value){	// trap empty values 
				$this->value=$this->values[$this->value];	// label
			}
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

		$html="<h3>Q.".$this->id." of ".$this->questionnaire->count()."</h3>";
		
		if(!empty($this->section)) {
			$html .= "<h4>".$this->section['title'] . "</h4>";
		}
		if(!empty($this->section) && isset($this->section['subtext'])) {
			$html .= "<h5>".$this->section['subtext'] . "</h5>";
		}
		
		if(is_null($this->value)) {
			if($this->default) {
				$this->value = $this->default;
			}
		}

		/*
			need a div to wrap around the label and the values 
			if values is an array
		 */ 
		$html .= myLabel($this->html_id() , $this->label );

		if($this->type=='checkbox') {
			$index = 1;
			foreach($this->values as $key => $value) {
				$html .= "<div class='value_container'>";

				$html .= Form::label($this->html_id($index) , $value , $this->attribs);
				// name is common to all values,id is unique to use label as click region
				$html .= Form::checkbox($this->html_id()."[]",$key,null,array("id" => $this->html_id($index++)));

				$html .= "</div>";
			}
		}
		// radio buttons MUST use the same name for each element
		if($this->type=='radio') {
			$index = 1;
			foreach($this->values as $key => $value) {
				$html .= "<div class='value_container'>";

				$html .= Form::label($this->html_id($index) , $value , $this->attribs);
				// name is common to all values,id is unique to use label as click region
				$html .= Form::radio($this->html_id(),$key,null,array("id" => $this->html_id($index++)));

				$html .= "</div>";
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
		/*
			This is a fudge
			each value is actually a question!!
		 */
		if($this->type=='scale') {
			$options=[];
			$index=0;
			// now display the scale values!!
			for($i=1;$i<=5;$i++) {
				$html .= "<div class='value_container'>";

				// use index for the id
				$html .= Form::label($this->html_id($index) , $i );
				$html .= Form::radio($this->html_id() , $i, null,array("id" => $this->html_id($index++)));

				$html .= "</div>";
			}				
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
		if($this->type=='password') {
			$html .= Form::password($this->html_id(),$this->value);			
		}
		if($this->type=='date') {
			$html .= Form::input('date',$this->html_id(),$this->value);			
		}
		if($this->type=='time') {
			$html .= Form::input('time',$this->html_id(),$this->value);			
		}
		if($this->type=='color') {
			$html .= Form::input('color',$this->html_id(),$this->value);			
		}
		if($this->type=='month') {
			$html .= Form::input('month',$this->html_id(),$this->value);			
		}
		if($this->type=='week') {
			$html .= Form::input('week',$this->html_id(),$this->value);			
		}
		if($this->type=='range') {
			$html .= Form::input('range',$this->html_id(),$this->value);			
		}
		if($this->type=='url') {
			$html .= Form::input('url',$this->html_id(),$this->value);			
		}
		if($this->type=='tel' || $this->type=='phone' ) {
			$html .= Form::input('tel',$this->html_id(),$this->value);			
		}
		if($this->type=='textarea') {
			$html .= Form::textarea($this->html_id(),$this->value);			
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