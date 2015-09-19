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