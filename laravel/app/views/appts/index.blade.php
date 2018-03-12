@extends("master")


@section("content")


	<div class="menuBar">

		{{ HTML::linkRoute('apptAdd',"Add Appointment" , null , ['class' => 'button']) }}

	</div>
	
	@include('appts.table')

	
@endsection
