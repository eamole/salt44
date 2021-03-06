@extends("master")


@section("content")

	<div class="menuBar">
		{{ HTML::linkRoute('clientEdit','Edit Client',$client->id,  ['class' => 'button']) }}
		{{ HTML::linkRoute('clientDelete','Delete Client',$client->id , ['class' => 'button']) }}
		{{ HTML::linkRoute('clientDisplay','Cancel' , $client->id , ['class' => 'button']) }}
	</div>

	@include('clients.displayLayout')


	<h3>Appointments</h3>

	
	@include('appts.table')


@endsection


