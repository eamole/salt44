<?php

Questionnaire::init('2','SALT Referral Questionnaire ')
->section([
	'title' => "General Information",
	'rules' => 'required'
])
->questions([
	[	'label' => "Todays Date ",
		'type' => "date",
		'default' => date('d/m/Y', time())
	],
	[	'label' => "Child's name" ,
		'type' => "text"
	],
	[	'label' => "Date of Birth" ,
		'type' => 'date'
	]
])
->section([
	'title' => 'Parent/Guardian Details',
])
->questions([
	[	'label' => "Parent/Guardian Names" ,
		'type' 	=> "text",
		'class' => 'big_label'
	],
	[	'label' => "Address" ,
		'type' 	=> "textarea" 
	],	
	[	'label' => "Home Phone " ,
		'type' 	=> "phone" 
	],
	[	'label' => "Work Phone " ,
		'type' 	=> "phone" 
	],
	[	'label' => "Mobile Phone " ,
		'type' 	=> "phone" 
	],
	[	'label' => "Email Address " ,
		'type' 	=> "email" 
	],
	[	'label' => "Whoe Referred Your Child" ,
		'type' 	=> "radio",
		'values' => ['School','GP','Specialist','Self','Hospital']
	]
])
->section([
	'title' => 'Developmental and Medial History',
])
->questions([
	[	'label' => "Describe your childs birth history. List any complications during pergnancy, birth or infancy" ,
		'type' 	=> "textarea",
		'values' => ['Measles','Mumps','Placenta Previa']
	],
	[	'label' => "Describe any developmental challenges your child has faced or continues to face" ,
		'type' => "textarea" ,
		'values' => ['Dyslexia']
	],
	[	'label' => "Does your child have a history of ear infections?",
		'type' => 'boolean',
		'next' => [ "if"  , 'Yes'  , "x" ]
	],
	[	'label' => "How frequently and how has it (ear infextions) been treated medically?" ,
		'type' => "textarea"
	]

])
->section([
	'title' => 'Developmental Milestones',
	'subtext' => " Please give approximate ages when your child accomplished major developmental milestones",

])
->questions([
	[	'label' => "Sitting independently" ,
		'type' => "number",
		'anchor' => 'x'	/* jump to here */
	],
	[	'label' => "Crawling" ,
		'type' => "number",
	],
	[	'label' => "Walking" ,
		'type' => "number",
	],
	[	'label' => "Reaching" ,
		'type' => "number",
	],
	[	'label' => "Talking" ,
		'type' => "number",
	]
]);