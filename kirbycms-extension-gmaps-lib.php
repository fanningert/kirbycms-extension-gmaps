<?php

namespace at\fanninger\kirby\extension\gmaps;

use at\fanninger\kirby\extension\webhelper\WebHelper;

class GMaps {
  
  const ATTR_CLASS = "class";
  const ATTR_LAT = "lat";
  const ATTR_LNG = "lng";
  const ATTR_ZOOM = "zoom";
  const ATTR_PLACE = "place";
  const ATTR_PROFILE = "profile";
  const ATTR_KML = "kml";
  const ATTR_DEBUG = "debug";
  const OBJECT_ROOT = "googlemaps";
  const OBJECT_MARKER = "marker";
  const OBJECT_KML = "kml";
  const OBJECT_STYLE = "style";
  const OBJECT_CONTROLS = "controls";

  const ATTR_KML_FILE = "file";
  const ATTR_KML_TITLE = "title";
  
  const ATTR_MARKER_TITLE = "title";
  const ATTR_MARKER_LAT = "lat";
  const ATTR_MARKER_LNG = "lng";
  const ATTR_MARKER_PLACE = "place";
  const ATTR_MARKER_CONTENT = "content";
  
  const ATTR_STYLE_FILE = "file";
  const ATTR_STYLE_CONTENT = "content";
  
  const ATTR_CONTROLS_MAPTYPES = "maptypes";
  const ATTR_CONTROLS_MAPTYPE_DEFAULT = "maptype";
  const ATTR_CONTROLS_DRAGABLE = "dragable";
  const ATTR_CONTROLS_ZOOMABLE = "zoomable";
  const ATTR_CONTROLS_SCALE = "scale";
  const ATTR_CONTROLS_MAPTYPE_SELECTABLE = "maptype_selectable";
  const ATTR_CONTROLS_STREETVIEW = "streetview";
  const ATTR_CONTROLS_FITBOUNDS_MARKER = "fitbounds_marker";
  const ATTR_CONTROLS_FITBOUNDS_KML = "fitbounds_kml";
  
  const JS_ATTR_GOOGLEMAPS = "data-gmaps";
  const JS_ATTR_CLASS = "class";
  const JS_ATTR_LAT = "data-gmaps-lat";
  const JS_ATTR_LNG = "data-gmaps-lng";
  const JS_ATTR_ZOOM = "data-gmaps-zoom";
  const JS_ATTR_PLACE = "data-gmaps-place";
  const JS_ATTR_DEBUG = "data-gmaps-debug";
  const JS_OBJECT_KML = "gmaps-kml";
  const JS_ATTR_KML_TITLE = "title";
  const JS_ATTR_KML_FILE = "file";
  const JS_OBJECT_CONTROLS = "gmaps-controls";
  const JS_ATTR_CONTROLS_MAPTYPES = "maptypes";
  const JS_ATTR_CONTROLS_MAPTYPE_DEFAULT = "maptype-default";
  const JS_ATTR_CONTROLS_DRAGABLE = "dragable";
  const JS_ATTR_CONTROLS_ZOOMABLE = "zoomable";
  const JS_ATTR_CONTROLS_SCALE = "scale";
  const JS_ATTR_CONTROLS_MAPTYPE_SELECTABLE = "maptype-selectable";
  const JS_ATTR_CONTROLS_STREETVIEW = "streetview";
  const JS_ATTR_CONTROLS_FITBOUNDS_MARKER = "fitbounds-marker";
  const JS_ATTR_CONTROLS_FITBOUNDS_KML = "fitbounds-kml";
  const JS_OBJECT_STYLE = "gmaps-style";
  const JS_ATTR_STYLE_FILE = "file";
  const JS_ATTR_STYLE_CONTENT = "content";
  const JS_OBJECT_MARKER = "gmaps-marker";
  const JS_ATTR_MARKER_TITLE = "title";
  const JS_ATTR_MARKER_LAT = "lat";
  const JS_ATTR_MARKER_LNG = "lng";
  const JS_ATTR_MARKER_PLACE = "place";
  const JS_ATTR_MARKER_CONTENT = "content";
  
  const CONFIG_PARA_DEBUG = "kirby.extension.gmaps.debug";
  const CONFIG_PARA_PROFILE = "kirby.extension.gmaps.profile";
  const CONFIG_PARA_CLASS = "kirby.extension.gmaps.class";
  const CONFIG_PARA_LAT = "kirby.extension.gmaps.lat";
  const CONFIG_PARA_LNG = "kirby.extension.gmaps.lng";
  const CONFIG_PARA_ZOOM = "kirby.extension.gmaps.zoom";
  const CONFIG_PARA_CONTROLS_MAPTYPES = 'kirby.extension.gmaps.controls.maptypes';
  const CONFIG_PARA_CONTROLS_MAPTYPE_SELECTABLE = 'kirby.extension.gmaps.controls.maptype_selectable';
  const CONFIG_PARA_CONTROLS_MAPTYPE_DEFAULT = "kirby.extension.gmaps.controls.maptype.default";
  const CONFIG_PARA_CONTROLS_DRAGGABLE = 'kirby.extension.gmaps.controls.draggable';
  const CONFIG_PARA_CONTROLS_ZOOMABLE = 'kirby.extension.gmaps.controls.zoomable';
  const CONFIG_PARA_CONTROLS_SCALE = 'kirby.extension.gmaps.controls.scale';
  const CONFIG_PARA_CONTROLS_STREETVIEW = 'kirby.extension.gmaps.controls.streetview';
  const CONFIG_PARA_CONTROLS_FITBOUNDS_MARKER = 'kirby.extension.gmaps.controls.fitbounds.marker';
  const CONFIG_PARA_CONTROLS_FITBOUNDS_KML = 'kirby.extension.gmaps.controls.fitbounds.kml';
  
  protected $para_mapping_root = [
    self::ATTR_CLASS => self::JS_ATTR_CLASS,
    self::ATTR_LAT => self::JS_ATTR_LAT,
    self::ATTR_LNG => self::JS_ATTR_LNG,
    self::ATTR_ZOOM => self::JS_ATTR_ZOOM,
    self::ATTR_PLACE => self::JS_ATTR_PLACE,
    self::ATTR_DEBUG => self::JS_ATTR_DEBUG
  ];
  
  protected $para_mapping_kml = [
    self::ATTR_KML_TITLE => self::JS_ATTR_KML_TITLE,
    self::ATTR_KML_FILE => self::JS_ATTR_KML_FILE
  ];
  
  protected $para_mapping_marker = [
    self::ATTR_MARKER_TITLE => self::JS_ATTR_MARKER_TITLE,
    self::ATTR_MARKER_LAT => self::JS_ATTR_MARKER_LAT,
    self::ATTR_MARKER_LNG => self::JS_ATTR_MARKER_LNG,
    self::ATTR_MARKER_PLACE => self::JS_ATTR_MARKER_PLACE,
    self::ATTR_MARKER_CONTENT => self::JS_ATTR_MARKER_CONTENT
  ];
  
  protected $para_mapping_style = [
    self::ATTR_STYLE_FILE => self::JS_ATTR_STYLE_FILE,
    self::ATTR_STYLE_CONTENT => self::JS_ATTR_STYLE_CONTENT
  ];
  
  protected $para_mapping_controls = [
    self::ATTR_CONTROLS_DRAGABLE => self::JS_ATTR_CONTROLS_DRAGABLE,
    self::ATTR_CONTROLS_ZOOMABLE => self::JS_ATTR_CONTROLS_ZOOMABLE,
    self::ATTR_CONTROLS_MAPTYPE_SELECTABLE => self::JS_ATTR_CONTROLS_MAPTYPE_SELECTABLE,
    self::ATTR_CONTROLS_MAPTYPES => self::JS_ATTR_CONTROLS_MAPTYPES,
    self::ATTR_CONTROLS_MAPTYPE_DEFAULT => self::JS_ATTR_CONTROLS_MAPTYPE_DEFAULT,
    self::ATTR_CONTROLS_STREETVIEW => self::JS_ATTR_CONTROLS_STREETVIEW,
    self::ATTR_CONTROLS_FITBOUNDS_MARKER => self::JS_ATTR_CONTROLS_FITBOUNDS_MARKER,
    self::ATTR_CONTROLS_FITBOUNDS_KML => self::JS_ATTR_CONTROLS_FITBOUNDS_KML,
    self::ATTR_CONTROLS_SCALE => self::JS_ATTR_CONTROLS_SCALE
  ];
  
  /**
   * @var \Page
   */
  protected $page = null;
  protected $default = array();
  protected $default_marker = array();
  protected $default_kml = array();
  protected $default_controls = array();
  protected $data = array();
  
  public function __construct(\Page $page) {
    $this->page = $page;
    $this->loadDefaults();
  }
  
  protected function loadDefaults(){
    $this->default[self::JS_ATTR_GOOGLEMAPS] = 'true';
    $this->default[self::JS_ATTR_CLASS] = kirby()->option(self::CONFIG_PARA_CLASS, 'googlemaps');
    $this->default[self::JS_ATTR_LAT] = kirby()->option(self::CONFIG_PARA_LAT, "0.0");
    $this->default[self::JS_ATTR_LNG] = kirby()->option(self::CONFIG_PARA_LNG, "0.0");
    $this->default[self::JS_ATTR_ZOOM] = kirby()->option(self::CONFIG_PARA_ZOOM, 7);
    $this->default[self::JS_ATTR_PLACE] = false;
    $this->default[self::JS_ATTR_DEBUG] = kirby()->option(self::CONFIG_PARA_DEBUG, false);
    
    $this->default[self::JS_OBJECT_KML] = array();
    $this->default[self::JS_OBJECT_MARKER] = array();
    $this->default[self::JS_OBJECT_STYLE] = array();
    $this->default[self::JS_OBJECT_CONTROLS] = array();
    
    $this->default_marker[self::JS_ATTR_MARKER_TITLE] = false;
    $this->default_marker[self::JS_ATTR_MARKER_LAT] = 0.0;
    $this->default_marker[self::JS_ATTR_MARKER_LNG] = 0.0;
    $this->default_marker[self::JS_ATTR_MARKER_PLACE] = false;
    $this->default_marker[self::JS_ATTR_MARKER_CONTENT] = false;
    
    $this->default_kml[self::JS_ATTR_KML_TITLE] = false;
    $this->default_kml[self::JS_ATTR_KML_FILE] = false;
    
    $this->default_style[self::JS_ATTR_STYLE_FILE] = false;
    $this->default_style[self::JS_ATTR_STYLE_CONTENT] = false;
    $this->default[self::JS_OBJECT_STYLE] = $this->default_style;
    
    $this->default_controls[self::JS_ATTR_CONTROLS_DRAGABLE] = kirby()->option(self::CONFIG_PARA_CONTROLS_DRAGGABLE, true);
    $this->default_controls[self::JS_ATTR_CONTROLS_ZOOMABLE] = kirby()->option(self::CONFIG_PARA_CONTROLS_ZOOMABLE, true);
    $this->default_controls[self::JS_ATTR_CONTROLS_SCALE] = kirby()->option(self::CONFIG_PARA_CONTROLS_SCALE, true);
    $this->default_controls[self::JS_ATTR_CONTROLS_MAPTYPES] = kirby()->option(self::CONFIG_PARA_CONTROLS_MAPTYPES, "roadmap,satellite,hybrid,terrain");
    $this->default_controls[self::JS_ATTR_CONTROLS_MAPTYPE_DEFAULT] = kirby()->option(self::CONFIG_PARA_CONTROLS_MAPTYPE_DEFAULT, "roadmap");
    $this->default_controls[self::JS_ATTR_CONTROLS_MAPTYPE_SELECTABLE] = kirby()->option(self::CONFIG_PARA_CONTROLS_MAPTYPE_SELECTABLE, true);
    $this->default_controls[self::JS_ATTR_CONTROLS_STREETVIEW] = kirby()->option(self::CONFIG_PARA_CONTROLS_STREETVIEW, true);
    $this->default_controls[self::JS_ATTR_CONTROLS_FITBOUNDS_MARKER] = kirby()->option(self::CONFIG_PARA_CONTROLS_FITBOUNDS_MARKER, true);
    $this->default_controls[self::JS_ATTR_CONTROLS_FITBOUNDS_KML] = kirby()->option(self::CONFIG_PARA_CONTROLS_FITBOUNDS_KML, true);
    $this->default[self::JS_OBJECT_CONTROLS] = $this->default_controls;
  }
  
  public function getDefaults(){
    return $this->default;
  }
  
  public function parseAndConvertTags($value, array $attr_template = null){
    $value = $this->parseAndConvertTag(self::OBJECT_ROOT,$value, $attr_template);
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
      $this->data = $this->convertAndMergeAttributesRoot( $tag, $block[WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES], $attr_template );
    else
      $this->data = $this->convertAndMergeAttributesRoot( $tag, null, $attr_template );
  
    //Controls - Root
    $this->parseControls(self::OBJECT_CONTROLS, $block, $attr_template);
    
    //Controls
    $offset = 0;
    if ( array_key_exists(WebHelper::BLOCK_ARRAY_VALUE_CONTENT, $block) ) {
      while( ($block_intern = WebHelper::getblock(self::OBJECT_CONTROLS, $block[WebHelper::BLOCK_ARRAY_VALUE_CONTENT], $offset)) !== false ) {
        $content = "";
        $offset = $block_intern[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS];
        $start = $block_intern[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
        $length = $block_intern[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS]-$block_intern[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
        
        $this->parseControls(self::OBJECT_CONTROLS, $block_intern, $attr_template[self::OBJECT_CONTROLS]);
      }
    }else{
      $this->parseControls(self::OBJECT_CONTROLS, false, $attr_template[self::OBJECT_CONTROLS]);
    }
    
    //KML -Root
    
    
    //KML
    $offset = 0;
    if ( array_key_exists(WebHelper::BLOCK_ARRAY_VALUE_CONTENT, $block) ) {
      while( ($block_intern = WebHelper::getblock(self::OBJECT_KML, $block[WebHelper::BLOCK_ARRAY_VALUE_CONTENT], $offset)) !== false ) {
        $content = "";
        $offset = $block_intern[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS];
        $start = $block_intern[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
        $length = $block_intern[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS]-$block_intern[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
        
        $this->parseKml(self::OBJECT_KML, $block_intern, $attr_template[self::OBJECT_KML]);
      }   
    }else{
      $this->parseKml(self::OBJECT_KML, null, $attr_template[self::OBJECT_KML]);
    } 
    
    //Marker
    $offset = 0;
    if ( array_key_exists(WebHelper::BLOCK_ARRAY_VALUE_CONTENT, $block) ) {
      while( ($block_intern = WebHelper::getblock(self::OBJECT_MARKER, $block[WebHelper::BLOCK_ARRAY_VALUE_CONTENT], $offset)) !== false ) {
        $content = "";
        $offset = $block_intern[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS];
        $start = $block_intern[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
        $length = $block_intern[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS]-$block_intern[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
        
        $this->parseMarker(self::OBJECT_MARKER, $block_intern, $attr_template[self::OBJECT_MARKER]);
      }
    }else{
      $this->parseMarker(self::OBJECT_MARKER, null, $attr_template[self::OBJECT_MARKER]);
    }
    
    //Style
    $offset = 0;
    if ( array_key_exists(WebHelper::BLOCK_ARRAY_VALUE_CONTENT, $block) ) {
      while( ($block_intern = WebHelper::getblock(self::OBJECT_STYLE, $block[WebHelper::BLOCK_ARRAY_VALUE_CONTENT], $offset)) !== false ) {
        $content = "";
        $offset = $block_intern[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS];
        $start = $block_intern[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
        $length = $block_intern[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS]-$block_intern[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
        
        $this->parseStyle(self::OBJECT_STYLE, $block_intern, $attr_template[self::OBJECT_STYLE]);
      }   
    }else{
      $this->parseStyle(self::OBJECT_STYLE, null, $attr_template[self::OBJECT_STYLE]);
    }
  }
  
  public function parseControls($tag, $block, array $attr_template = null){
    if ( is_array($block) && array_key_exists(WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES, $block) )
      $this->data[self::JS_OBJECT_CONTROLS] = $this->convertAndMergeAttributesControls( $tag, $block[WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES], $attr_template );
    else 
      $this->data[self::JS_OBJECT_CONTROLS] = $this->convertAndMergeAttributesControls( $tag, null, $attr_template );
  }
  
  public function parseKml($tag, $block, array $attr_template = null){
    if ( is_array($block) && array_key_exists(WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES, $block) )
      $this->data[self::JS_OBJECT_KML][] = $this->convertAndMergeAttributesKml( $tag, $block[WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES], $attr_template );
    else 
      $this->data[self::JS_OBJECT_KML][] = $this->convertAndMergeAttributesKml( $tag, null, $attr_template );
  }
  
  public function parseMarker($tag, $block, array $attr_template = null){
    if ( is_array($block) && array_key_exists(WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES, $block) )
      $this->data[self::JS_OBJECT_MARKER][] = $this->convertAndMergeAttributesMarker( $tag, $block[WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES], $attr_template );
    else 
      $this->data[self::JS_OBJECT_MARKER][] = $this->convertAndMergeAttributesMarker( $tag, null, $attr_template );
      
    // Content
    if ( is_array($block) && array_key_exists(WebHelper::BLOCK_ARRAY_VALUE_CONTENT, $block) && strlen( $block[WebHelper::BLOCK_ARRAY_VALUE_CONTENT] ) > 0 ) {
      $this->data[self::JS_OBJECT_MARKER][(count($this->data[self::JS_OBJECT_MARKER])-1)][self::JS_ATTR_MARKER_CONTENT] = $block[WebHelper::BLOCK_ARRAY_VALUE_CONTENT];
    }
  }
  
  public function parseStyle($tag, $block, array $attr_template = null){
    if ( is_array($block) && array_key_exists(WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES, $block) )
      $this->data[self::JS_OBJECT_STYLE] = $this->convertAndMergeAttributesStyle( $tag, $block[WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES], $attr_template );
    else 
      $this->data[self::JS_OBJECT_STYLE] = $this->convertAndMergeAttributesStyle( $tag, null, $attr_template );
  }
  
  protected function convertAndMergeAttributesRoot($tag, $attr = null, array $attr_template = null){
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
        if ( array_key_exists($key, $this->para_mapping_root) )
          $key = $this->para_mapping_root[$key];
        
        if ( array_key_exists($key, $attr_result) )
          $attr_result[$key] = $this->checkValue( $key, $value );
      }
    }
    
    return $attr_result;
  }
  
  protected function convertAndMergeAttributesControls($tag, $attr = null, array $attr_template = null){
    $attr_result = array();
    $attr_result = $this->default_controls;
    
    if ( is_array($attr_template) ) {
      foreach ( $attr_template as $key => $value ) {
        if ( array_key_exists($key, $attr_result) )
          $attr_result[$key] = $value;
      }
    }

    if ( is_array( $attr ) ) {
      foreach($attr as $key => $value){
        if ( array_key_exists($key, $this->para_mapping_controls) )
          $key = $this->para_mapping_controls[$key];
        
        if ( array_key_exists($key, $attr_result) )
          $attr_result[$key] = $this->checkValue( $key, $value );
      }
    }

    return $attr_result;
  }
  
  protected function convertAndMergeAttributesKml($tag, array $attr = null, array $attr_template = null){
    $attr_result = array();
    $attr_result = $this->default_kml;
    
    if ( is_array($attr_template) ) {
      foreach ( $attr_template as $key => $value ) {
        if ( array_key_exists($key, $attr_result) )
          $attr_result[$key] = $value;
      }
    }
    
    if ( is_array( $attr ) ) {
      foreach($attr as $key => $value){
        if ( array_key_exists($key, $this->para_mapping_kml) )
          $key = $this->para_mapping_kml[$key];
        
        if ( array_key_exists($key, $attr_result) )
          $attr_result[$key] = $this->checkValue( $key, $value );
      }
    }
    
    return $attr_result;
  }
  
  protected function convertAndMergeAttributesMarker($tag, array $attr = null, array $attr_template = null){
    $attr_result = array();
    $attr_result = $this->default_marker;
    
    if ( is_array($attr_template) ) {
      foreach ( $attr_template as $key => $value ) {
        if ( array_key_exists($key, $attr_result) )
          $attr_result[$key] = $value;
      }
    }
    
    if ( is_array( $attr ) ) {
      foreach($attr as $key => $value){
        if ( array_key_exists($key, $this->para_mapping_marker) )
          $key = $this->para_mapping_marker[$key];
        
        if ( array_key_exists($key, $attr_result) )
          $attr_result[$key] = $this->checkValue( $key, $value );
      }
    }
    
    return $attr_result;
  }
  
  protected function convertAndMergeAttributesStyle($tag, array $attr = null, array $attr_template = null){
    $attr_result = array();
    $attr_result = $this->default_style;
    
    if ( is_array($attr_template) ) {
      foreach ( $attr_template as $key => $value ) {
        if ( array_key_exists($key, $attr_result) )
          $attr_result[$key] = $value;
      }
    }
    
    if ( is_array( $attr ) ) {
      foreach($attr as $key => $value){
        if ( array_key_exists($key, $this->para_mapping_style) )
          $key = $this->para_mapping_style[$key];
        
        if ( array_key_exists($key, $attr_result) )
          $attr_result[$key] = $this->checkValue( $key, $value );
      }
    }
    
    return $attr_result;
  }
  
  protected function checkValue($key, $value){
     switch ($key){
      case self::JS_ATTR_ZOOM:
        if( is_int($value) )
          return $value;
        if ( is_string($value) && is_numeric($value) && intval($value) >= 0 && intval($value) <= 19 ) {
          $value = intval($value);
        } else {
          $value = $this->default[self::PARA_ZOOM];
        }
        break;
      case self::JS_ATTR_CONTROLS_DRAGABLE:
      case self::JS_ATTR_CONTROLS_ZOOMABLE:
      case self::JS_ATTR_CONTROLS_STREETVIEW:
      case self::JS_ATTR_CONTROLS_FITBOUNDS_MARKER:
      case self::JS_ATTR_CONTROLS_FITBOUNDS_KML:
      case self::JS_ATTR_CONTROLS_MAPTYPE_SELECTABLE:
      case self::JS_ATTR_DEBUG:
        if ( is_bool($value) )
          return $value;
        $value = ( is_string($value) && $value === 'false' )? false : true;
        break;
      case self::JS_ATTR_KML_FILE:
      case self::JS_ATTR_STYLE_FILE:
        $source = $value;
        $source = ( is_object( $source ) )? $source : $this->page->file( $source );
        if ( $source ) {
          $value = $source->url();
        }
        break;
      case self::JS_ATTR_LNG:
      case self::JS_ATTR_LAT:
      case self::JS_ATTR_MARKER_LNG:
      case self::JS_ATTR_MARKER_LAT:
        if ( $value == 0 )
          $value = "0.0";
        break;
    }
    return $value;
  }
  
  public function toHTML(){
    if ( $this->data[self::JS_ATTR_DEBUG] ) {
      return "<pre><code>".print_r($this->data, true)."</code></pre>";
    } else {
      $content = "";
      
      //Controls
      $content_internal = "";
      $attr = array();
      foreach ($this->data[self::JS_OBJECT_CONTROLS] as $key => $value) {
        if ( is_array($value) )
          $value = "<pre>".print_r($value, true)."</pre>";
        else{
          if ( is_array($value) )
            $value = "<pre>".print_r($value, true)."</pre>";
          elseif( is_bool($value) && $value )
            $attr[$key] = $key;
          else
            $attr[$key] = $value;
        }
      }
      $html_tag = \Html::tag(self::JS_OBJECT_CONTROLS, $content_internal, $attr);
      if( is_object($html_tag) )
        $content .= $html_tag->toString();
      else
        $content .= $html_tag;
      
      //Kmls
      foreach ($this->data[self::JS_OBJECT_KML] as $kml) {
        $content_internal = "";
        $attr = array();
        
        foreach ($kml as $key => $value) {
          if ( is_array($value) )
            $value = "<pre>".print_r($value, true)."</pre>";
          else{
            if ( is_array($value) )
              $value = "<pre>".print_r($value, true)."</pre>";
            elseif( is_bool($value) && $value )
              $attr[$key] = $key;
            else
              $attr[$key] = $value;
          }
        }
        
        $html_tag = \Html::tag(self::JS_OBJECT_KML, $content_internal, $attr);
        if( is_object($html_tag) )
          $content .= $html_tag->toString();
        else
          $content .= $html_tag;
      }

      //Markers
      foreach ($this->data[self::JS_OBJECT_MARKER] as $marker) {
        $content_internal = "";
        $attr = array();
        foreach ($marker as $key => $value) {
          if ( is_array($value) )
            $value = "<pre>".print_r($value, true)."</pre>";
          else {
            if( $key === self::JS_ATTR_MARKER_CONTENT )
              $content_internal = $value;
            else{
              if ( is_array($value) )
                $value = "<pre>".print_r($value, true)."</pre>";
              elseif( is_bool($value) && $value )
                $attr[$key] = $key;
              else
                $attr[$key] = $value;
            }
          }
        }
        
        $html_tag = \Html::tag(self::JS_OBJECT_MARKER, $content_internal, $attr);
        if( is_object($html_tag) )
          $content .= $html_tag->toString();
        else
          $content .= $html_tag;
      }
      
      //Style
      $content_internal = "";
      $attr = array();
      foreach ($this->data[self::JS_OBJECT_KML] as $key => $value) {
        if ( is_array($value) )
          $value = "<pre>".print_r($value, true)."</pre>";
        else {
          if( $key === self::JS_ATTR_STYLE_CONTENT )
            $content_internal = $value;
          else{
            if ( is_array($value) )
              $value = "<pre>".print_r($value, true)."</pre>";
            elseif( is_bool($value) && $value )
              $attr[$key] = $key;
            else
              $attr[$key] = $value;
          }
        }
      }
      $html_tag = \Html::tag(self::JS_OBJECT_CONTROLS, $content_internal, $attr);
      if( is_object($html_tag) )
        $content .= $html_tag->toString();
      else
        $content .= $html_tag;
      
      //Root
      $attr = array();
      foreach ($this->data as $key => $value) {
        if ( $key !== self::JS_OBJECT_CONTROLS && $key !== self::JS_OBJECT_KML &&
             $key !== self::JS_OBJECT_MARKER && $key !== self::JS_OBJECT_STYLE ) {
          if ( is_array($value) )
            $value = "<pre>".print_r($value, true)."</pre>";
          elseif( is_bool($value) && $value )
            $attr[$key] = $key;
          else
            $attr[$key] = $value;
        }
      }
      return \Html::tag('div', $content, $attr);
    }
  } 
  
  public static function getGMap($page, $attr = array()){
    if ( !is_array($attr) && count($attr) == 0 )
      return "";
    
    $gmaps = new GMaps($page);
    $gmaps->parse( array(), $attr );
    return $gmaps->toHTML();
  }
}