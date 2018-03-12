<?php

$scale = "Please use the following scale to describe your childs behaviour<br/> 
			<h6>1 - Never or rarely exhibits this behaviour<br/>
			2 - Occasionally exhibits this behaviour<br/>
			3 - Exhibits this behaviour as much as is typical for child of this age<br/>
			4 - Exhibits this behaviour more often than expected<br/>
			5 - Very frequently exhibits this behaviour<br/></h6>";

Questionnaire::init('2','SALT Referral Questionnaire',__FILE__)
->section([
	'title' => "General Information",
	'rules' => 'required'
])
->questions([
	[	'label' => "Todays Date ",
		'type' => "date",
		'default' => 'today'
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
	[	'label' => "Who Referred Your Child" ,
		'type' 	=> "radio",
		'values' => ['School','GP','Specialist','Self','Hospital']
	]
])
->section([
	'title' => 'Developmental and Medical History',
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
		'next' => [ "if"  , 'No'  , "no_ear_infections" ]
	],
	[	'label' => "How frequently has it been treated medically? Specify how often in years and/or months" ,
		'type' => "textarea",
		'values' => ['Years', 'Months']
	],
	[	'label' => "How has it (ear infecdtions) been treated medically?" ,
		'type' => "textarea",
		'values' => ['Syringe','Pain Killers']
	]

])
->section([
	'title' => 'Developmental Milestones',
	'subtext' => " Please give approximate ages when your child accomplished major developmental milestones. Provide the number of months/years",
	'values' => ['Months','Years'],
	'type' 	=> 'text'

])
->questions([
	[	'label' => "Sitting independently" ,
		'anchor' => 'no_ear_infections'	/* jump to here */
	],
	[	'label' => "Crawling" 	],
	[	'label' => "Walking" 	],
	[	'label' => "Reaching" 	],
	[	'label' => "Talking" 	]
])
->section([
	'title' => "Medical History",
	'subtext' => $scale ,
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
])
->section([
	'title' => "Medical History - Allergies"
])
->questions([
	[	'label' => "Does your child have any allergies?",
		'type' => 'boolean',
		'next' => [ "if"  , 'No'  , "no_allergies" ]
	],
	[	'label' => "What is you child allergic to?" ,
		'type' => "textarea",
		'values' => ['Milk', 'Eggs', 'Peanuts', 'Soy', 'Wheat', 'Walnuts/Cashews', 'Fish', 'Shellfish','Animal Hair','Pollen','Dust Mites','Mold','Perfume','Cigarette smoke','Car exhaust']
	],
	[	'label' => "What symptoms does your child exhibit in relation to these allergies?" ,
		'type' => "textarea",
		'values' => ['Runny nose', 'Itchy nose', 'Sneezing', 'Postnasal drip', 'Nasal congestion',"Skin Rash",'Coughing','Itchy eyes','Upset stomach','Ear infections','Asthma']
	],
	[	'label' => "How are these allergies/symptoms medically managed?" ,
		'type' => "textarea",
		'values' => ['Epinephrine (Adrenaline)']
	],
	[	'label' => "Are there any behaviours which your child exhibits which you think may be related to your childs allergies or allergy medications ?" ,
		'type' => "textarea",
		'values' => ['Anger', 'Aggression', 'Tantrums', 'Mood swings', 'Depression', 'Reduced concentration','Drowsiness']
	]
])
->section([
	'title' => "Medical History - Medications"
])
->questions([
	[	'label' => "Does your child currently take any medications?",
		'type' => 'boolean',
		'anchor' => 'no_allergies',
		'next' => [ "if"  , 'No'  , "no_meds" ]
	],
	[	'label' => "What medications and dosages does your child take and for what conditions?" ,
		'type' => "textarea",
		'values' => ['See allergies above', 'Asthma', 'Inhaler']
	],
	[	'label' => "What behaviours does your child exhibit which you believe may be related to these medications?" ,
		'type' => "textarea",
		'values' => ['Drowsiness']
	]
])
->section([
	'title' => "Medical History - Medical Profesionals" , 
	'subtext' => "Please supply the name and addess of any medical professionals your child sees on a regular basis, and the reason why.",
	'type' => 'textarea',
	'values' => ['Not applicable']
])
->questions([
	[	'label' => "Does your child currently see ANY medical professionals on a regular basis ?",
		'type' => 'boolean',
		'anchor' => 'no_meds',
		'next' => [ "if"  , 'No'  , "no_doctors" ]
	],	
	[	'label' => "Psychologist" ],
	[	'label' => "Physical Therapist" ],
	[	'label' => "Speech Therapist" 	],
	[	'label' => "Neurologist" 		],
	[	'label' => "Resource of Special Teacher" 	],
	[	'label' => "Other" 				]
])
->section([
	'title' => "School History" , 
	'subtext' => "",
	'type' => 'text'
])
->questions([
	[	'label' => "What class/year is your child currently attending?" 		],
	[	'label' => "What school is your child attending?" ],
	[	'label' => "What is your child's teacher's name" 	],
	[	'label' => "Has your child had any formal evaluations/testing?",
		'type'  => 'boolean',
		'anchor' => 'no_doctors',
		'next' => ['if','No','no_testing']
	 ],
	[	'label' => "What testing has your child undergone and when?" ,
		'type' => 'textarea' ,
		'values' => ['Psychological Evaluation','Psychoeducational Evaluation','Cognitivre Testing',
					'Neuropsychological Evaluation' , 'Speech & Language Evauation' ,
					'Occupational Therapy Evaluation','Physical Therapy Evaluation' ,'Medical Evaluation',
					'Psychiatric Evaluation' ]
	]

])
->section([
	'title' => "Behaviour/Emotional Components" , 
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
	[	'label' => "Compliant" 		],
	[	'label' => "Displays affection towards others" 	],
	[	'label' => "Displays aggression towards self" 		],
	[	'label' => "Displays aggession towards others" 		],
	[	'label' => "Irrritable" 	],
	[	'label' => "Cries easily" 	],
	[	'label' => "Seems happy" 	],
	[	'label' => "Seems immature for age" 	],
	[	'label' => "Displays rapid mood swings" 	],
	[	'label' => "Seems independent" 	],
	[	'label' => "Seems dependent" 	],
	[	'label' => "'Baby talks'" 	],
	[	'label' => "Seems to need a lot of comfort and nurturing" 	],
	[	'label' => "Seems inpulsive" 	]
])
->section([
	'title' => "Communication" , 
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
	[	'label' => "Initiates eye contact when greeting someone" 		],
	[	'label' => "Initiates eye contact when requesting information" 	],
	[	'label' => "Sustains eye contact" 		],
	[	'label' => "Takes turns" 		],
	[	'label' => "Interacts with peers" 	],
	[	'label' => "Interacts with adults" 	],
	[	'label' => "Participates in conversations" 	],
	[	'label' => "Responds to verbal infiramtion in a timely manner" 	],
])
->section([
	'title' => "Communication - Continued" , 
	'type' => 'textarea' ,
	'rules' => 'required'
])
->questions([
	[	'label' => "Is your child non-verbal?",
		'type' => 'boolean',
		'next' => ['if','No','verbal']
	],
	[	'label' 	=> "What types of vocalisations does you child use and how often?" 	],
	[	'label' 	=> "How does your child communicate? Please give examples",
		'values' 	=> ['Sign language','Baby talk'],
		'next' 		=> ['jump_to' , 'verbal']
	],
	[	'label' => "Please describe your childs verbal abilities 
				(ie vocabulary, ability to stay on topic etc)", 		
		'anchor' => 'verbal'
	]
])
->section([
	'title' => "Self-Care/Daily Routines" ,
	'subtext' => "Please describe a typical mealtime with your child?",
	'type' => 'textarea' ,
	'rules' => 'required'
])
->questions([
	[	'label' => "Where does you child eat?",
		'values' => ['Baby chair','At dining table','At TV','In bedroom','Alone','With Family','With Friends']
	],
	[	'label' => "What does you child eat?",
		'values' => ['Regular meals','Snacks','Sweets/treats']
	],
	[	'label' => "How does you child eat?",
		'type' => 'textarea',
		'values' => ['Normally','Throws food','Picks slowly']
	],	
	[	'label' => "What is your childs behaviour during mealtimes?",
		'type' => 'textarea',
		'values' => ['Normal','Disruptive','Disinterested','Distracted']
	],
])
->section([
	'title' => "Arousal/Attention/Self-Regulation" , 
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
	[	'label' => "Is an early morning riser" 		],
	[	'label' => "Awakens during the night" 		],
	[	'label' => "Has difficulty falling asleep" 		],
	[	'label' => "Is irritable on awakening" 		],
	[	'label' => "Wets bed" 		],
	[	'label' => "Attends to toys" 		],
	[	'label' => "Attends to school" 		],
	[	'label' => "Attends to new environments" 		],
	[	'label' => "Able to independently sustain attention" 		],
	[	'label' => "Independently explores" 		]
])
->section([
	'title' => "Balance/Body/Awareness/Praxis" , 
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
	[	'label' => "Initiates new activities" 		],
	[	'label' => "Understands how to play with new/novel toys" 		],
	[	'label' => "Plays with same toy in variety of ways" 		],
	[	'label' => "Able to perform sequential tasks" 		],
	[	'label' => "Jumps" 		],
	[	'label' => "Plays on playground equipment" 		],
	[	'label' => "Swings" 		],
	[	'label' => "Enjoys roughhouse type play" ],
	[	'label' => "Takes risks" 		],
	[	'label' => "Seems aware of safety concerns" ]
])











;
