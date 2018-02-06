@extends("master")


@section("content")


	<table>
		<thead>
			<tr>
				<th class='id'>ID</th>
				<th class='name'>Name</th>
				<th class='bio'>Bio</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $key => $author)	<!-- $value is a record/array of values-->
				<?php 
					$url = URL::route('authorDisplay',$author->id);
				?>
				<tr>
					<td> {{ HTML::linkRoute('authorDisplay', $author->id 	, $author->id) }}</td>
					<td> {{ HTML::linkRoute('authorDisplay', $author->name 	, $author->id) }}</td>
					<td> {{ HTML::linkRoute('authorDisplay', $author->bio 	, $author->id) }}</td>
						
		
				</tr>
			@endforeach
		</tbody>
	</table>
	<div class="menuBar">	
		{{ HTML::linkRoute('authorAdd',"Add Author" , null , ['class' => 'button']) }}
	</div>
	
@endsection
