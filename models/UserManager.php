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
    public function save($username, $password, $isAdmin) {
      $passwordHash = password_hash($password, PASSWORD_DEFAULT);
      try {
        $q = $this->con->prepare('INSERT INTO usuario_contrasena VALUES(DEFAULT, ?, ?, ?)');
        $q->bindParam(1, $username, PDO::PARAM_STR);
        $q->bindParam(2, $passwordHash, PDO::PARAM_STR);
        $q->bindParam(3, $isAdmin, PDO::PARAM_INT);
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
        $q = $this->con->prepare('SELECT contrasena FROM usuario_contrasena WHERE usuario = ?');
        $q->bindParam(1, $username, PDO::PARAM_STR);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }
      $dbPassHash = $q -> fetch(PDO::FETCH_OBJ) -> contrasena;
      
      if (password_verify($password, $dbPassHash)) {
        return true;    
      }

      return false;
    }

    public function isAdmin($username) {
      try {
        $q = $this->con->prepare('SELECT admin FROM usuario_contrasena WHERE usuario = ?');
        $q->bindParam(1, $username, PDO::PARAM_STR);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      $isAdmin = $q -> fetch(PDO::FETCH_OBJ);
      
      if ($isAdmin -> admin) {
        return true;    
      }

      return false;
    }

    public function updatePass($username, $password) {
      $passwordHash = password_hash($password, PASSWORD_DEFAULT);
      try {
        $q = $this->con->prepare("UPDATE usuario_contrasena SET contrasena=? WHERE usuario=?");
        $q->bindParam(1, $passwordHash, PDO::PARAM_STR);
        $q->bindParam(2, $username, PDO::PARAM_STR);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }
    }

    public function get($username) {
      try {
        $q = $this->con->prepare('SELECT id, admin FROM usuario_contrasena WHERE usuario = ?');
        $q->bindParam(1, $username, PDO::PARAM_STR);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetch(PDO::FETCH_OBJ);
    }

    public function getAll() {
      try {
        $q = $this->con->prepare('SELECT id, usuario, admin FROM usuario_contrasena');
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage(); }

      return $q->fetchAll(PDO::FETCH_OBJ);
    }

    public function delete($username) {
      try {
        $q = $this->con->prepare('DELETE FROM usuario_contrasena WHERE usuario = ?');
        $q->bindParam(1, $username, PDO::PARAM_STR);
        $q->execute();
        $this->con->close();
        return true;
      } catch(PDOException $e){
          echo $e->getMessage();
      }
    }

    public function updateUsername($oldUsername, $newUsername) {
      try {
        $q = $this->con->prepare("UPDATE usuario_contrasena SET usuario=? WHERE usuario=?");
        $q->bindParam(1, $newUsername, PDO::PARAM_STR);
        $q->bindParam(2, $oldUsername, PDO::PARAM_STR);
        $q->execute();
        $this->con->close();
        return true;
      } catch(PDOException $e){
          return false;
      }
      
      return true; 
    }
  }
?>
