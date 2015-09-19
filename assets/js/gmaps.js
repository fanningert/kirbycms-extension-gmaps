function initialize() {
  
  jQuery("[data-gmaps='true']").each(function(){
    var ui_dragable;
    var ui_zoomable;
    var ui_scale;
    var ui_streetview;
    var ui_fitbounds_marker;
    var ui_fitbounds_kml;
    var ui_maptypes;
    var ui_maptype_default;
    var ui_maptype_selectable;
    var placeService;
    var map;
    var object_bounds = new google.maps.LatLngBounds();
    
    var lat = jQuery(this).attr('data-gmaps-lat');
    var lng = jQuery(this).attr('data-gmaps-lng');
    var zoom = parseInt(jQuery(this).attr('data-gmaps-zoom'));
    var placeKeyword = jQuery(this).attr('data-gmaps-place');
    
    var gmapsControls = jQuery(this).children('gmaps-controls');
    if(gmapsControls) {
      ui_dragable = gmapsControls.attr('dragable');
      ui_zoomable = gmapsControls.attr('zoomable');
      ui_scale = gmapsControls.attr('scale');
      ui_streetview = gmapsControls.attr('streetview');
      ui_fitbounds_marker = gmapsControls.attr('fitbounds-marker');
      ui_fitbounds_kml = gmapsControls.attr('fitbounds-kml');
      ui_maptypes = gmapsControls.attr('maptypes');
      ui_maptype_default = gmapsControls.attr('maptype-default');
      ui_maptype_selectable = gmapsControls.attr('maptype-selectable');
    }
    
    var gmapsstyle = jQuery(this).children('gmaps-style');
    var gmapskmls = jQuery(this).children('gmaps-kml');
    var gmapsmarkers = jQuery(this).children('gmaps-marker');
    
    var myLatLng = new google.maps.LatLng(lat, lng);
    var mapOptions = new Array();
    mapOptions.zoom = zoom;
    mapOptions.center = myLatLng;
    if (!ui_dragable){
      mapOptions.draggable = false;
      mapOptions.keyboardShortcuts = false;
    }
    if (!ui_zoomable) {
      mapOptions.zoomControl = false;
      mapOptions.scrollwheel = false;
      mapOptions.keyboardShortcuts = false;
      mapOptions.disableDoubleClickZoom = true;
    }
    if (!ui_streetview) {
      mapOptions.streetViewControl = false;
    }
    if (ui_maptypes) {
      mapOptions.mapTypeControlOptions = {
        mapTypeIds: ui_maptypes.split(',')
      };
    }
    if (ui_maptype_default) {
      mapOptions.mapTypeId = ui_maptype_default;
    }
    if (!ui_maptype_selectable) {
      mapOptions.mapTypeControl = false;
    }
    if (ui_scale) {
      mapOptions.scaleControl = true;
    }
  
    map = new google.maps.Map(jQuery(this)[0], mapOptions);
  
    // Place
    if(placeKeyword){
      placeService = new google.maps.places.PlacesService( map );
      placeService.textSearch({
        query: placeKeyword
      }, function(results, status){
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          for (var index = 0; index < 1; index++) {
            map.setCenter(results[index].geometry.location);
          }
        }
      });
    }
  
    //KML
    for (var index = 0; index < gmapskmls.length; index++) {
      var kmlFile = jQuery(gmapskmls[index]).attr('file');

      var ctaLayer = new google.maps.KmlLayer({
        url: kmlFile,
        map: map,
        preserveViewport: ((ui_fitbounds_kml)? false: true)
      });
      if (ui_fitbounds_kml) {
        google.maps.event.addListener(ctaLayer, 'defaultviewport_changed', kmlDefaultViewCallback(map, ctaLayer, ui_fitbounds_kml, object_bounds) );
      }
    }

    //Marker
    for (var index = 0; index < gmapsmarkers.length; index++) {
      var markerTitle = jQuery(gmapsmarkers[index]).attr('title');
      var markerLat = jQuery(gmapsmarkers[index]).attr('lat');
      var markerLng = jQuery(gmapsmarkers[index]).attr('lng');
      var markerPlace = jQuery(gmapsmarkers[index]).attr('place');
      var markerContent = jQuery(gmapsmarkers[index]).html(); 
        
      if (markerPlace) {
        placeService = new google.maps.places.PlacesService( map );
        placeService.textSearch({
          query: markerPlace
        }, markerPlaceCallback(map, markerTitle, markerContent, ui_fitbounds_marker, object_bounds) );
      } else if( markerLat && markerLng ) {
        addMarker(map, markerTitle, new google.maps.LatLng(markerLat, markerLng), markerContent, ui_fitbounds_marker, object_bounds);     
      }
    }
  });
}

function markerPlaceCallback(map, title, content, fitbounds, object_bounds){
  return function(results, status) {
    for (var index = 0; index < 1; index++) {
      addMarker(map, title, results[index].geometry.location, content, fitbounds, object_bounds);
    }
  }
}

function addMarker(map, title, position, content, fitbounds, object_bounds) {
  var marker = new google.maps.Marker({
    position: position,
    map: map,
    title: title
  });
  
  if (content) {
    var infowindow = new google.maps.InfoWindow({
      content: content
    });
    marker.addListener('click', function() {
      infowindow.open(map, marker);
    });
  }
  
  if (fitbounds && object_bounds) {
    map.fitBounds( object_bounds.extend(marker.getPosition()) );
  }
}

function kmlDefaultViewCallback(map, layer, fitbounds, object_bounds){
  return function() {
    if (fitbounds && object_bounds) {
      map.fitBounds( object_bounds.union(layer.getDefaultViewport()) );
    }
  }
}