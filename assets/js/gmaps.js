function initialize() {
  
  jQuery("[data-googlemaps='true']").each(function(){
    var lat = jQuery(this).attr('data-lat');
    var lng = jQuery(this).attr('data-lng');
    var zoom = parseInt(jQuery(this).attr('data-zoom'));
    var disable_zoom = (jQuery(this).attr('data-disable-zoom') === 'true')
    var disable_draggable = (jQuery(this).attr('data-disable-draggable') === 'true')
    var kml = jQuery(this).attr('data-kml');
    var marker = jQuery(this).attr('data-marker');
    
    var myLatLng = new google.maps.LatLng(lat, lng);
    var mapOptions = new Array();
    mapOptions.zoom = zoom;
    mapOptions.center = myLatLng;
    if (disable_zoom){
      mapOptions.draggable = false;
    }
    if (disable_zoom) {
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