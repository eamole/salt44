@extends('master')

@section('content')



<div id="map"></div>
    <script>
      function initMap() {


        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -51.8987311, lng: -8.471564899999999},
          zoom: 8
        });
      }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{google_key()}}&callback=initMap"
    async defer></script>

@stop