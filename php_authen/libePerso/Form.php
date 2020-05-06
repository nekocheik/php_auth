<?php
require './class/HtmlElement.php';
require './class/Field.php';

class Form extends HtmlElement {

  private $fields = [];
  private $formAttributes = [];

  /**
   * @param 
   */
  public function __construct( $formAttributes = ['class' => 'form-group'])
  {
    $this->formAttributes = $formAttributes;
  }
  

   public function close () {
    return self::createElement('div', $this->formAttributes, $this->fields);
  }

  public function addfield ($name = '', $type = 'text', $attributes=[] ,$states=[]) {
    $this->fields[$name] = self::setField($name, $type, $attributes, $states);
  }

  static function setField ($name, $type, $attributes=[], $states=[]) {
    $field = new Field($name, $type, $attributes, $states );
    return $field->setField();
  }

  public function addButton ( $text = '', $action = 'submit', $closeForm = false) {
    $this->fields[] = self::setButton($text, $action);
    if (isset($closeForm)){
      $this->close();
    }
  }

  public function checkFieldError (  ) {
    
  }

  static function setButton ($text = '', $action = 'submit') {
    $parmsButton = ['class' => 'btn btn-primary mb-2' , 'action' => action];
    return self::createElement('button', $parmsButton , $text);
  }

  public function getField () {
    return $this->fields;
  }

}
