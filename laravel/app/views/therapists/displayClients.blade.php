@extends("master")


@section("content")


	@include('therapists.displayLayout')

	<h3>Clients</h3>

	@include('clients.table')


	<div class="menuBar">
		{{ HTML::linkRoute('therapistEdit','Edit Therapist',$therapist->id,  ['class' => 'button']) }}
		{{ HTML::linkRoute('therapistDelete','Delete Therapist',$therapist->id , ['class' => 'button']) }}
		{{ HTML::linkRoute('therapistDisplay','Cancel' , $therapist->id , ['class' => 'button']) }}
	</div>

@endsection


