@extends("master")


@section("content")

	<div class="menuBar">

		{{ HTML::linkRoute('therapistAdd',"Add Therapist" , null , ['class' => 'button']) }}
	
	</div>

	@include('therapists.table')

@endsection
