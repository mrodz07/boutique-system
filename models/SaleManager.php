<?php
  require_once("../db/PSQLDB.php");
  require_once("../interfaces/ISaleManager.php");

  class SaleManager implements ISaleManager {
    private $con;
    private static $instance = null;

    private function __construct() {
      $this->con = PSQLDB::getInstance();
    }

    public static function getInstance() {
      if (self::$instance === null) {
        self::$instance = new SaleManager();
      }

      return self::$instance;
    }

    public function createSale($id_pay, $id_inventory, $id_state, $quantity) {
      try {
        $q = $this->con->prepare('INSERT INTO venta VALUES(DEFAULT, ?, ?, DEFAULT, ?, ?)');
        $q->bindParam(1, $id_pay, PDO::PARAM_INT);
        $q->bindParam(2, $id_inventory, PDO::PARAM_INT);
        $q->bindParam(3, $id_state, PDO::PARAM_INT);
        $q->bindParam(4, $quantity, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo  $e->getMessage();
          return false;         
      }
      return true;
    }

    public function updateSale($id, $id_pay, $id_inventory, $id_state, $quantity) {
      try {
        $q = $this->con->prepare('UPDATE venta SET id_pago=?, id_inventario=?, id_estado=?, cantidad=? WHERE id=?');
        $q->bindParam(1, $id_pay, PDO::PARAM_INT);
        $q->bindParam(2, $id_inventory, PDO::PARAM_INT);
        $q->bindParam(3, $id_state, PDO::PARAM_INT);
        $q->bindParam(4, $quantity, PDO::PARAM_INT);
        $q->bindParam(5, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo  $e->getMessage();
          return false;         
      }
      return true;
    }

    public function getSale($id) {
      try {
        $q = $this->con->prepare('SELECT * FROM venta WHERE id = ?');
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
        $q = $this->con->prepare('SELECT * FROM venta');
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetchAll(PDO::FETCH_OBJ);
    }

    public function removeSale($id) {
      try {
        $q = $this->con->prepare('DELETE FROM venta WHERE id = ?');
        $q->bindParam(1, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
        return true;
      } catch(PDOException $e){
          echo $e->getMessage();
          return false;
      }
    }
    
  }
?>
