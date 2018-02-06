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


	<div class="menuBar">
		{{ HTML::linkRoute('authorEdit','Edit Author',$author->id,  ['class' => 'button']) }}
		{{ HTML::linkRoute('authorDelete','Delete Author',$author->id , ['class' => 'button']) }}
		{{ HTML::linkRoute('authorsDisplayAll','Cancel' , null , ['class' => 'button']) }}
	</div>

@endsection


