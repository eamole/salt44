@extends('master')



@section('content')

  <div id='myGoogleMapContainer'><div id="myGoogleMap">Loading Google Map.....</div></div>
  <script src="https://maps.googleapis.com/maps/api/js?key={{google_key()}}"></script>
  <script>

    google.maps.event.addDomListener(window, 'load', myGoogleMap );

  </script>

@endsection


