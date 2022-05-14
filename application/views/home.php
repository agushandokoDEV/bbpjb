<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>bbpjb</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
    <!-- Bootstrap core CSS -->
    <link href="<?php echo site_url('assets/dist/css/bootstrap.min.css') ?>" rel="stylesheet" />
    <link href="<?php echo site_url('assets/app/css/app.css') ?>" rel="stylesheet" />
    <script src="<?php echo site_url('assets/vendor/jquery-1.10.2.min.js') ?>"></script>
    <script src="<?php echo site_url('assets/dist/js/bootstrap.min.js') ?>"></script>
    
    <script src="<?php echo base_url('assets/vendor/pace/pace.min.js') ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/pace/themes/white/pace-theme-minimal.css') ?>"/>
    <!-- MAP -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?libraries=places&sensor=false"></script>
    <script>
    var ignKey = "ljozkgwvms60dtumhx67z6u3"
    var markers = [];
    
    
    
    function initialize() {
      var map_canvas = document.getElementById("map_canvas");
    
      var map = new google.maps.Map(map_canvas, {
        
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: new google.maps.LatLng(-7.1166625, 108.584513),
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
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
  <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brandsadasdasd</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <!--
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      -->
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
</nav>
<div class="container-fluid" style="margin-top: 75px;">
    <!-- Content here -->
    <div class="nav-container">
        <ul class="nav nav-icons" role="tablist">
            <li class="">
                <a href="#description-logo" role="tab" data-toggle="tab" aria-expanded="false">
                    <i class="fa fa-info-circle"></i><br> 
                    Description
                </a>
            </li>
            <li class="active">
                <a href="#map-logo" role="tab" data-toggle="tab" aria-expanded="true">
                    <i class="fa fa-map-marker"></i><br>
                    Location
                </a>
              </li>
            <li class="">
                <a href="#legal-logo" role="tab" data-toggle="tab" aria-expanded="false">
                    <i class="fa fa-legal"></i><br>
                    Legal Info 
                </a>
            </li>
            <li class="">
                <a href="#help-logo" role="tab" data-toggle="tab">
                    <i class="fa fa-life-ring"></i><br>
                    Help Center
                </a>
            </li>
        </ul>
    </div>
                                                           
    <div class="tab-content">
        <div class="tab-pane " id="description-logo">
            <div class="card">
                <div class="header">
                    <h4 class="title">Description about product</h4>
                    <p class="category">More information here</p>
                </div>    
                
                <div class="content">
                    <p>Larger, yet dramatically thinner. More powerful, but remarkably power efficient. With a smooth metal surface that seamlessly meets the new Retina HD display.</p>
                    <p>The first thing you notice when you hold the phone is how great it feels in your hand. There are no distinct edges. No gaps. Just a smooth, seamless bond of metal and glass that feels like one continuous surface.</p>
                </div>
            </div>
        </div>
        
        
        <div class="tab-pane active" id="map-logo">
            <div class="card">
                <div class="header">
                    <h4 class="title">Location of product</h4>
                    <p class="category">Here is some text</p>
                    <hr class="hr"/>
                </div>    
                
                <div class="content">
                    <input id="pac-input" class="controlsx form-control" type="text" placeholder="Search Box" style="width: 60%;margin-top: 10px;">
                    <div id="map_canvas" style="height: 350px;"></div>
                </div>
            </div>    
        </div>
        
        
        <div class="tab-pane" id="legal-logo">
            <div class="card">
                <div class="header">
                    <h4 class="title">Legal items</h4>
                    <p class="category">More information here</p>
                </div>    
                
                <div class="content">
                    <p>The first thing you notice when you hold the phone is how great it feels in your hand. The cover glass curves down around the sides to meet the anodized aluminum enclosure in a remarkable, simplified design.</p>
                    <p>Larger, yet dramatically thinner.It’s one continuous form where hardware and software function in perfect unison, creating a new generation of phone that’s better by any measure.</p>
                </div>
            </div>
        </div>
        
        <div class="tab-pane" id="help-logo">
            <div class="card">
                <div class="header">
                    <h4 class="title">Help center</h4>
                    <p class="category">More information here</p>
                </div>    
                
                <div class="content">
                    <p>From the seamless transition of glass and metal to the streamlined profile, every detail was carefully considered to enhance your experience. So while its display is larger, the phone feels just right.</p>
                    <p>Another Text. The first thing you notice when you hold the phone is how great it feels in your hand. The cover glass curves down around the sides to meet the anodized aluminum enclosure in a remarkable, simplified design.</p>
                </div>
            </div>
        </div>
        
    </div> <!-- end tab content -->
    <div class="row">
        <div class="col-md-3">
            <div class="thumbnail">
                <p>sdfsdf</p>
            </div>
        </div>
        <div class="col-md-9">
            <div class="thumbnail">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> Remember me
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-default">Sign in</button>
                    </div>
                  </div>
                </form>
                <hr />
                <div class="header">
                    <h4 class="title">Pagination</h4>
                </div>
                
                <div class="content">
                    <ul class="pagination"> 
                        <!--   
                            color-classes: "pagination-blue", "pagination-azure", "pagination-orange", "pagination-red", "pagination-green"       
                        -->
                        <li><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li class="active"><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
                    </ul>
                    
                    <ul class="pagination pagination-no-border"> 
                        <li><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li class="active"><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
                    </ul>
                        
                </div>
            </div>
        </div>
    </div>
<!-- End Content -->
</div>
<footer class="container-fluid footer">
	Copyright &copy; 2014 <a href="#" target="_blank">bbpjb</a>
    <a href="#" class="pull-right scrollToTop"><i class="fa fa-chevron-up"></i></a>
</footer>
</body>
</html>