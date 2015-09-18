function initialize() {
  
  jQuery("[data-gmaps='true']").each(function(){
    var ui_dragable;
    var ui_zoomable;
    var ui_streetview;
    var ui_fitbounds_marker;
    var ui_fitbounds_kml;
    var ui_maptypes;
    var ui_maptype_default;
    var ui_maptype_selectable;
    var map;
    var placeService;
    var object_bounds = new google.maps.LatLngBounds();
    var kml_layers = [];
    
    var lat = jQuery(this).attr('data-gmaps-lat');
    var lng = jQuery(this).attr('data-gmaps-lng');
    var zoom = parseInt(jQuery(this).attr('data-gmaps-zoom'));
    var placeKeyword = jQuery(this).attr('data-gmaps-place');
    
    var gmapsControls = jQuery(this).children('gmaps-controls');
    if(gmapsControls) {
      ui_dragable = gmapsControls.attr('dragable');
      ui_zoomable = gmapsControls.attr('zoomable');
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
      /*kml_layers[kml_layers.length] = ctaLayer;
      google.maps.event.addListener(ctaLayer, 'defaultviewport_changed', function() {
        if (ui_fitbounds) {
          for (var index = 0; index < kml_layers.length; index++) {
            window.alert(kml_layers[index].constructor.name);
            //var map_bounds = kml_layers[index].getBounds();
            //map.fitBounds( object_bounds.union( map_bounds ) );
          }
        }
      });*/
    }

    //Marker
    for (var index = 0; index < gmapsmarkers.length; index++) {
      var markerTitle = jQuery(gmapsmarkers[index]).attr('title');
      var markerLat = jQuery(gmapsmarkers[index]).attr('lat');
      var markerLng = jQuery(gmapsmarkers[index]).attr('lng');
        
      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(markerLat, markerLng),
        map: map,
        title: markerTitle
      });
      if (ui_fitbounds_marker) {
        map.fitBounds( object_bounds.extend(marker.getPosition()) );
      }
    }
  });
}