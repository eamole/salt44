@extends("master")


@section("content")

	<div class="menuBar">
		{{ HTML::linkRoute('therapistEdit','Edit Therapist',$therapist->id,  ['class' => 'button']) }}
		{{ HTML::linkRoute('therapistDelete','Delete Therapist',$therapist->id , ['class' => 'button']) }}
		{{ HTML::linkRoute('therapistDisplayClients','Show Clients',$therapist->id , ['class' => 'button']) }}
		{{ HTML::linkRoute('apptAddFromTherapist','Make Appointment',$therapist->id , ['class' => 'button']) }}
		{{ HTML::linkRoute('therapistDisplay','Cancel' , $therapist->id , ['class' => 'button']) }}
	</div>

	@include('therapists.displayLayout')


	<h3>Appointments</h3>


	@include('appts.table')	


@endsection


