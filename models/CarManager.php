<?php
  require_once("../db/Database.php");
  require_once("../interfaces/ICarManager.php");

  class CarManager implements ICarManager {
    private $con;
    private static $instance = null;

    private function __construct() {
      $this->con = Database::getInstance();
    }

    public static function getInstance() {
      if (self::$instance === null) {
        self::$instance = new CarManager();
      }

      return self::$instance;
    }

    //insertamos usuarios en una tabla con postgreSql
    public function save($nombre, $id_marca, $ac) {
      try {
        $q = $this->con->prepare('INSERT INTO auto (id, nombre, id_marca, aire_acondicionado) values (DEFAULT, ?, ?, ?)');
        $q->bindParam(1, $nombre, PDO::PARAM_STR);
        $q->bindParam(2, $id_marca, PDO::PARAM_STR);
        $q->bindParam(3, $ac, PDO::PARAM_STR);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo  $e->getMessage();
      }
    }

    public function update($id, $nombre, $id_marca, $ac) {
      try {
        $q = $this->con->prepare('UPDATE auto SET nombre = ?, marca = ?, aire_acondicionado = ? WHERE id = ?');
        $q->bindParam(1, $nombre, PDO::PARAM_STR);
        $q->bindParam(2, $id_marca, PDO::PARAM_STR);
        $q->bindParam(3, $ac, PDO::PARAM_STR);
        $q->bindParam(4, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }
    }

    //obtenemos usuarios de una tabla con postgreSql
    public function get($id) {
      try {
        $q = $this->con->prepare('SELECT * FROM auto WHERE id = ?');
        $q->bindParam(1, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetch(PDO::FETCH_OBJ);
    }

    public function getAll() {
      try {
        $q = $this->con->prepare('SELECT * FROM auto');
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage(); }

      return $q->fetchAll(PDO::FETCH_OBJ);
    }

    public function delete($id) {
      try {
        $q = $this->con->prepare('DELETE FROM auto WHERE id = ?');
        $q->bindParam(1, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
        return true;
      } catch(PDOException $e){
          echo $e->getMessage();
      }
    }

    public static function baseurl() {
      return stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'];
    }

    public function checkUser($id) {
      if(!$id) {
        header("Location:" . CarManager::baseurl() . "app/list.php");
      }
    }
  }
?>
