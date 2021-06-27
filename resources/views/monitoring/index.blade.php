@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Monitoring</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Monitoring</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Monitoring
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                	<div style="height: 420px; position: relative; overflow: hidden;" id="map"></div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
        <input type="hidden" name="" id="uLoct" value="{{ $uLoct }}">
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPiTrwWK8-OkNtxoidwGCYPtgmN8rgAyY&libraries=places"></script>
  <script type="text/javascript">
    var locations = JSON.parse($('#uLoct').val());
    // var locations = [
    //   ['Jakarta', -6.200000, 106.816666],
    //   ['Depok', -6.385589, 106.830711],
    //   ['Bogor', -6.595038, 106.816635],
    // ];

    var map = new google.maps.Map(document.getElementById('map'), {
	    center: { //jakarta
        lat: -6.2338236,
        lng: 106.8226386
	    },
	    zoom: 8,
  	});

    var successHandler = function(position) { 
          const marker = new google.maps.Marker({
            position: { lat: position.coords.latitude, lng: position.coords.longitude },
            map: map,
          });
          attachSecretMessage(marker, 'Posisi Kita');
    // alert(position.coords.latitude); 
    // alert(position.coords.longitude); 
    }; 

    var errorHandler = function (errorObj) { 
    alert(errorObj.code + ": " + errorObj.message); 

    alert("something wrong take this lat " + 26.0546106);
    alert("something wrong take this lng " +-98.3939791); 

    }; 

    navigator.geolocation.getCurrentPosition( 
    successHandler, errorHandler, 
    {enableHighAccuracy: true, maximumAge: 10000});

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }

      // GEOLOCATION, CURRENT POSITION
    // if ("geolocation" in navigator){ //check geolocation available 
    //   //try to get user current location using getCurrentPosition() method
    //   navigator.geolocation.getCurrentPosition(function(position){ 
    //       // $("#result").html("Found your location <br />Lat : "+position.coords.latitude+" </br>Lang :"+ position.coords.longitude);
    //       console.log(position.coords.latitude+','+position.coords.longitude);
    //       const marker = new google.maps.Marker({
    //         position: { lat: position.coords.latitude, lng: position.coords.longitude },
    //         map: map,
    //       });
    //       attachSecretMessage(marker, 'Posisi Kita');
    //     });
    // }else{
    //   console.log("Browser doesn't support geolocation!");
    // }

    function attachSecretMessage(marker, secretMessage) {
      const infowindow = new google.maps.InfoWindow({
        content: secretMessage,
      });
      marker.addListener("click", () => {
        infowindow.open(marker.get("map"), marker);
      });
    }
  </script>
@endsection