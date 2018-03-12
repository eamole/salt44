<?php

Questionnaire::init('4','Test Jumping')
->questions([
	[ 	'label' => "Today" ,
		'type' => 'date' ,
		'default' => 'today'
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


