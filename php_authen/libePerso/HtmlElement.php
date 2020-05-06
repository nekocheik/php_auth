<?php
class HtmlElement {

  static function attributeToHtml($attributes) {
    $result = '';
    foreach ($attributes as $attribute => $value) {
      $result .= strtolower("$attribute=\"$value\"");
    }
    return $result;
  }

  /*
   * convert php to html
   * @tagName / tag of element 
   * @attributes / put attributes on html tag
   * @content / content of tag html
   */

  protected function getElement ($tagName, $attributes = [], $content = '') {
    if (is_array($content)) {
      $contents = '';
      foreach ($content as $key => $value) {
        $contents .= $value;
      };
    }
    $content = isset($contents) ? $contents : $content;
    return "<$tagName ". self::attributeToHtml($attributes) .">". $content ."</$tagName>" ;
  }

  /*
   * allow to creat a element wich will appen in createElement() 
   * @tagName / name of tag 
   * @attributes / attributes of tag 
   */

  static function createElement ( $tagName, $attributes = [], $content = '' ) {
    return self::getElement($tagName, $attributes, $content) ;
  }

  static function log($attributes) {
    echo "<div class=\"container\"><pre class='pre-scrollable'><code>" , print_r($attributes) , "</code></pre></div>";
  }
}
