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
        self::$instance = new ItemManager();
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
          return false;         
      }
      return true;
    }

    public function getConsignated($id_spec) {
      try {
        $q = $this->con->prepare('SELECT cantidad FROM inventario WHERE id_especificacion = ? AND id_estado = 2');
        $q->bindParam(1, $id_spec, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo  $e->getMessage();
          return false;         
      }
      return true;
    }

    public function getReserved($id_spec) {
      try {
        $q = $this->con->prepare('SELECT cantidad FROM inventario WHERE id_especificacion = ? AND id_estado = 3');
        $q->bindParam(1, $id_spec, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo  $e->getMessage();
          return false;         
      }
      return true;
    }

    public function getSold($id_spec) {
      try {
        $q = $this->con->prepare('SELECT cantidad FROM inventario WHERE id_especificacion = ? AND id_estado = 4');
        $q->bindParam(1, $id_spec, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo  $e->getMessage();
          return false;         
      }
      return true;
    }

    public function getAll() {
      try {
        $q = $this->con->prepare('SELECT * FROM inventario');
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo  $e->getMessage();
          return false;         
      }
      return true;
    }

    public function updateAvailable($id_spec, $quantity) {
      if (getAvailable()->cantidad > getReserved()->cantidad + getConsignated()->cantidad) {
        try {
          $q = $this->con->prepare('UPDATE inventario SET cantidad = ? WHERE id_spec=? AND id_estado = 1');
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
      if (getReserved()->cantidad + getConsignated()->cantidad <= getAvailable()->cantidad) {
        try {
          $q = $this->con->prepare('UPDATE inventario SET cantidad = ? WHERE id_spec=? AND id_estado = 2');
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
      if (getReserved()->cantidad + getConsignated()->cantidad <= getAvailable()->cantidad) {
        try {
          $q = $this->con->prepare('UPDATE inventario SET cantidad = ? WHERE id_spec=? AND id_estado = 3');
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
