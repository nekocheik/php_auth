<?php 
namespace App;

class Auth {

  public $bd = ''; 

  /**
   * @param $dependencies
   */

  static function setBd () {
    return new \PDO('sqlite:../data.sqlite');
  }

  public function __construct()
  {
    $this->pdo = self::setBd();
    $this->session = session_start();
    $this->setRols();
  }

  private function setRols () {
    if ( $_SESSION['user'] ) {
      $this->logIn($_SESSION['user']);
    }
  }

  

  public function singUp ( $username, $passworld ) {

  }

  public function logIn ($user) {
    $pseudo = $user['pseudo'];
    $query = $this->pdo->query("SELECT user WHERE pseudo = $pseudo");
    $query->fetchAll();
  }

  public function isLog () {

  }
  
}
?>
