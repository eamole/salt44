<!-- script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=tvbxsa72we4nv1jpkrbcpr3trojzpx3uocvexclbeai4pu7k"></script--> 

	<!-- onSubmit go to apptSave,and pass in the route to this form (for errors) -->
	{{ Form::model( $appt , array('route' => array('apptSave' , $returnRoute ))) }}
	
		<div class='panel' >

			<!-- {{ myLabel('id','ID  :') }} -->
			 {{ Form::input('hidden','id' , $appt->id , ['readonly'] )  }} 

			{{ myLabel('client_id' , 'Client : ') }}
				{{ Form::select('client_id',$clients,$appt->client_id) }} <br/>

			{{ myLabel('therapist_id' , 'Therapist : ') }}
				{{ Form::select('therapist_id',$therapists,$appt->therapist_id) }} <br/>

			{{ myLabel('attended' , 'Attended  : ') }}
				{{ Form::checkbox('attended',$appt->attended) }} <br/>				

		</div>

		<div class='panel' >


			{{ myLabel('date' , 'Date  : ') }}
				{{ Form::input('date','date',$appt->date) }} <br/>

			{{ myLabel('start' , 'Start  : ') }}
				{{ Form::input('time','start',$appt->start) }} <br/>

			{{ myLabel('finish' , 'Finish  : ') }}
				{{ Form::input('time','finish',$appt->finish) }} <br/>


		</div>

		<br clear='all' />
		<span class='mce_box'>
		{{ myLabel('notes' , 'Notes : ') }}
			{{ Form::textarea('notes', $appt->notes,[ 'class' => 'notes' , 'id' => 'notes' ]) }} 

		</span>

		<?php
			if(!is_null($appt->id)){
				echo TemplatesController::displayAll($appt->id);
			}

		?>

		<div class="menuBar">
			
			<?php 
				$urlCancel = URL::route('apptsDisplayAll');	// array($appt->id)
			?>

			{{ Form::submit("Save Appointment") }}
			<a class='button' href='{{$urlCancel}}'>Cancel</a>
			
		</div>

	{{ Form::close() }}

	{{ HTML::script('js/tinymce/js/tinymce/tinymce.js') }}

	<script type="text/javascript">
		
		tinymce.init({
    		selector: '#notes',
    		width : "80%"
  		});
	</script>