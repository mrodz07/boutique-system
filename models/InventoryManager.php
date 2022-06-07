<?php
  require_once("../db/PSQLDB.php");
  require_once("../interfaces/IInventoryManager.php");

  class InventoryManager implements IInventoryManager {
    private $con;
    private static $instance = null;

    private function __construct() {
      $this->con = PSQLDB::getInstance();
    }

    public static function getInstance() {
      if (self::$instance === null) {
        self::$instance = new InventoryManager();
      }

      return self::$instance;
    }

    public function getAvailable($id_spec) {
      try {
        $q = $this->con->prepare('SELECT cantidad FROM inventario WHERE id_especificacion = ? AND id_estado = 1');
        $q->bindParam(1, $id_spec, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo  $e->getMessage();
          return null;         
      }
      return $q->fetch(PDO::FETCH_OBJ);
    }

    public function getPrice($id_spec) {
      try {
        $q = $this->con->prepare('SELECT precio FROM inventario WHERE id_especificacion = ? AND id_estado = 1');
        $q->bindParam(1, $id_spec, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo  $e->getMessage();
          return null;         
      }
      return $q->fetch(PDO::FETCH_OBJ);
    }

    public function getConsignated($id_spec) {
      try {
        $q = $this->con->prepare('SELECT cantidad FROM inventario WHERE id_especificacion = ? AND id_estado = 2');
        $q->bindParam(1, $id_spec, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo  $e->getMessage();
          return null;         
      }
      return $q->fetch(PDO::FETCH_OBJ);
    }

    public function getReserved($id_spec) {
      try {
        $q = $this->con->prepare('SELECT cantidad FROM inventario WHERE id_especificacion = ? AND id_estado = 3');
        $q->bindParam(1, $id_spec, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo  $e->getMessage();
          return null;         
      }
      return $q->fetch(PDO::FETCH_OBJ);
    }

    public function getSold($id_spec) {
      try {
        $q = $this->con->prepare('SELECT cantidad FROM inventario WHERE id_especificacion = ? AND id_estado = 4');
        $q->bindParam(1, $id_spec, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo  $e->getMessage();
          return null;         
      }
      return $q->fetch(PDO::FETCH_OBJ);
    }

    public function getAll() {
      try {
        $q = $this->con->prepare('SELECT * FROM inventario');
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo  $e->getMessage();
          return null;         
      }
      return $q->fetchAll(PDO::FETCH_OBJ);
    }

    public function updateAvailable($id_spec, $quantity) {
      if ($this->getAvailable($id_spec)->cantidad >= $this->getReserved($id_spec)->cantidad + $this->getConsignated($id_spec)->cantidad) {
        try {
          $q = $this->con->prepare('UPDATE inventario SET cantidad = ? WHERE id_especificacion=? AND id_estado = 1');
          $q->bindParam(1, $quantity, PDO::PARAM_INT);
          $q->bindParam(2, $id_spec, PDO::PARAM_INT);
          $q->execute();
          $this->con->close();
        } catch(PDOException $e) {
            echo  $e->getMessage();
            return false;         
        }
        return true;
      } else {
        return false;
      }
    }

    public function updateConsignated($id_spec, $quantity) {
      if ($this->getReserved($id_spec)->cantidad + $this->getConsignated($id_spec)->cantidad <= $this->getAvailable($id_spec)->cantidad) {
        try {
          $q = $this->con->prepare('UPDATE inventario SET cantidad = ? WHERE id_especificacion=? AND id_estado = 2');
          $q->bindParam(1, $quantity, PDO::PARAM_INT);
          $q->bindParam(2, $id_spec, PDO::PARAM_INT);
          $q->execute();
          $this->con->close();
        } catch(PDOException $e) {
            echo  $e->getMessage();
            return false;         
        }
        return true;
      } else {
        return false;
      }
    }

    public function updateReserved($id_spec, $quantity) {
      if ($this->getReserved($id_spec)->cantidad + this->getConsignated($id_spec)->cantidad <= $this->getAvailable($id_spec)->cantidad) {
        try {
          $q = $this->con->prepare('UPDATE inventario SET cantidad = ? WHERE id_especificacion=? AND id_estado = 3');
          $q->bindParam(1, $quantity, PDO::PARAM_INT);
          $q->bindParam(2, $id_spec, PDO::PARAM_INT);
          $q->execute();
          $this->con->close();
        } catch(PDOException $e) {
            echo  $e->getMessage();
            return false;         
        }
        return true;
      } else {
        return false;
      }
    }

    public function updatePrice($id_spec, $price) {
        try {
          $q = $this->con->prepare('UPDATE inventario SET precio = ? WHERE id_especificacion=? AND id_estado = 1');
          $q->bindParam(1, $price, PDO::PARAM_INT);
          $q->bindParam(2, $id_spec, PDO::PARAM_INT);
          $q->execute();
          $this->con->close();
        } catch(PDOException $e) {
            error_log($e->getMessage());
            return false;         
        }
      return true;
    }

    public function deleteItem($id_spec) {
      try {
        $q = $this->con->prepare('DELETE FROM inventario WHERE id_especificacion=?');
        $q->bindParam(1, $id_spec, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo  $e->getMessage();
          return false;         
      }
      return true;
    }

  }
?>
