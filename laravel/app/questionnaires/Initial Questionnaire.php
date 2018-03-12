<?php

Questionnaire::init("1","Initial Questionnaire",__FILE__)
->questions([

	[
			'label' => "Date of Birth ",
			'type' => "date",
			'rules' => "required"
		],
	[
			'label' => "Your GPs name" ,
			'rules' => "required",
			'type' => "text"
		],
	[
			'label' => "Symptoms" ,
			'type' => "checkbox",
			'values' => [ "Ringing in ears" , "Stammer", "Dry Mouth" , "Panic"],
			'multiple' => true,
			'rules' => "required"

		],
	[
			'label' => "Who referred you" ,
			'rules' => "required",
			'type' => "select",
			'multiple' => true,
			'values' => [ "GP" , "Self" , "Hospital" , "School"]
		],
	[
			'label' => "Occupation" ,
			'rules' => "required",
			'type' => "radio" ,
			'values' => ["Student","Working fulltime","Working part time","Unemployed","Retired"]
		]
		
]);