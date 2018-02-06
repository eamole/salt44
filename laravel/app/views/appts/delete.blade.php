@extends("master")


@section("content")

	@include('appts.displayLayout')

	<div class="container">

		
		Warning : you are about to delete this Appointment.<br/> Are you sure you wish to proceed?<br/>

	</div>
	
	<div class="menuBar">

		<?php 
			$urlOk = URL::action("ApptsController@deleteConfirm",array($appt->id));
			$urlCancel = URL::route('apptDisplay',array($appt->id));
		?>

		<a class='button' href='{{$urlOk}}'>Delete</a>
		<a class='button' href='{{$urlCancel}}'>Cancel</a>


	</div>



@endsection