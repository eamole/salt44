@extends("master")


@section("content")


	@include('clients.table')


	<div class="menuBar">

		{{ HTML::linkRoute('clientAdd',"Add Client" , null , ['class' => 'button']) }}

	</div>
	
@endsection
