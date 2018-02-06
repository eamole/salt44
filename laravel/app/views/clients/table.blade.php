	
	<table>
		<thead>
			<tr>
				<th class='id'>ID</th>
				<th class='name'>Name</th>
				<th class='therapist'>Therapist</th>
				<th class='phone'>Phone</th>
				<th class='email'>Email</th>
				
				
			</tr>
		</thead>
		<tbody>
			@foreach($clients as $key => $client)	<!-- $value is a record/array of values-->
				<?php 
					$url = URL::route('clientDisplay',$client->id);
				?>
				<tr>
					<td> {{ HTML::linkRoute('clientDisplay', $client->id 	, $client->id) }}</td>
					<td> {{ HTML::linkRoute('clientDisplay', $client->name 	, $client->id) }}</td>
					<td> {{ HTML::linkRoute('clientDisplay', $client->therapist->name , $client->id) }}</td>
					<td> {{ HTML::linkRoute('clientDisplay', $client->phone , $client->id) }}</td>
					<td> {{ HTML::linkRoute('clientDisplay', $client->email , $client->id) }}</td>
						
		
				</tr>
			@endforeach
		</tbody>
	</table>