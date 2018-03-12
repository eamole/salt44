<?php

Questionnaire::init('4','Test Jumping')
->questions([
	[ 	'label' => "Today" ,
		'type' => 'date' ,
		'default' => 'today'
	],
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
		'next' => [ "if_is"  , 'No'  , "x" ]
	],
	[	'label' => "How has it (ear infextion) been treated medically?" ,
		'type' => "textarea"
	],	
	[	'label' => "How frequently has it been treated?" ,
		'type' => "number",
		'text_after' => "per year"
	],
	[	'label' => "Sitting independently" ,
		'type' => "number",
		'default' => 6,
		'anchor' => 'x'	/* jump to here */
	]

]);


