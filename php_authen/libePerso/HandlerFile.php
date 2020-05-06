<?php

class HandlerFile {
  function __construct ($file) { 
    $this->path = $this->getAbsolutPath($file);
  }
  static function getAbsolutPath ($path) {
     return dirname(__DIR__) . DIRECTORY_SEPARATOR . $path;
  }

  public function action ( $parms, $callback) {
    $resource = $this->open($parms); 
    //$this->resource = $resource;
    $result = $callback($resource);
    $this->close($resource);
    return $result;
  }


  function readLines ($resource) {

  }

  public function open ($parms = 'r') { 
    return fopen($this->path, $parms);
  }

  public function close ($resource = null) { 
    fclose($this->resource ? $this->resource: $resource);
  }

  public function toString ($parms) {
    $resource = $this->open($parms);
    $result = self::getToString($resource);
    $this->close($resource);
    return $result;
  } 

  public function toArray ($parms) {
    $resource = $this->open($parms);
    $result = self::getToArray($resource);
    $this->close($resource);
    return $result;
  } 


  static function getToString ($resource) {
    $string = '';
    while ($line = fgets($resource)) {
      $string .= $line;
    };
    return $string;
  }

  static function getToArray ($resource) {
    $array = [];
    while ($line = fgets($resource)) {
      $array[] = $line;
    };
    return $array;
  }

}

?>
