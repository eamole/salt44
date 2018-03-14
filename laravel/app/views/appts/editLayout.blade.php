<!-- script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=tvbxsa72we4nv1jpkrbcpr3trojzpx3uocvexclbeai4pu7k"></script--> 

	<!-- onSubmit go to apptSave,and pass in the route to this form (for errors) -->
	{{ Form::model( $appt , array('route' => array('apptSave' , $returnRoute ))) }}

		<div class="menuBar">
			
			<?php 
				if($from=='add')
					$urlCancel = URL::route('apptsDisplayAll');
				else 
					$urlCancel = URL::route('apptDisplay',array($appt->id));
			?>
			{{ Form::submit("Save Appointment") }}
			<a class='button' href='{{$urlCancel}}'>Cancel</a>
			
		</div>
	
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

		<div class='template_container'>
			<div class='mce_box'>
				{{ myLabel('notes' , 'Notes : ') }}
					{{ Form::textarea('notes', $appt->notes,[ 'class' => 'notes' , 'id' => 'notes' ]) }} 

			</div>

			<div class='templates_bar'>
				<!-- only allow templates after the appt has an id - otherwise template error -->
				@if(!is_null($appt->id))
					{{ myLabel('' , 'Templates') }} 
						{{ TemplatesController::displayAll($appt->id) }}
				@endif
			</div>
			
		</div>

		<div style="clear:both"></div>

	{{ Form::close() }}

	{{ HTML::script('js/tinymce/js/tinymce/tinymce.js') }}

	<script type="text/javascript">
		
		tinymce.init({
    		selector: '#notes',
    		width : "80%"
  		});
	</script>