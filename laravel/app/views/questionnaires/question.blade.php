@extends('master')

@section('content')

	
	<div class="container">
		
		 {{ Form::open( 
					array('action' => array(
						'QuestionnairesController@answer', 
						$question->questionnaire->id,
						$question->id
						)
					) 
				) 
		 }}
			<!-- $question }} -->
			{{ $question->render() }} 

		<br clear='all' />

		<div class="menuBar">
			
			<?php 
				// $urlCancel = URL::route('questionnaireBack',array($question->questionnaire->id,$question->id));
			?>
			<?php 
				if( $question->questionnaire->is_last_question() ) {
					echo Form::submit("Finish");
					// echo HTML::linkAction(
					// 	"QuestionnairesController@finish",
					// 	"Finish",
					// 	[$question->questionnaire->id],
					// 	['class' => "button"]
					// );
				} else {
					echo Form::submit("Next");
				}



				if(!$question->questionnaire->is_first_question() ) {
					echo HTML::linkAction(
						"QuestionnairesController@back",
						"Back",
						[$question->questionnaire->id],
						['class' => "button"]
					);
				}

			?>
<!-- 			<a class='button' href='$urlCancel}}'>Back</a>
			<a class='button' href='$urlCancel}}'>Cancel</a> 
 -->			
		</div>

		{{ Form::close() }}


	</div>
@stop