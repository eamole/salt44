<!-- 

we can use blade and php to construct the JSON array 
the structure needs to be an array of questions
each question must have an id, number
-->
[

	'1' : {
			label : "Date of Birth ",
			type : 'number'
		},
	'2' : {
			label : 'Your GP's name' ,
			type : "text"
		}
	'3' : {
			label : 'Symptoms' ,
			type : "checkboxes",
			values : [ 'Ringing in ears' , 'Stammer', 'Dry Mouth' , 'Panic'],
			multiple : true

		}
	'4' : {
			label : 'Who referred you' ,
			type : 'select',
			values : [ 'GP' , 'self' , 'Hospital' , 'School']
		}
	'5' : {
			label : 'Occupation' ,
			type : 'radio' ,
			values : ['Student','Working fulltime','Working part time','Unemployed','Retired']
		}

]