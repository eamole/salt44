@extends("master")


@section("content")


	@include('appts.table')


	<div class="menuBar">

		{{ HTML::linkRoute('apptAdd',"Add Appointment" , null , ['class' => 'button']) }}

	</div>
	
@endsection
