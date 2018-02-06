@extends("master")


@section("content")


	@include('clients.displayLayout')


	<div class="container">

		
		Warning : you are about to delete this record.<br/> Are you sure you wish to proceed?<br/>

	</div>
	
	<div class="menuBar">

		<?php 
			$urlOk = URL::action("ClientsController@deleteConfirm",array($client->id));
			$urlCancel = URL::route('clientDisplay',array($client->id));
		?>

		<a class='button' href='{{$urlOk}}'>Delete</a>
		<a class='button' href='{{$urlCancel}}'>Cancel</a>


	</div>



@endsection