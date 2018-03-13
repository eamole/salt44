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


			<div class="menuBar">
				
				<?php 
					if( $question->questionnaire->is_last_question() ) {
						echo Form::submit("Finish");
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
				{{  HTML::linkAction(
						"QuestionnairesController@saveToClient",
						"Save",
						null,
						['class' => "button"]
					)
				}}

				{{  HTML::linkAction(
						"QuestionnairesController@restart",
						"Restart",
						[$question->questionnaire->id],
						['class' => "button"]
					)
				}}

			</div>


			<!-- $question }} -->
			{{ $question->render() }} 

			<br clear='all' />



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
	  			var el = e.target;
	  			var xhtml = tinymce.activeEditor.getContent();
	  			// var html = xhtml + "<span class='snippet'>" + el.innerText + "</span>";
	  			var html = xhtml + " " + el.innerText;
	  			tinymce.activeEditor.setContent(html);
	  		});
		});

	</script>		

@stop