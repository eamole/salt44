@extends("master")


@section("content")
	<!-- onSubmit go to therapistSave,and pass in the route to this form (for errors) -->
	{{  Form::open(array('route' => 'loginValidate')) }}
	
		

		<div class='panel'>

			{{ myLabel('username' , 'Login ID : ') }}
				{{ Form::text('username') }} <br/>

			{{ myLabel('password' , 'Password : ') }}
				{{ Form::input('password','password') }} <br/>


		</div>

		<br clear='all' />

		<div class="menuBar">
			
			<?php 
				$urlCancel = URL::route('home');
			?>

			{{ Form::submit("Login") }}
			<a class='button' href='{{$urlCancel}}'>Cancel</a>
			
		</div>

	{{ Form::close() }}
@endsection