@extends("master")


@section("content")

	<div class="container warning">
		
		Warning : you are about to delete this record.<br/> Are you sure you wish to proceed?<br/>

	</div>


	<div class="menuBar">

		<?php 
			$urlOk = URL::action("ApptsController@deleteConfirm",array($appt->id));
			$urlCancel = URL::route('apptDisplay',array($appt->id));
		?>

		<a class='button' href='{{$urlOk}}'>Delete</a>
		<a class='button' href='{{$urlCancel}}'>Cancel</a>


	</div>

	@include('appts.displayLayout')

@endsection