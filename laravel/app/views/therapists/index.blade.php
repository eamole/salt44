@extends("master")


@section("content")

	@include('therapists.table')

	<div class="menuBar">

		{{ HTML::linkRoute('therapistAdd',"Add Therapist" , null , ['class' => 'button']) }}
	
	</div>

@endsection
