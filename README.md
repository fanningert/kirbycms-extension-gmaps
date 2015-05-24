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
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&callback=initialize"></script>
<?php echo js('assets/js/gmaps.js'); ?>
...
```

### Asynchron Loading of jQuery and Google Maps Javascript API

For the asynchron loading of Javascript, you need a helper class. In my example I am using [script.js](https://github.com/ded/script.js).

```php
...
  <?php echo js("assets/js/script.min.js") ?>
  <script type="text/javascript">$script.path('<?php echo $kirby->urls->index; ?>/assets/js/');</script>
  <?php echo js("assets/js/gmaps-async.js") ?>
  </body>
</html>
```

### GIT

Go into the `{kirby_installation}/site/plugins` directory and execute following command.

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

## Update

### GIT

Go into the `{kirby_installation}/site/plugins/kirbycms-extension-gmaps` directory and execute following command.

```bash
$ git pull
```
Don't forget to update the requirement `kirbycms-extension-webhelper`.

### GIT submodule

Go in the root directory of your git repository and execute following command to update the submodule of this extension.

```bash
$ git submodule foreach --recursive git pull
```

## Example

### Kirby

```kirby
(_googlemaps lat: 35.7152128 lng: 139.7981552 zoom: 4)
```

### PHP

```php
use at\fanninger\kirby\extension\gmaps\GMaps;

$attr = array();
$attr[GMaps::ATTR_LAT] = 35.7152128;
$attr[GMaps::ATTR_LNG] = 139.7981552;
$attr[GMaps::ATTR_ZOOM] = 4;
echo GMaps::getGMap($page, $attr);
```

## KML

### Kirby

(code)
(_googlemaps lat: 41.875696 lng: -87.624207 zoom: 11 kml: cta.kml)
(/code)

### PHP

(code lang: php)
use at\fanninger\kirby\extension\gmaps\GMaps;

$attr = array();
$attr[GMaps::ATTR_LAT] = 41.875696;
$attr[GMaps::ATTR_LNG] = -87.624207;
$attr[GMaps::ATTR_ZOOM] = 11;
$attr[GMaps::ATTR_KML] = '.../cta.kml';
echo GMaps::getGMap($page, $attr);
(/code)