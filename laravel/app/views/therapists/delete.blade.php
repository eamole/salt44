@extends("master")


@section("content")

	<div class="menuBar">

		<?php 
			$urlOk = URL::action("TherapistsController@deleteConfirm",array($therapist->id));
			$urlCancel = URL::route('therapistDisplay',array($therapist->id));
		?>

		<a class='button' href='{{$urlOk}}'>Delete</a>
		<a class='button' href='{{$urlCancel}}'>Cancel</a>


	</div>


	@include('therapists.displayLayout')

	<div class="container">
		
		Warning : you are about to delete this record.<br/> Are you sure you wish to proceed?<br/>

	</div>
	

@endsection