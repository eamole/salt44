@extends("master")


@section("content")

	<!-- onSubmit go to authorSave,and pass in the route to this form (for errors) -->
	{{ Form::model( $author , array('route' => array('authorSave' , 'authorEdit' ))) }}
	
		{{ Form::label('id','ID  :') }}
		 	{{ Form::text('id' , $author->id , ['readonly'] )  }} <br/>
		
		{{ Form::label('name','Name :') }}
		 	{{ Form::text('name',$author->name) }} <br/>
		
		{{ Form::label('bio' , 'Bio : ') }}
			{{ Form::textarea('bio',$author->bio) }} <br/>

		<div class="menuBar">
			
			<?php 
				$urlCancel = URL::route('authorDisplay',array($author->id));
			?>

			{{ Form::submit("Save Author") }}
			<a class='button' href='{{$urlCancel}}'>Cancel</a>
			
		</div>

	{{ Form::close() }}

@endsection


