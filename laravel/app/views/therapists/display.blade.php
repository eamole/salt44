@extends("master")


@section("content")

	<div class="menuBar">
		{{ HTML::linkRoute('therapistEdit','Edit Therapist',$therapist->id,  ['class' => 'button']) }}
		{{ HTML::linkRoute('therapistDelete','Delete Therapist',$therapist->id , ['class' => 'button']) }}
		{{ HTML::linkRoute('therapistDisplayClients','Show Clients',$therapist->id , ['class' => 'button']) }}
		{{ HTML::linkRoute('therapistDisplayAppts','Show Appointments',$therapist->id , ['class' => 'button']) }}
		{{ HTML::linkRoute('therapistsDisplayAll','Cancel' , null , ['class' => 'button']) }}
	</div>

	@include('therapists.displayLayout')


@endsection


