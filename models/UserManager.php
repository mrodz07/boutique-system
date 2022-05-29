<?php
  require_once("../db/MSQLDB.php");
  require_once("../interfaces/IUserManager.php");

  class UserManager implements IUserManager {
    private $con;
    private static $instance = null;

    private function __construct() {
      $this->con = MSQLDB::getInstance();
    }

    public static function getInstance() {
      if (self::$instance === null) {
        self::$instance = new UserManager();
      }

      return self::$instance;
    }

    //insertamos usuarios en una tabla con mysql
    public function save($username, $password) {
      try {
        $q = $this->con->prepare('INSERT INTO usuario_contrasena VALUES(DEFAULT, ?, ?)');
        $q->bindParam(1, $username, PDO::PARAM_STR);
        $q->bindParam(2, $password, PDO::PARAM_STR);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo  $e->getMessage();
      }
    }

    //obtenemos usuarios de una tabla con postgreSql
    public function checkUsername($username) {
      try {
        $q = $this->con->prepare('SELECT 1 FROM usuario_contrasena WHERE usuario = ? LIMIT 1');
        $q->bindParam(1, $username, PDO::PARAM_STR);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      $usernameInDB = $q -> fetch(PDO::FETCH_OBJ);
      
      if ($usernameInDB) {
        return true;    
      }

      return false;
    }

    public function checkCredentials($username, $password) {
      try {
        $q = $this->con->prepare('SELECT 1 FROM usuario_contrasena WHERE usuario = ? AND contrasena = ? LIMIT 1');
        $q->bindParam(1, $username, PDO::PARAM_STR);
        $q->bindParam(2, $password, PDO::PARAM_STR);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      $credentialsCorrect = $q -> fetch(PDO::FETCH_OBJ);
      
      if ($credentialsCorrect) {
        return true;    
      }

      return false;
    }

  }
?>
