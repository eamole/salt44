<?php

Questionnaire::init('3','Scale Survey')
->section("Please use the following scale to describe your childs behaviour<br/>","
			1 - Never or rarely exhibits this behaviour<br/>
			2 - Occasionally exhibits this behaviour<br/>
			3 - Exhibits this behaviour as much as is typical for child of this age<br/>
			4 - Exhibits this behaviour more often than expected<br/>
			5 - Very frequently exhibits this behaviour<br/>")
->questions([
		

	"1" => [
			'label' => "Diarrhoea" ,
			'rules' => "required",			
			'type' => "scale" ,
			'scale' => [1,5]
		],
	"2" => [
			'label' => "Stomach Ache" ,
			'rules' => "required",
			'type' => "scale" ,
			'scale' => [1,5]
		],
	"3" => [
			'label' => "Vomiting" ,
			'rules' => "required",
			'type' => "scale" ,
			'scale' => [1,5]
		],
	"4" => [
			'label' => "Headache" ,
			'rules' => "required",
			'type' => "scale" ,
			'scale' => [1,5]
		],
	"5" => [
			'label' => "Constipation" ,
			'rules' => "required",
			'type' => "scale" ,
			'scale' => [1,5]
		],
	"6" => [
			'label' => "Ear Ache" ,
			'rules' => "required",
			'type' => "scale" ,
			'scale' => [1,5]
		]

]);