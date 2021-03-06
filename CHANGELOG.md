# 1.7.1

- Add dependencies to `package.json`

# 1.7

- Add PHP Composer support. Install plugin with KirbyCli tool. `kirby plugin:install fanningert/kirbycms-extension-gmaps`

# 1.6

- Add config parameter to set the API-KEY. `kirby.extension.gmaps.apikey`
- Add method to get the google maps api url. `echo at\fanninger\kirby\extension\gmaps\GMaps.getGoogleMapsJSApiUrl();`

# 1.5

- Page field support for `JS_ATTR_ZOOM`, `JS_ATTR_LNG`, `JS_ATTR_LAT`, `JS_ATTR_PLACE`, `JS_ATTR_KML_TITLE` and `JS_ATTR_MARKER_TITLE`
  *Example:* `(googlemaps lat: {page-lat} lng: {page-lng} zoom: {page-zoom})`

# 1.4

- Add licence file

# 1.3

- Marker support now the `place` attribute
- Marker support now HTML content als HTML element body. This content will be displayed as content of the popup when a user click on the marker.

# 1.2

- Add config-value `kirby.extension.gmaps.controls.scale` for scaleControl
- Add attribute `scale` for scaleControl

# 1.1

- Multi KMLs (Google Maps API supported 5 Layers. When you need more KML files, use the Network Link feature of the KML files)
- Multi marker (AutoFit exist)
- Alternative location definition per Google Place API (Example.: location per address)
- Many configuration options (`kirby.extension.gmaps.controls.streetview`, `kirby.extension.gmaps.controls.maptypes`, `kirby.extension.gmaps.controls.maptype.default`, `kirby.extension.gmaps.controls.maptype_selectable`, `kirby.extension.gmaps.controls.fitbounds.marker`, `kirby.extension.gmaps.controls.fitbounds.kml`)
- Removed following config-value `kirby.extension.gmaps.marker`
- Renamed following config-value `kirby.extension.gmaps.ui.draggable` to `kirby.extension.gmaps.controls.draggable`
- Renamed following config-value `kirby.extension.gmaps.ui.zoom` to `kirby.extension.gmaps.controls.zoomable`
- Renamed following attribute `ui_draggable` to `draggable`
- Renamed following attribute `ui_zoom` to `zoomable`
- Removed following attributes `kml` and `marker`, use the kml and marker elements

Known Bugs:
- AutoFIT (FitBounds) don't work with KML layers (This is a problem of Google Maps API)

# 1.0

- Release

# 0.3

- Add options to deactivate zoom and draggable function

# 0.2

- Add KML layer support
- Add Marker activate/deactivate function

# 0.1

- Intial release