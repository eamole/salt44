@extends("master")


@section("content")

	<!-- onSubmit go to authorSave,and pass in the route to this form (for errors) -->
	{{ Form::model( $author , array('route' => array('authorSave' , 'authorAdd' ))) }}
	
<!-- 		{{ Form::label('id','ID  :') }}
		 	{{ Form::text('id' , $author->id ) }} <br/> 
 -->		
		{{ Form::label('name','Name :') }}
		 	{{ Form::text('name',$author->name) }} <br/>
		
		{{ Form::label('bio' , 'Bio : ') }}
			{{ Form::textarea('bio',$author->bio) }} <br/>


		<?php 
			$urlCancel = URL::route('authorsDisplayAll');
		?>

		<span class="menuBar">

			{{ Form::submit("Save Author") }}
			<a class='button' href='{{$urlCancel}}'>Cancel</a>

		</span>

	{{ Form::close() }}

@endsection


