<?php

$scale = "Please use the following scale<br/> 
			<h6>1 - Never or rarely<br/>
			2 - Occasionally<br/>
			3 - Normal<br/>
			4 - More often than expected<br/>
			5 - Very frequently<br/></h6>";

Questionnaire::init('1','Demo Questionnaire',__FILE__)
->section([
	'title' => "This is a section heading",
	'subtext' => "Show basic field types <br>
				<ul>
					<li>date (with default value)</li>
					<li>text box</li>
					<li>notepad</li>
					<li>phone</li>
					<li>email</li>
					<li> colour</li>
					<li>radio buttons</li>
					<li>checkboxes</li>
					<li>drop down selectors</li>
					<li>conditionally skip questions based on answers</li>
				</ul>
				<br>
				It also allows default settings to be passed to each question such as type, values, validation"
])
->questions([
	[	'label' => "A basic text field" ,
		'type' => "text"
	],
])
->section([
	'title' => "This is another section",
	'subtext' => "Continuing to show the different question types"
])
->questions([
	[	'label' => "Todays Date ",
		'type' => "date",
		'default' => 'today'
	],
	[	'label' => "Notepad" ,
		'type' 	=> "textarea",
		'values' => ['These','items','can','be','clicked','to','insert','text']
	],	
	[	'label' => "Phone Number " ,
		'type' 	=> "phone" 
	],
	[	'label' => "Email Address " ,
		'type' 	=> "email" 
	],
	[	'label' => "Colour " ,
		'type' 	=> "colour" 
	],
	[	'label' => "Radio Buttons" ,
		'type' 	=> "radio",
		'values' => ['School','GP','Specialist','Self','Hospital']
	],
	[	'label' => "Check boxes" ,
		'type' 	=> "checkbox",
		'values' => ['School','GP','Specialist','Self','Hospital']
	],
	[	'label' => "Drop down selector" ,
		'type' 	=> "select",
		'values' => ['School','GP','Specialist','Self','Hospital']
	],
	[	'label' => "Skip the next question if answer is No?",
		'type' => 'boolean',
		'next' => [ "if"  , 'No'  , "skip" ]
	],
	[	'label' => "Big Label This question would be skipped if previous answer was No" ,
		'type' 	=> "text",
		'class' => 'big_label'
	]


])
->section([
	'title' => 'A Section With Similar Questions',
	'subtext'=>	"All questions in this section are similar in type so all question settings can be set 
				in the section heading and inherited by each question. This makes for a very quick setup.
				These questions are all of the type 'boolean' and answers are required",
	'type' 	=> 'boolean' ,
	'rules'	=> 'required'
])
->questions([
	[	'label' => "Psychologist" ,'anchor' =>'skip'],
	[	'label' => "Physical Therapist" ],

])
->section([
	'title' => "Section of questions of type'scale'",
	'subtext'=>	"How often would you eat these foods <br> $scale",
	'type' => 'scale' ,
	'rules'	=> 'required'
])
->questions([
	[	'label' => "Ice cream"],
	[	'label' => "Anchovies" ],

])
;