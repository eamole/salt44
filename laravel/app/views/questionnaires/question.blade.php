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

	{{ HTML::script('js/tinymce/js/tinymce/tinymce.js') }}

	<script type="text/javascript">
		
		tinymce.init({
    		selector: 'textarea',
    		width : "50%",
    		display:"inline-block"

  		});
		document.addEventListener("DOMContentLoaded", function(event) {
	  		$(".snippet").click(function(e){
	  			debugger;
	  			var el = e.target;
	  			var xhtml = tinymce.activeEditor.getContent();
	  			var html = xhtml + "<span class='snippet'>" + el.innerText + "</span>";
	  			tinymce.activeEditor.setContent(html);
	  		});
		});

	</script>		

@stop