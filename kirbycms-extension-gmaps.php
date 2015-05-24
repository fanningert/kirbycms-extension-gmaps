<?php

use at\fanninger\kirby\extension\webhelper\WebHelper;
use at\fanninger\kirby\extension\gmaps\GMaps;

require_once 'kirbycms-extension-gmaps-lib.php';

kirbytext::$pre[] = function($kirbytext, $value) {
	$gmpas = new GMaps($kirbytext->field->page);
	$value = $gmpas->parseAndConvertTags( $value );
	
	return $value;
};