<?php $this->load->view('template/main') ?>
<!-- MAP -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?libraries=places&sensor=false"></script>
<script>
var ignKey = "ljozkgwvms60dtumhx67z6u3"
var markers = [];



function initialize() {
  var map_canvas = document.getElementById("map_canvas");

  var map = new google.maps.Map(map_canvas, {
    
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    center: new google.maps.LatLng(-6.918441, 107.614315),
    zoom: 13
  });

  //map.mapTypes.set('IGN', makeIGNMapType("GEOGRAPHICALGRIDSYSTEMS.MAPS", "IGN", 18));
  //map.mapTypes.set('IGNScanExpress', makeIGNMapType("GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.CLASSIQUE", "IGN Scan Express", 16));


  // Create the search box and link it to the UI element.
  var input = /** @type {HTMLInputElement} */ (
    document.getElementById('pac-input'));
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  var searchBox = new google.maps.places.SearchBox(
    /** @type {HTMLInputElement} */
    (input));

  // Listen for the event fired when the user selects an item from the
  // pick list. Retrieve the matching places for that item.
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    for (var i = 0, marker; marker = markers[i]; i++) {
      marker.setMap(null);
    }

    // For each place, get the icon, place name, and location.
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    var place = null;
    var viewport = null;
    for (var i = 0; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      var marker = new google.maps.Marker({
        map: map,
        icon: image,
        title: place.name,
        position: place.geometry.location
      });
      var location = place.geometry.location;
        var lat = location.lat();
        var lng = location.lng();
        console.log('Latitude : '+lat);
        console.log('Longtitude : '+lng);
      viewport = place.geometry.viewport;
      markers.push(marker);

      bounds.extend(place.geometry.location);
    }
    map.setCenter(bounds.getCenter());
  });

  // Bias the SearchBox results towards places that are within the bounds of the
  // current map's viewport.
  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
    var rectangle = new google.maps.Polygon({
         paths : [
         ],
        strokeOpacity: 0,
        fillOpacity : 0,
        map : map
      });
      google.maps.event.addListener(rectangle, 'click', function(args) {  
         console.log('latlng', args.latLng);
    });
  });
}


// Normalizes the coords that tiles repeat across the x axis (horizontally)
// like the standard Google map tiles.

google.maps.event.addDomListener(window, 'load', initialize);
</script>
<style>
.controls{
  margin-top: 10px;
  border: 1px solid transparent;
  border-radius: 2px 0 0 2px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  height: 32px;
  outline: none;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}

#pac-inputx {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 300px;
}

#pac-inpuxt:focus {
  border-color: #4d90fe;
}
</style>
<!--
<div class="nav-container">
    <ul class="nav nav-icons" role="tablist">
        <li class="active">
            <a class="hvr-grow" href="#map-logo" role="tab" data-toggle="tab" aria-expanded="true">
                <i class="fa fa-map-marker"></i><br>
                Location
            </a>
        </li>
    </ul>
</div>
                                                       
<div class="tab-content">
    <div class="tab-pane active" id="map-logo">
        <div class="card">
            <div class="header">
                <h4 class="title">Location of product</h4>
                <p class="category">Here is some text</p>
                <hr class="hr"/>
            </div>    
            
            <div class="content">
                <input id="pac-input" class="controlsx form-control" type="text" placeholder="Cari alamat.." style="width: 30%;margin-top: 10px;">
                <div id="map_canvas" style="height: 350px;"></div>
            </div>
        </div>    
    </div>
</div>-->
<!-- end tab content -->
<div class="card">
    <div class="header">
        <h4 class="title"><i class="fa fa-map-marker"></i> Map</h4>
        <hr class="hr"/>
    </div>    
    
    <div class="content">
        <input id="pac-input" class="controlsx form-control" type="text" placeholder="Cari lokasi.." style="width: 30%;margin-top: 10px;">
        <div id="map_canvas" style="height: 450px;"></div>
    </div>
</div>
<?php $this->load->view('template/footer') ?>