function initialize() {
  
  jQuery("[data-googlemaps='true']").each(function(){
    var lat = jQuery(this).attr('data-lat');
    var lng = jQuery(this).attr('data-lng');
    var zoom = parseInt(jQuery(this).attr('data-zoom'));
    var kml = jQuery(this).attr('data-kml');
    
    var myLatLng = new google.maps.LatLng(lat, lng);
    var mapOptions = {
      zoom: zoom,
      center: myLatLng
    };
  
    var map = new google.maps.Map(jQuery(this)[0], mapOptions);
  
    var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      title: 'Hello World!'
    });
    
    if (kml) {
      var ctaLayer = new google.maps.KmlLayer({
        url: kml
      });
      ctaLayer.setMap(map);
    }
  });
}