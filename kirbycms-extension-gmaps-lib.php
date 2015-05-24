<?php

namespace at\fanninger\kirby\extension\gmaps;

use at\fanninger\kirby\extension\webhelper\WebHelper;

class GMaps {
  
  const ATTR_CLASS = 'class';
  const ATTR_LAT = 'lat';
  const ATTR_LNG = 'lng';
  const ATTR_ZOOM = 'zoom';
  const ATTR_MARKER_TEXT = 'marker_text';
  const ATTR_MARKER_LINK = 'marker_link';
  
  const PARA_GOOGLEMAPS = 'data-googlemaps';
  const PARA_CLASS = 'class';
  const PARA_LAT = 'data-lat';
  const PARA_LNG = 'data-lng';
  const PARA_ZOOM = 'data-zoom';
  
  const CONFIG_PARAM_CLASS = "kirby.extension.gmaps.class";
  const CONFIG_PARAM_ZOOM = "kirby.extension.gmaps.zoom";
  
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
    $this->default[self::PARA_CLASS] = kirby()->option(self::CONFIG_PARA_CLASS, 'googlemaps');;
    $this->default[self::PARA_LAT] = false;
    $this->default[self::PARA_LNG] = false;
    $this->default[self::PARA_ZOOM] = kirby()->option(self::CONFIG_PARA_ZOOM, 7);;
  }
  
  public function getDefaults(){
    return $this->default;
  }
  
  public function parse($tag, array $block, array $attr_template = null){
    if ( is_array($block) && array_key_exists(WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES, $block) )
      $this->data = $this->convertAndMergeAttributes( $tag, $block[WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES], $attr_template );
    else 
      $this->data = $this->convertAndMergeAttributes( $tag, null, $attr_template );
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
        if ( array_key_exists($key, $attr_result) )
          $attr_result[$key] = $this->checkValue( $key, $value );
      }
    }
  }
  
  protected function checkValue($key, $value){
//    switch ($key){
//      case self::PARA_LAT:
//        break;
//      case self::PARA_LNG:
//        break;
//      case self::PARA_ZOOM:
//        break;
//    }
    return $value;
  }
  
  public function toHTML(){
    if ( $this->data[self::PARA_LAT] === false OR $this->data[self::PARA_LNG] === false )
      return;
    
    $attr = array();
    $attr['data-googlemaps'] = $this->data[self::PARA_GOOGLEMAPS];
    $attr['data-lat'] = $this->data[self::PARA_LAT];
    $attr['data-lng'] = $this->data[self::PARA_LNG];
    $attr['data-zoom'] = $this->data[self::PARA_ZOOM];
    
    return \Html::tag('div', $this->data[self::ARRAY_ATTR][self::PARA_LINK_URL], null, $attr);
  }
  
  public static function getGMap($page, $attr = array()){
    if ( !is_array($attr) && count($attr) == 0 )
      return "";
    
    $gmaps = new GMaps($page);
    $gmaps->parse( array(), $attr );
    return $gmaps->toHTML();
  }
}