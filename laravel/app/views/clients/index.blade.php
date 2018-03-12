@extends("master")


@section("content")

	<div class="menuBar">

		{{ HTML::linkRoute('clientAdd',"Add Client" , null , ['class' => 'button']) }}

	</div>

	@include('clients.table')

	
@endsection
