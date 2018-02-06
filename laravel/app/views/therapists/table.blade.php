
	<table id="xyz" class="display">
		<thead>
			<tr>
				<th class='id'>ID</th>
				<th class='name'>Name</th>
				<th class='phone'>Phone</th>
				<th class='email'>Email</th>
				<th class='password'>Password</th>
			</tr>
		</thead>
		<tbody>
			@foreach($therapists as $key => $therapist)	<!-- $value is a record/array of values-->
				<?php 
					$url = URL::route('therapistDisplay',$therapist->id);
				?>
				<tr>
					<td> {{ HTML::linkRoute('therapistDisplay', $therapist->id 	, $therapist->id) }}</td>
					<td> {{ HTML::linkRoute('therapistDisplay', $therapist->name 	, $therapist->id) }}</td>
					<td> {{ HTML::linkRoute('therapistDisplay', $therapist->phone , $therapist->id) }}</td>
					<td> {{ HTML::linkRoute('therapistDisplay', $therapist->email , $therapist->id) }}</td>
					<td> {{ HTML::linkRoute('therapistDisplay', $therapist->password , $therapist->id) }}</td>
						
		
				</tr>
			@endforeach
		</tbody>
	</table>

