<?php

Questionnaire::$load_questions = [

	"1" => [
			'label' => "Date of Birth ",
			'type' => "number"
		],
	"2" => [
			'label' => "Your GPs name" ,
			'type' => "text"
		],
	"3" => [
			'label' => "Symptoms" ,
			'type' => "checkbox",
			'values' => [ "Ringing in ears" , "Stammer", "Dry Mouth" , "Panic"],
			'multiple' => true

		],
	"4" => [
			'label' => "Who referred you" ,
			'type' => "select",
			'values' => [ "GP" , "Self" , "Hospital" , "School"]
		],
	"5" => [
			'label' => "Occupation" ,
			'type' => "radio" ,
			'values' => ["Student","Working fulltime","Working part time","Unemployed","Retired"]
		]

];