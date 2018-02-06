@extends("master")


@section("content")

	<div class="container form">
		<div class="form-row">
			<span class="label">
				ID  : 
			</span>
			<span class="input">
				{{ $author->id }}
			</span>
		</div>
		
		<div class="form-row">
			<span class="label">
				Name : 
			</span>
			<span class="input">
				{{ $author->name }} <br/>
			</span>
		</div>

		<div class="form-row">
			<span class="label">
				Bio : 
			</span>
			<span class="input">
				{{ $author->bio }} <br/>
			</span>
		</div>
	</div>


	<?php 
		$urlOk = URL::action("AuthorsController@deleteConfirm",array($author->id));
		$urlCancel = URL::route('authorDisplay',array($author->id));
	?>

	<div class="menuBar">

		
		Warning : you are about to delete this record.<br/> Are you sure you wish to proceed?<br/>

	</div>
	
	<div class="container">

		<a class='button' href='{{$urlOk}}'>Delete</a>
		<a class='button' href='{{$urlCancel}}'>Cancel</a>


	</div>



@endsection