

	<!-- onSubmit go to clientSave,and pass in the route to this form (for errors) -->
	{{ Form::model( $client , array('route' => 'clientSave' )) }}
	

		<div class="menuBar">
			
			<?php 
				if($from=='add')
					$urlCancel = URL::route('clientsDisplayAll');
				else 
					$urlCancel = URL::route('clientDisplay',array($client->id));
			?>
			{{ Form::submit("Save Client") }}
			<a class='button' href='{{$urlCancel}}'>Cancel</a>
			
		</div>


		<div class='panel'>
			<!-- {{ myLabel('id','ID  :') }} -->
			 {{ Form::input('hidden','id' , $client->id , ['readonly'] )  }} 
			
			{{ myLabel('name','Name :') }}
			 	{{ Form::text('name',$client->name) }} <br/>
			
			{{ myLabel('phone' , 'Phone : ') }}
				{{ Form::input('tel','phone',$client->phone) }} <br/>

			{{ myLabel('email' , 'Email : ') }}
				{{ Form::email('email',$client->email) }} <br/>

			{{ myLabel('address' , 'Address : ') }}
				{{ Form::textarea('address',$client->address , [ 'rows' => 4 ]) }} <br/>

		</div>

		<div class='panel'>
	
			{{ myLabel('pps' , 'PPS : ') }}
				{{ Form::text('pps',$client->pps) }} <br/>

			{{ myLabel('dob' , 'Date of Birth : ') }}
				{{ Form::input('date','dob',$client->dob) }} <br/>

			{{ myLabel('therapist_id' , 'Therapist : ') }}
				{{ Form::select('therapist_id',$therapists,$client->therapist_id) }} <br/>

<!--
 			{{ myLabel('username' , 'Login ID : ') }}
				{{ Form::text('username',$client->username) }} <br/>

			{{ myLabel('password' , 'Password : ') }}
				{{ Form::input('password','password',$client->password) }} <br/>

			{{ myLabel('password_confirmation' , 'Confirm : ') }}
				{{ Form::input('password','password_confirmation',$client->password) }} <br/>

 -->		</div>
		
		<br clear='all' />

		{{ myLabel('notes' , 'Notes : ') }}
			{{ Form::textarea('notes',$client->notes , [ 'class' => 'notes' ] ) }} <br/>



	{{ Form::close() }}
	
	{{ HTML::script('js/tinymce/js/tinymce/tinymce.js') }}

	<script type="text/javascript">
		
		tinymce.init({
    		selector: '#notes',
    		width : "80%"
  		});
	</script>