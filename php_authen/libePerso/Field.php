<?php 
require_once 'class/HtmlElement.php';

class Field extends HtmlElement {

  private $name;
  private $type;
  private $tag = 'input';
  private $attributes = ['maxLength' => '250'];
  
  /**
   * @param
   * @name / name of field 
   * @type / type of field  
   */

  public function __construct( $name, $type, $attributes=[], $states=[])
  {
    $this->name = $name;
    if (!empty($attributes)) {
      $this->attributes = $attributes;
    }
    $this->states = $states;
    if ( $type  === 'textarea') {
      $this->tag = 'textarea';
    } else {
      $this->$type = $type;
    }
  }

  public function addMaxLength (int $length) {
    $this->attributes['maxLength'] = $length;
  }


  private function attributesMerge () {
    $fallbackValue = ['class' => 'form-control', 'name' => $this->name, ];
    if (isset($this->type)) {
      $fallbackValue['type'] = $this->type;
    }
    return array_merge( $fallbackValue, $this->attributes );
  }


  public function setField () {
    $attributes = $this->attributesMerge($this->name);
    $fields = "". self::createElement('label', [], $this->name). self::createElement( $this->tag , $attributes );
    $input = self::createElement( 'div', [ 'class' => 'form-group'], $fields );

    if ($this->hasError()) {
      $fields .= $this->hasError();
    }

    return $input;
  }

  private function hasError (){
    if (isset($this->states['error']) ) {
     return self::createChildElement('span',['class' => 'error'], 'vous avez une erreur');
    }
  }  

  
}
?>
