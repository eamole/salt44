@extends("master")


@section("content")

	@include('appts.displayLayout')

	<div class="menuBar">
		{{ HTML::linkRoute('apptEdit','Edit Appointment',$appt->id,  ['class' => 'button']) }}
		{{ HTML::linkRoute('apptDelete','Delete Appointment',$appt->id , ['class' => 'button']) }}
		{{ HTML::linkRoute('apptAdd','Book Another Appointment',$appt->id , ['class' => 'button']) }}
		{{ HTML::linkRoute('apptsDisplayAll','Cancel' , null , ['class' => 'button']) }}
	</div>

@endsection


