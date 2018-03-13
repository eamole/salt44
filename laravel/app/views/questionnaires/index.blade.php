@extends('master')

@section('content')

	
	<div class="container">

		<table>
			<thead>
				<tr>
					<th>Questionnaires for Client : {{ $client->name }}</th>
					<th>Saved</th>
				</tr>
			</thead>

			<tbody>
				@foreach( $questionnaires as $id => $questionnaire )
					<tr>
						<td>
							<!-- $questionnaire  -->

							 {{ HTML::linkRoute(
								'questionnaireStart', 
								$questionnaire->title , 
								$questionnaire->id) }}
						</td>
						<td>
							{{ yesNo($questionnaire->isSavedToClient()) }}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

	</div>
@stop