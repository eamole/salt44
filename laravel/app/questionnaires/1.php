<?php

Questionnaire::init("1","Initial Questionnaire")
->questions([

	"1" => [
			'label' => "Date of Birth ",
			'type' => "date",
			'rules' => "required"
		],
	"2" => [
			'label' => "Your GPs name" ,
			'rules' => "required",
			'type' => "text"
		],
	"3" => [
			'label' => "Symptoms" ,
			'type' => "checkbox",
			'values' => [ "Ringing in ears" , "Stammer", "Dry Mouth" , "Panic"],
			'multiple' => true,
			'rules' => "required"

		],
	"4" => [
			'label' => "Who referred you" ,
			'rules' => "required",
			'type' => "select",
			'multiple' => true,
			'values' => [ "GP" , "Self" , "Hospital" , "School"]
		],
	"5" => [
			'label' => "Occupation" ,
			'rules' => "required",
			'type' => "radio" ,
			'values' => ["Student","Working fulltime","Working part time","Unemployed","Retired"]
		]
		
]);