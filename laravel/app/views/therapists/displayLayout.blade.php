
	<div class="container form">


		<div class='panel'>

	<!-- 		<div class="form-row">
				<span class="label">
					ID  : 
				</span>
				<span class="input">
					{{ $therapist->id }}
				</span>
			</div>
	 -->		
			<div class="form-row">
				<span class="label">
					Name : 
				</span>
				<span class="input">
					{{ $therapist->name }} <br/>
				</span>
			</div>

			<div class="form-row">
				<span class="label">
					Phone : 
				</span>
				<span class="input">
					{{ $therapist->phone }} <br/>
				</span>
			</div>

		</div>

		<div class='panel2'>


			<div class="form-row">
				<span class="label">
					Email : 
				</span>
				<span class="input">
					{{ $therapist->email }} <br/>
				</span>
			</div>

			<div class="form-row">
				<span class="label">
					Login ID : 
				</span>
				<span class="input">
					{{ $therapist->username }} <br/>
				</span>
			</div>

		</div>

	</div>

	<br clear='all' />