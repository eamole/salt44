<!DOCTYPE html>
<html>
<head>
	<title>{{ $title }}</title>

	  <meta name="viewport" content="initial-scale=1.0">
	    <meta charset="utf-8">
	    <style>
	      /* Always set the map height explicitly to define the size of the div
	       * element that contains the map. */
	      #myGoogleMap, #myGoogleMapContainer {
	        height: 500px;
	        width:100%;
	      }
	      /* Optional: Makes the sample page fill the window. */
	      html, body {
	        height: 100%;
	        margin: 0;
	        padding: 0;
	      }
	    </style>

    <script>
    	var map;
		function myGoogleMap() {
			console.log("Loading Google map from Callback");
			var el = document.getElementById('myGoogleMap');
			// Create a map object and specify the DOM element for display.
			map = new google.maps.Map(el, {
			  center: {lat: 51.898731, lng: -8.471564},
			  zoom: 18
			});
		}

    </script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


	{{ HTML::style('css/style.css') }}

	{{ HTML::style('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css') }}


</head>
<body>


	
	<h1>Speech & Language Therapy System</h1>
	<!-- login button -->
	{{ LoginController::logInOutButton() }}
	<!-- {{ HTML::linkRoute('login',"Login" , null , ['class' => 'button']) }} -->


	{{ $menuBar->asUl(['class' => 'menuBar']) }} 


	<h2>{{ $title }}</h2>


	<div id="header" class="container">
		<div id="msgs">
			@foreach(msgs() as $msg)
				<p>{{$msg}}</p>
			@endforeach
		</div>

		@foreach($errors->all() as $msg)
			<p class='message'>{{$msg}}</p>
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
		    // so I can style these differently
		    $('table').addClass('display');
		} );
		
	</script>

</body>
</html>