<!DOCTYPE html>
<html>
<head>
	<title>{{ $title }}</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	{{ HTML::style('css/style.css') }}

	{{ HTML::style('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css') }}


	<script type="text/javascript">
		
		function myLabel(name, text) {

			Form::label(name,text,['class' => 'label']);

		}	


	</script>
</head>
<body>
	
	<h1>Speech & Language Therapy System</h1>

	{{ $menuBar->asUl(['class' => 'menuBar']) }}

	<h2>{{ $title }}</h2>


	<div id="header" class="container">
		<?php $messages=Config::get('app.messages'); ?>
		@if(count($messages)>0)
			@foreach($messages as $msg)
				<p>{{$msg}}</p>
			@endforeach
		@else

		@endif

		@foreach($errors->all() as $msg)
			<p>{{$msg}}</p>
		@endforeach
	

	</div>

	<div id="sidebar" class="container">


	</div>


	<div id="content" class="container">
		
		@yield("content")
		
	</div>


	<div id="footer" class="container">


	</div>


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
 
   <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>


 	<script type="text/javascript">
		
		$(document).ready(function() {
		    $('table').DataTable();
		} );
		
	</script>

</body>
</html>