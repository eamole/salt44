<?php

Questionnaire::init('3','Scale Survey')
->section([
	'title' => "Medical History",
	'subtext' =>"Please use the following scale to describe your childs behaviour<br/> 
			1 - Never or rarely exhibits this behaviour<br/>
			2 - Occasionally exhibits this behaviour<br/>
			3 - Exhibits this behaviour as much as is typical for child of this age<br/>
			4 - Exhibits this behaviour more often than expected<br/>
			5 - Very frequently exhibits this behaviour<br/>",
	// common question parameters - maybe create a defaults array
	'type' => 'scale' ,
	'scale' => [1,5],
	'rules' => 'required'
])
->questions([
	[	'label' => "Diarrhoea" 		],
	[	'label' => "Stomach Ache" 	],
	[	'label' => "Vomiting" 		],
	[	'label' => "Headache" 		],
	[	'label' => "Constipation" 	],
	[	'label' => "Ear Ache" 		]
]);