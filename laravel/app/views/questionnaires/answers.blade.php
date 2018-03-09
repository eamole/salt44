@extends('master')

@section('content')

	
	<div class="container">

		<table>
			<thead>
				<tr>
					<th colspan='3'>Answers for Client : {{ $questionnaire->client->name }}</th>
				</tr>

				<tr>
					<th>#</th>
					<th>Question</th>
					<th>Answer</th>
				</tr>
			</thead>

			<tbody>
				@foreach( $questionnaire->questions as $id => $question )
					<tr>
						<td>
							 {{ $question->id }}
						</td>

						<td>
							 {{ $question->label }}
						</td>

						<td>
							<?php 
								if(is_array($question->value)) {
									echo implode(", ",$question->value);
								} else {
									echo $question->value;
								}
							?>
							 
						</td>

					</tr>
				@endforeach
			</tbody>
		</table>

	</div>
@stop