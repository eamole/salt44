	<table>
		<thead>
			<tr>
				<th class='id'>ID</th>
				<th class='client'>Client</th>
				<th class='patient'>Therapist</th>
				<th class='start'>Date</th>
				<th class='start'>Start</th>
				<th class='finish'>Finish</th>
				<th class='attended'>Attended</th>
				
				
			</tr>
		</thead>
		<tbody>
			@foreach($appts as $key => $appt)	<!-- $value is a record/array of values-->
				<?php 
					$url = URL::route('apptDisplay',$appt->id);

					$client=$appt->client->name;

					$therapist=$appt->therapist->name;

					if(is_null($appt->attended)) { $attended="n/a"; }
					elseif( $appt->attended) {$attended = "yes"; }
					else{ $attended="no";} 
				?>
				<tr>
					<td> {{ HTML::linkRoute('apptDisplay', $appt->id 	, $appt->id) }}</td>
					<td> {{ HTML::linkRoute('apptDisplay', $client 		, $appt->id) }}</td>
					<td> {{ HTML::linkRoute('apptDisplay', $therapist 	, $appt->id) }}</td>
					<td> {{ HTML::linkRoute('apptDisplay', $appt->date 	, $appt->id) }}</td>
					<td> {{ HTML::linkRoute('apptDisplay', $appt->start , $appt->id) }}</td>
					<td> {{ HTML::linkRoute('apptDisplay', $appt->finish , $appt->id) }}</td>
					<td> {{ HTML::linkRoute('apptDisplay', $attended , $appt->id) }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>