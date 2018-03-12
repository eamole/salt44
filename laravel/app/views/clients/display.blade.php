@extends("master")


@section("content")


	<div class="menuBar">
		{{ HTML::linkRoute('clientEdit','Edit Client',$client->id,  ['class' => 'button']) }}
		{{ HTML::linkRoute('clientDelete','Delete Client',$client->id , ['class' => 'button']) }}
		{{ HTML::linkRoute('clientDisplayAppts','Show Appointments',$client->id , ['class' => 'button']) }}
		{{ HTML::linkRoute('apptAddFromClient','Book Appointment',$client->id , ['class' => 'button']) }}
		{{ HTML::linkRoute('questionnairesDisplayAll','Questionnaires',$client->id,  ['class' => 'button']) }}		
		{{ HTML::linkRoute('clientsDisplayAll','Cancel' , null , ['class' => 'button']) }}
	</div>
		
	@include('clients.displayLayout')


@endsection


