# KirbyText Extension - GMaps

This is a Kirbytag to integrate Google Maps API in your website

## Requirements

- Plugin: [Webhelper](https://github.com/fanningert/kirbycms-extension-webhelper)
- jQuery
- Google Maps Javascript API

## Installation

First you need to install the plugin. In the second part copy the gmaps.js in to your `assets/js` directory and append this javascript file and the Google Maps Javascript API.

```php
...
<script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="<?php echo at\fanninger\kirby\extension\gmaps\GMaps::getGoogleMapsJSApiUrl(); ?>"></script>
<?php echo js('assets/js/gmaps.js'); ?>
...
```

### KirbyCli

```
kirby plugin:install fanningert/kirbycms-extension-gmaps
```

### GIT

Go into the `{{kirby folder}}/site/plugins` directory and execute following command.

```bash
$ git clone https://github.com/fanningert/kirbycms-extension-webhelper.git
$ git clone https://github.com/fanningert/kirbycms-extension-gmaps.git
```

### GIT submodule

Go in the root directory of your git repository and execute following command to add the repository as submodule to your GIT repository.

```bash
$ git submodule add https://github.com/fanningert/kirbycms-extension-webhelper.git ./site/plugins/kirbycms-extension-webhelper
$ git submodule add https://github.com/fanningert/kirbycms-extension-gmaps.git ./site/plugins/kirbycms-extension-gmaps
$ git submodule update --init --recursive
$ git submodule foreach --recursive git pull
```

### Manuell

1. Click [here](https://github.com/fanningert/kirbycms-extension-webhelper/archive/master.zip) to download the latest version of the [WebHelper](https://github.com/fanningert/kirbycms-extension-webhelper) extension. Unzip it and rename the folder `kirbycms-extension-webhelper`.
1. Click [here](https://github.com/fanningert/kirbycms-extension-gmaps/archive/master.zip) to download the latest version of the GMaps extension. Unzip it and rename the folder `kirbycms-extension-gmaps`.
1. Put both folders inside `{{kirby folder}}/site/plugins`
1. Move the file `kirbycms-extension-gmaps/assets/js/gmaps.js` to `{{kirby}}/assets/js/gmaps.js`. You should end up with a file structure like this:

```
{{kirby folder}}
  - assets
    - js
      - gmaps.js
  - site
    - plugins
      - kirbycms-extension-gmaps
        - kirbycms-extension-gmaps.php
      - kirbycms-extension-webhelper
        - kirbycms-extension-webhelper.php
```

Last of all, in the head section of your template, load jQuery, the GoogleMaps API and the gmaps.js script, like this:

```php
<!-- loading jQuery from CDN -->
<script src="//code.jquery.com/jquery-2.1.1.min.js"></script>

<!-- loading the GoogleMaps API -->
<script src="<?php echo at\fanninger\kirby\extension\gmaps\GMaps::getGoogleMapsJSApiUrl(); ?>"></script>

<!-- loading the GMaps script -->
<?php echo js('assets/js/gmaps.js'); ?>
```

## Update

### KirbyCli

```
kirby plugin:update fanningert/kirbycms-extension-gmaps
```

### GIT

Go into the `{{kirby folder}}/site/plugins/kirbycms-extension-gmaps` directory and execute following command.

```bash
$ git pull
```
Don't forget to update the requirement `kirbycms-extension-webhelper`.

### GIT submodule

Go in the root directory of your git repository and execute following command to update the submodule of this extension.

```bash
$ git submodule foreach --recursive git pull
```

### Asynchron Loading of jQuery and Google Maps Javascript API

For the asynchron loading of Javascript, you need a helper class. In my example I am using [script.js](https://github.com/ded/script.js).

```php
...
  <?php echo js("assets/js/script.min.js") ?>
  <script type="text/javascript">
    $script.path('<?php echo $kirby->urls->index; ?>/assets/js/');
    $script(['//code.jquery.com/jquery-2.1.1.min.js', 'gmaps'], 'pagejs');
    $script.ready('pagejs', function() {
      // I add the protcol, because without the protocol the script is searching in the local directory
      $script('<?php echo at\fanninger\kirby\extension\gmaps\GMaps::getGoogleMapsJSApiUrl(); ?>', 'googlemaps');
    });
  </script>
  </body>
</html>
```

## Set Google-API-Key

1. Open `{{kirby folder}}/site/config/config.php`
1. Add following line: `c::set('kirby.extension.gmaps.apikey', '{{KEY}}');`

## Documentation

### Kirby configuration values

| Kirby option | Default | Values | Description |
| ------------ | ------- | ------ | ----------- |
| `kirby.extension.gmaps.debug` | false | true/false | |
| `kirby.extension.gmaps.class` | 'googlemaps' | {string} | Class of the canvas element |
| `kirby.extension.gmaps.lat` | 0.0 | {number} | Initial LAT-Value for map |
| `kirby.extension.gmaps.lng` | 0.0 | {number} | Initial LNG-Value for map |
| `kirby.extension.gmaps.zoom` | 7 | {number 0-19} | Default zoom level |
| `kirby.extension.gmaps.apikey` | null | {string} | API-Key |
| `kirby.extension.gmaps.controls.scale` | true | true/false | Activate/Deactivate scale control |
| `kirby.extension.gmaps.controls.maptypes` | 'roadmap,satellite,hybrid,terrain' | {string} | |
| `kirby.extension.gmaps.controls.maptype_selectable` | true | true/false | |
| `kirby.extension.gmaps.controls.maptype.default` | 'roadmap' | {string} | |
| `kirby.extension.gmaps.controls.draggable` | true | true/false | |
| `kirby.extension.gmaps.controls.zoomable` | true | true/false | |
| `kirby.extension.gmaps.controls.streetview` | true | true/false | |
| `kirby.extension.gmaps.controls.fitbounds.marker` | true | true/false | |
| `kirby.extension.gmaps.controls.fitbounds.kml` | true | true/false | |

### KirbyTag attributes

#### Root element (googlemaps)

| Option | Default | Values | Description |
| ------ | ------- | ------ | ----------- |
| class | | | see `kirby.extension.gmaps.class` |
| lat | | | see `kirby.extension.gmaps.lat` |
| lng | | | see `kirby.extension.gmaps.lng` |
| place | | {string} | alternative location definition over Place API |
| zoom | | | see `kirby.extension.gmaps.zoom` |
| scale | | | see `kirby.extension.gmaps.controls.scale` |
| dragable | | | see `kirby.extension.gmaps.controls.draggable` |
| zoomable | | | see `kirby.extension.gmaps.controls.zoomable` |
| maptypes | | | see `kirby.extension.gmaps.controls.maptypes` |
| maptype | | | see `kirby.extension.gmaps.controls.maptype.default` |
| maptype_selectable | | | see `kirby.extension.gmaps.controls.maptype_selectable` |
| streetview | | | see `kirby.extension.gmaps.controls.streetview` |
| fitbounds_marker | | | see `kirby.extension.gmaps.controls.fitbounds.marker` |
| fitbounds_kml | | | see `kirby.extension.gmaps.controls.fitbounds.kml` |

#### KML (kml)

| Option | Default | Values | Description |
| ------ | ------- | ------ | ----------- |
| title | | {string} | Title of KML, not useable at the moment |
| file | | {string} | relative or absolute url |

#### Marker (marker)

| Option | Default | Values | Description |
| ------ | ------- | ------ | ----------- |
| title | | {string} | |
| lat | 0.0 | {number} | |
| lng | 0.0 | {number} | |
| place | | {string} | see `place` at the root element |
| {content} | | {string} | Add the marker element you can add HTML-Content as element body. This content will be displayed as content of the popup when a user click on the marker. |

### Examples

#### Simple example

##### Kirby

```kirby
(googlemaps lat: 35.7152128 lng: 139.7981552 zoom: 4)
```

##### PHP

```php
use at\fanninger\kirby\extension\gmaps\GMaps;

$attr = array();
$attr[GMaps::JS_ATTR_LAT] = 35.7152128;
$attr[GMaps::JS_ATTR_LNG] = 139.7981552;
$attr[GMaps::JS_ATTR_ZOOM] = 4;
echo GMaps::getGMap($page, $attr);
```

When you use the `use` command in a function, you will get following error.
```php
Parse error: syntax error, unexpected 'use' (T_USE)
```
Replace the top code with following lines.
```php
$attr = array();
$attr[at\fanninger\kirby\extension\gmaps\GMaps::JS_ATTR_LAT] = 35.7152128;
$attr[at\fanninger\kirby\extension\gmaps\GMaps::JS_ATTR_LNG] = 139.7981552;
$attr[at\fanninger\kirby\extension\gmaps\GMaps::JS_ATTR_ZOOM] = 4;
echo at\fanninger\kirby\extension\gmaps\GMaps::getGMap($page, $attr);
```

#### Use Place API for map focus

##### Kirby

```kirby
(googlemaps place: Vienna)
```

##### PHP

```php
use at\fanninger\kirby\extension\gmaps\GMaps;

$attr = array();
$attr[GMaps::JS_ATTR_PLACE] = 'Vienna';
echo GMaps::getGMap($page, $attr);
```

#### KML

##### Kirby

```kirby
(googlemaps)
  (kml file: cta.kml)
(/googlemaps)
```

##### PHP

```php
use at\fanninger\kirby\extension\gmaps\GMaps;

$attr = array();
$attr[GMaps::JS_OBJECT_KML] = array();
$attr[GMaps::JS_OBJECT_KML][0] = array();
$attr[GMaps::JS_OBJECT_KML][0][GMaps::JS_ATTR_KML_FILE] = '.../cta.kml';
echo GMaps::getGMap($page, $attr);
```

#### Marker

##### Kirby

```kirby
(googlemaps)
  (marker lat: 41.875696 lng: -87.624207)
  (marker lat: -87.624207 lng: 41.875696)
  (marker place: Vienna)
  (marker place: New York City)
    <a href="https://en.wikipedia.org/wiki/New_York_City">New York City</a>
  (/marker)
(/googlemaps)
```

##### PHP

```php
use at\fanninger\kirby\extension\gmaps\GMaps;

$attr = array();
$attr[GMaps::JS_OBJECT_MARKER] = array();
$attr[GMaps::JS_OBJECT_MARKER][0] = array();
$attr[GMaps::JS_OBJECT_MARKER][0][GMaps::JS_ATTR_MARKER_LAT] = 41.875696;
$attr[GMaps::JS_OBJECT_MARKER][0][GMaps::JS_ATTR_MARKER_LNG] = -87.624207;
$attr[GMaps::JS_OBJECT_MARKER][1] = array();
$attr[GMaps::JS_OBJECT_MARKER][1][GMaps::JS_ATTR_MARKER_LAT] = -87.624207;
$attr[GMaps::JS_OBJECT_MARKER][1][GMaps::JS_ATTR_MARKER_LNG] = 41.875696;
$attr[GMaps::JS_OBJECT_MARKER][2] = array();
$attr[GMaps::JS_OBJECT_MARKER][2][GMaps::JS_ATTR_MARKER_PLACE] = "Vienna";
$attr[GMaps::JS_OBJECT_MARKER][3] = array();
$attr[GMaps::JS_OBJECT_MARKER][3][GMaps::JS_ATTR_MARKER_PLACE] = "New York City";
$attr[GMaps::JS_OBJECT_MARKER][3][GMaps::JS_ATTR_MARKER_CONTENT] = '<a href="https://en.wikipedia.org/wiki/New_York_City">New York City</a>';
echo GMaps::getGMap($page, $attr);
```