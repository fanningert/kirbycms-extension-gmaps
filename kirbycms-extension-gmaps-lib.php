<?php

namespace at\fanninger\kirby\extension\gmaps;

use at\fanninger\kirby\extension\webhelper\WebHelper;

class GMaps {
  
  const ATTR_CLASS = 'class';
  const ATTR_LAT = 'lat';
  const ATTR_LNG = 'lng';
  const ATTR_ZOOM = 'zoom';
  const ATTR_KML = 'kml';
  const ATTR_MARKER = 'marker';
  const ATTR_DISABLE_DRAGGABLE = 'draggable';
  const ATTR_DISABLE_ZOOM = 'zoom';
  
  const PARA_GOOGLEMAPS = 'data-googlemaps';
  const PARA_CLASS = 'class';
  const PARA_LAT = 'data-lat';
  const PARA_LNG = 'data-lng';
  const PARA_ZOOM = 'data-zoom';
  const PARA_KML = 'data-kml';
  const PARA_MARKER = 'data-marker';
  const PARA_UI_DRAGGABLE = 'data-ui-draggable';
  const PARA_UI_ZOOM = 'data-ui-zoom';
  
  const CONFIG_PARA_CLASS = "kirby.extension.gmaps.class";
  const CONFIG_PARA_ZOOM = "kirby.extension.gmaps.zoom";
  const CONFIG_PARA_MARKER = "kirby.extension.gmaps.marker";
  const CONFIG_PARA_UI_DRAGGABLE = 'kirby.extension.gmaps.ui.draggable';
  const CONFIG_PARA_UI_ZOOM = 'kirby.extension.gmaps.ui.zoom';
  
  protected  $para_mapping = [
    self::ATTR_CLASS => self::PARA_CLASS,
    self::ATTR_LAT => self::PARA_LAT,
    self::ATTR_LNG => self::PARA_LNG,
    self::ATTR_ZOOM => self::PARA_ZOOM,
    self::ATTR_KML => self::PARA_KML,
    self::ATTR_MARKER => self::PARA_MARKER,
    self::ATTR_UI_DRAGGABLE => self::PARA_UI_DRAGGABLE,
    self::ATTR_UI_ZOOM => self::PARA_UI_ZOOM
  ];
  
  /**
   * @var \Page
   */
  protected $page = null;
  protected $default = array();
  protected $data = array();
  
  public function __construct(\Page $page) {
    $this->page = $page;
    $this->loadDefaults();
  }
  
  protected function loadDefaults(){
    $this->default[self::PARA_GOOGLEMAPS] = 'true';
    $this->default[self::PARA_CLASS] = kirby()->option(self::CONFIG_PARA_CLASS, 'googlemaps');
    $this->default[self::PARA_LAT] = false;
    $this->default[self::PARA_LNG] = false;
    $this->default[self::PARA_ZOOM] = kirby()->option(self::CONFIG_PARA_ZOOM, 7);
    $this->default[self::PARA_KML] = false;
    $this->default[self::PARA_MARKER] = kirby()->option(self::CONFIG_PARA_MARKER, false);
    $this->default[self::PARA_UI_DRAGGABLE] = kirby()->option(self::CONFIG_PARA_UI_DRAGGABLE, true);
    $this->default[self::PARA_UI_ZOOM] = kirby()->option(self::CONFIG_PARA_UI_ZOOM, true);
  }
  
  public function getDefaults(){
    return $this->default;
  }
  
  public function parseAndConvertTags($value, array $attr_template = null){
    $value = $this->parseAndConvertTag('googlemaps',$value, $attr_template);
    return $value;
  }
  
  protected function parseAndConvertTag($tag, $value, array $attr_template = null){
    $offset = 0;
    while ( ($block = WebHelper::getblock($tag, $value, $offset)) !== false ) {
      $content = "";
      $offset = $block[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS];
      $start = $block[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
      $length = $block[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS]-$block[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
      
      $this->parse($tag, $block, $attr_template);
      $content = $this->toHTML();
      
      $value = substr_replace($value, $content, $start, $length);
    }
    
    return $value;
  }
  
  public function parse($tag, array $block, array $attr_template = null){
    if ( is_array($block) && array_key_exists(WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES, $block) )
      $this->data = $this->convertAndMergeAttributes( $tag, $block[WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES], $attr_template );
    else 
      $this->data = $this->convertAndMergeAttributes( $tag, null, $attr_template );
  }
  
  protected function convertAndMergeAttributes($tag, array $attr = null, array $attr_template = null){
    $attr_result = array();
    $attr_result = $this->getDefaults();

    if ( is_array($attr_template) ) {
      foreach ( $attr_template as $key => $value ) {
        if ( array_key_exists($key, $attr_result) )
          $attr_result[$key] = $value;
      }
    }
    
    if ( is_array( $attr ) ) {
      foreach($attr as $key => $value){
        if ( array_key_exists($key, $this->para_mapping) )
          $key = $this->para_mapping[$key];
        
        if ( array_key_exists($key, $attr_result) )
          $attr_result[$key] = $this->checkValue( $key, $value );
      }
    }
    
    return $attr_result;
  }
  
  protected function checkValue($key, $value){
    switch ($key){
      case self::PARA_ZOOM:
        if( is_int($value) )
          return $value;
        if ( is_string($value) && is_numeric($value) && intval($value) >= 0 && intval($value) <= 19 ) {
          $value = intval($value);
        } else {
          $value = $this->default[self::PARA_ZOOM];
        }
        break;
      case self::PARA_UI_ZOOM:
      case self::PARA_UI_DRAGGABLE:
        if ( is_bool($value) )
          return $value;
        $value = ( is_string($value) && $value === 'false' )? false : true;
        break;
      case self::PARA_KML:
        $source = $value;
        $source = ( is_object( $source ) )? $source : $this->page->file( $source );
        if ( $source ) {
          $value = $source->url();
        }
        break;
    }
    return $value;
  }
  
  public function toHTML(){
    if ( ( $this->data[self::PARA_LAT] === false OR $this->data[self::PARA_LNG] === false ) AND $this->data[self::PARA_KML] === false )
      return;
    
    $attr = array();
    $attr[self::PARA_CLASS] = $this->data[self::PARA_CLASS];
    $attr[self::PARA_GOOGLEMAPS] = ($this->data[self::PARA_GOOGLEMAPS])? 'true' : 'false';
    $attr[self::PARA_LAT] = $this->data[self::PARA_LAT];
    $attr[self::PARA_LNG] = $this->data[self::PARA_LNG];
    $attr[self::PARA_ZOOM] = $this->data[self::PARA_ZOOM];
    $attr[self::PARA_UI_ZOOM] = ($this->data[self::PARA_UI_ZOOM])? 'true' : 'false';
    $attr[self::PARA_UI_DRAGGABLE] = ($this->data[self::PARA_UI_DRAGGABLE])? 'true' : 'false';
    if ( $this->data[self::PARA_KML] !== false )
      $attr[self::PARA_KML] = $this->data[self::PARA_KML];
    if ( $this->data[self::PARA_MARKER] !== false )
      $attr[self::PARA_MARKER] = $this->data[self::PARA_MARKER];
    
    return \Html::tag('div', "", $attr);
  }
  
  public static function getGMap($page, $attr = array()){
    if ( !is_array($attr) && count($attr) == 0 )
      return "";
    
    $gmaps = new GMaps($page);
    $gmaps->parse( array(), $attr );
    return $gmaps->toHTML();
  }
}