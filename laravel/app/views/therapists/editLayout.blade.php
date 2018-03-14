	<?php 

		

	?>
	<!-- onSubmit go to therapistSave,and pass in the route to this form (for errors) -->
	{{ Form::model( $therapist , array('route' => 'therapistSave' )) }} 

		<div class="menuBar">
			
			<?php 
				if($from=='add')
					$urlCancel = URL::route('therapistsDisplayAll');
				else 
					$urlCancel = URL::route('therapistDisplay',array($therapist->id));
			?>

			{{ Form::submit("Save Therapist") }}
			<a class='button' href='{{$urlCancel}}'>Cancel</a>
			
		</div>

		<div class='panel'>

			<!-- {{ myLabel('id','ID  :') }} -->
			 {{ Form::input('hidden','id' , $therapist->id , ['readonly'] )  }} 
			
			{{ myLabel('name','Name :') }}
			 	{{ Form::text('name',$therapist->name) }} <br/>
			
			{{ myLabel('phone' , 'Phone : ') }}
				{{ Form::text('phone',$therapist->phone) }} <br/>

			{{ myLabel('email' , 'Email : ') }}
				{{ Form::email('email',$therapist->email) }} <br/>

		</div>

		<div class='panel'>

			{{ myLabel('username' , 'Login ID : ') }}
				{{ Form::text('username',$therapist->username) }} <br/>

			{{ myLabel('password' , 'Password : ') }}
				{{ Form::input('password','password',$therapist->password) }} <br/>

			{{ myLabel('password_confirmation' , 'Confirm : ') }}
				{{ Form::input('password','password_confirmation',$therapist->password) }} <br/>
			
			<?php 
				if(isAdmin()) {
			
					echo myLabel('isAdmin' , 'Admin ? : ') ;
					$str = Form::checkbox('isAdmin',$therapist->isAdmin);
					//echo "<pre>".$str."</pre>";
						echo $str."<br/>";
				
				}

			?> 	
				


		</div>

		<br clear="all"/>

	{{ Form::close() }}
