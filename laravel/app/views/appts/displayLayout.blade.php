
	<div class="container form">
		<div class='panel'>

<!-- 			<div class="form-row">
				<span class="label">
					ID  : 
				</span>
				<span class="input">
					{{ $appt->id }}
				</span>
			</div>
 -->			
			<div class="form-row">
				<span class="label">
					Client : 
				</span>
				<span class="input">
					{{ $client }} <br/>
				</span>
			</div>


			<div class="form-row">
				<span class="label">
					Therapist : 
				</span>
				<span class="input">
					{{ $therapist }} <br/>
				</span>
			</div>


			<?php
				if(is_null($appt->attended)) { $attended="n/a"; }
				elseif( $appt->attended) {$attended = "yes"; }
				else{ $attended="no";} 
			?>
			<div class="form-row">
				<span class="label">
					Attended : 
				</span>
				<span class="input">
					{{ $attended }} <br/>
				</span>
			</div>


		</div>

		<div class='panel'>


			<div class="form-row">
				<span class="label">
					Date : 
				</span>
				<span class="input">
					{{ $appt->date }} <br/>
				</span>
			</div>

			<div class="form-row">
				<span class="label">
					Start : 
				</span>
				<span class="input">
					{{ $appt->start }} <br/>
				</span>
			</div>


			<div class="form-row">
				<span class="label">
					Finish : 
				</span>
				<span class="input">
					{{ $appt->finish }} <br/>
				</span>
			</div>
		
		</div>

		<br clear='all' />

		<div class="form-row">
			<span class="label">
				Notes : 
			</span>
			<span class="input textarea">
				{{ $appt->notes }} <br/>
			</span>
		</div>