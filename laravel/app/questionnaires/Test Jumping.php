<?php

Questionnaire::init('4','Test Jumping',__FILE__)
->section([
	'title' =>"Heading" ,
	'subtext' => 'Sub heading'
])
->questions([
	[	'label' => "Does your child have a history of ear infections?",
		'type' => 'boolean',
		'next' => [ "if"  , 'No'  , "x" ]
	],
	[	'label' => "How frequently has it been treated medically? Specify how often in years and/or months" ,
		'type' => "text",
		'values' => ['Years', 'Months']
	],
	[	'label' => "How has it (ear infections) been treated medically?" ,
		'type' => "textarea",
		'values' => ['Syringe','Pain Killers']
	],
	[	'label' => "At what age did your child start sitting independently? (Years and/or months)" ,
		'type' => "text",
		'default' => 6,
		'anchor' => 'x'	/* jump to here */
	]

]);


