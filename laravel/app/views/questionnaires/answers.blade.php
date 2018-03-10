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
				<?php
					$section_title = "";
				?>
				@foreach( $questionnaire->questions as $id => $question )
					@if($section_title !== $question->section['title'])
						<tr class="section">
							<td colspan='3'>
								<?php 
									$section_title = $question->section['title'];
								?>
								{{ $section_title }}
							</td>
						</tr>
					@endif
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