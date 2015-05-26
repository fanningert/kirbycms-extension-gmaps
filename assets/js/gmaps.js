function initialize() {
  
  jQuery("[data-googlemaps='true']").each(function(){
    var lat = jQuery(this).attr('data-lat');
    var lng = jQuery(this).attr('data-lng');
    var zoom = parseInt(jQuery(this).attr('data-zoom'));
    var ui_zoom = jQuery.parseJSON(jQuery(this).attr('data-ui-zoom'));
    var ui_draggable = jQuery.parseJSON(jQuery(this).attr('data-ui-draggable'));
    var kml = jQuery(this).attr('data-kml');
    var marker = jQuery(this).attr('data-marker');
    
    var myLatLng = new google.maps.LatLng(lat, lng);
    var mapOptions = new Array();
    mapOptions.zoom = zoom;
    mapOptions.center = myLatLng;
    if (!ui_draggable){
      mapOptions.draggable = false;
    }
    if (!ui_zoom) {
      mapOptions.zoomControl = false;
      mapOptions.scrollwheel = false;
      mapOptions.disableDoubleClickZoom = true;
    }
  
    var map = new google.maps.Map(jQuery(this)[0], mapOptions);
  
    if (marker) {
      var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Hello World!'
      });
    }
    
    if (kml) {
      var ctaLayer = new google.maps.KmlLayer({
        url: kml
      });
      ctaLayer.setMap(map);
    }
  });
}