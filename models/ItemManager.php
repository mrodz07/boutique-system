<?php
  require_once("../db/PSQLDB.php");
  require_once("../interfaces/IItemManager.php");

  class ItemManager implements IItemManager {
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

    public function saveProduct($name) {
      try {
        $q = $this->con->prepare('INSERT INTO producto VALUES(DEFAULT, ?)');
        $q->bindParam(1, $name, PDO::PARAM_STR);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo  $e->getMessage();
          return false;         
      }
      return true;
    }

    public function saveBrand($name) {
      try {
        $q = $this->con->prepare('INSERT INTO marca VALUES(DEFAULT, ?)');
        $q->bindParam(1, $name, PDO::PARAM_STR);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo  $e->getMessage();
          return false;         
      }
      return true;
    }

    public function saveType($name) {
      try {
        $q = $this->con->prepare('INSERT INTO tipo VALUES(DEFAULT, ?)');
        $q->bindParam(1, $name, PDO::PARAM_STR);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo  $e->getMessage();
          return false;         
      }
      return true;
    }

    public function saveSpec($id_product, $id_brand, $id_season, $id_category, $id_gender, $id_color, $id_size, $description) {
      try {
        $q = $this->con->prepare('INSERT INTO especificacion VALUES(DEFAULT, ?, ?, ?, ?, ?, ?, ?, ?)');
        $q->bindParam(1, $id_product, PDO::PARAM_INT);
        $q->bindParam(2, $id_brand, PDO::PARAM_INT);
        $q->bindParam(3, $id_season, PDO::PARAM_INT);
        $q->bindParam(4, $id_category, PDO::PARAM_INT);
        $q->bindParam(5, $id_gender, PDO::PARAM_INT);
        $q->bindParam(6, $id_color, PDO::PARAM_INT);
        $q->bindParam(7, $id_size, PDO::PARAM_INT);
        $q->bindParam(8, $description, PDO::PARAM_STR);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          error_log($e->getMessage());
          return false;         
      }
      return true;
    }

    public function saveSpecType($id_spec, $id_type) {
      try {
        $q = $this->con->prepare('INSERT INTO especificacion_tipo VALUES(DEFAULT, ?, ?)');
        $q->bindParam(1, $id_spec, PDO::PARAM_INT);
        $q->bindParam(2, $id_type, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo  $e->getMessage();
          return false;         
      }
      return true;
    }

    public function updateProduct($id, $name) {
      try {
        $q = $this->con->prepare('UPDATE producto SET nombre=? WHERE id=?');
        $q->bindParam(1, $name, PDO::PARAM_STR);
        $q->bindParam(2, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo  $e->getMessage();
          return false;         
      }
      return true;
    }

    public function updateBrand($id, $name) {
      try {
        $q = $this->con->prepare('UPDATE marca SET nombre=? WHERE id=?');
        $q->bindParam(1, $name, PDO::PARAM_STR);
        $q->bindParam(2, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          error_log($e->getMessage());
          return false;         
      }
      return true;
    }

    public function updateType($id, $name) {
      try {
        $q = $this->con->prepare('UPDATE tipo SET nombre=? WHERE id=?');
        $q->bindParam(1, $name, PDO::PARAM_STR);
        $q->bindParam(2, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo  $e->getMessage();
          return false;         
      }
      return true;
    }

    public function updateSpec($id, $id_product, $id_brand, $id_season, $id_category, $id_gender, $id_color, $id_size, $description) {
      try {
        $q = $this->con->prepare('UPDATE especificacion SET id_producto=?, id_marca=?, id_temporada=?, id_categoria=?, id_genero=?, id_color_tono=?, id_talla_etapa=?, descripcion=? WHERE id=?');
        $q->bindParam(1, $id_product, PDO::PARAM_INT);
        $q->bindParam(2, $id_brand, PDO::PARAM_INT);
        $q->bindParam(3, $id_season, PDO::PARAM_INT);
        $q->bindParam(4, $id_category, PDO::PARAM_INT);
        $q->bindParam(5, $id_gender, PDO::PARAM_INT);
        $q->bindParam(6, $id_color, PDO::PARAM_INT);
        $q->bindParam(7, $id_size, PDO::PARAM_INT);
        $q->bindParam(8, $description, PDO::PARAM_STR);
        $q->bindParam(9, $id, PDO::PARAM_STR);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          error_log($e->getMessage());
          return false;         
      }
      return true;
    }

    public function updateSpecType($id, $id_spec, $id_type) {
      try {
        $q = $this->con->prepare('UPDATE especificacion_tipo SET id_especificacion=?, id_tipo=? WHERE id=?');
        $q->bindParam(1, $name_spec, PDO::PARAM_STR);
        $q->bindParam(2, $id_spec, PDO::PARAM_INT);
        $q->bindParam(3, $id_type, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo  $e->getMessage();
          return false;         
      }
      return true;
    }

    public function getProduct($id) {
      try {
        $q = $this->con->prepare('SELECT nombre FROM producto WHERE id = ?');
        $q->bindParam(1, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetch(PDO::FETCH_OBJ);
    }

    public function getBrand($id) {
      try {
        $q = $this->con->prepare('SELECT nombre FROM marca WHERE id = ?');
        $q->bindParam(1, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetch(PDO::FETCH_OBJ);
    }

    public function getType($id) {
      try {
        $q = $this->con->prepare('SELECT nombre FROM tipo WHERE id = ?');
        $q->bindParam(1, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetch(PDO::FETCH_OBJ);
    }

    public function getSpec($id) {
      try {
        $q = $this->con->prepare('SELECT * FROM especificacion WHERE id = ?');
        $q->bindParam(1, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          error_log($e->getMessage());
      }

      return $q->fetch(PDO::FETCH_OBJ);
    }

    public function getGender($id) {
      try {
        $q = $this->con->prepare('SELECT nombre FROM genero WHERE id = ?');
        $q->bindParam(1, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetch(PDO::FETCH_OBJ);
    }

    public function getSize($id) {
      try {
        $q = $this->con->prepare('SELECT nombre, numero FROM talla WHERE id = ?');
        $q->bindParam(1, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetch(PDO::FETCH_OBJ);
    }

    public function getSizeStage($id) {
      try {
        $q = $this->con->prepare('SELECT id_talla, id_etapa FROM talla_etapa WHERE id = ?');
        $q->bindParam(1, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetch(PDO::FETCH_OBJ);
    }

    public function getColor($id) {
      try {
        $q = $this->con->prepare('SELECT nombre FROM color WHERE id = ?');
        $q->bindParam(1, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetch(PDO::FETCH_OBJ);
    }

    public function getTone($id) {
      try {
        $q = $this->con->prepare('SELECT nombre FROM tono WHERE id = ?');
        $q->bindParam(1, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetch(PDO::FETCH_OBJ);
    }

    public function getColorTone($id) {
      try {
        $q = $this->con->prepare('SELECT id_color, id_tono, valor_hexadecimal FROM color_tono WHERE id = ?');
        $q->bindParam(1, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetch(PDO::FETCH_OBJ);
    }

    public function getCategory($id) {
      try {
        $q = $this->con->prepare('SELECT nombre FROM categoria WHERE id = ?');
        $q->bindParam(1, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetch(PDO::FETCH_OBJ);
    }

    public function getSeason($id) {
      try {
        $q = $this->con->prepare('SELECT nombre FROM temporada WHERE id = ?');
        $q->bindParam(1, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetch(PDO::FETCH_OBJ);
    }

    public function getSpecType($id) {
      try {
        $q = $this->con->prepare('SELECT id_especificacion, id_tipo FROM estado WHERE id = ?');
        $q->bindParam(1, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetch(PDO::FETCH_OBJ);
    }

    public function getState($id) {
      try {
        $q = $this->con->prepare('SELECT nombre FROM estado WHERE id = ?');
        $q->bindParam(1, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo $e->getMessage();
      }

      return $q->fetch(PDO::FETCH_OBJ);
    }

    public function getStage($id) {
      try {
        $q = $this->con->prepare('SELECT nombre FROM etapa WHERE id = ?');
        $q->bindParam(1, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
      } catch(PDOException $e) {
          echo $e->getMessage();
      }

      return $q->fetch(PDO::FETCH_OBJ);
    }

    public function getAllProducts() {
      try {
        $q = $this->con->prepare('SELECT * FROM producto');
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllBrands() {
      try {
        $q = $this->con->prepare('SELECT * FROM marca');
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllGenders() {
      try {
        $q = $this->con->prepare('SELECT * FROM genero');
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllSizes() {
      try {
        $q = $this->con->prepare('SELECT * FROM talla');
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllColors() {
      try {
        $q = $this->con->prepare('SELECT * FROM color');
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetchAll(PDO::FETCH_OBJ);
    }
  
    public function getAllTones() {
      try {
        $q = $this->con->prepare('SELECT * FROM tono');
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllColorTones() {
      try {
        $q = $this->con->prepare('SELECT * FROM color_tono');
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllSizeStages() {
      try {
        $q = $this->con->prepare('SELECT * FROM talla_etapa');
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllCategories() {
      try {
        $q = $this->con->prepare('SELECT * FROM categoria');
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllSeasons() {
      try {
        $q = $this->con->prepare('SELECT * FROM temporada');
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllTypes() {
      try {
        $q = $this->con->prepare('SELECT * FROM tipo');
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllStates() {
      try {
        $q = $this->con->prepare('SELECT * FROM estado');
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllSpec() {
      try {
        $q = $this->con->prepare('SELECT * FROM especificacion');
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllSpecTypes() {
      try {
        $q = $this->con->prepare('SELECT * FROM especificacion_tipo');
        $q->execute();
        $this->con->close();
      } catch(PDOException $e){
          echo $e->getMessage();
      }

      return $q->fetchAll(PDO::FETCH_OBJ);
    }

    public function deleteProduct($id) {
      try {
        $q = $this->con->prepare('DELETE FROM producto WHERE id = ?');
        $q->bindParam(1, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
        return true;
      } catch(PDOException $e){
          echo $e->getMessage();
          return false;
      }
    }

    public function deleteBrand($id) {
      try {
        $q = $this->con->prepare('DELETE FROM marca WHERE id = ?');
        $q->bindParam(1, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
        return true;
      } catch(PDOException $e){
          echo $e->getMessage();
          return false;
      }
    }

    public function deleteType($id) {
      try {
        $q = $this->con->prepare('DELETE FROM tipo WHERE id = ?');
        $q->bindParam(1, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
        return true;
      } catch(PDOException $e){
          echo $e->getMessage();
          return false;
      }
    }

    public function deleteSpec($id) {
      try {
        $q = $this->con->prepare('DELETE FROM especificacion WHERE id = ?');
        $q->bindParam(1, $id, PDO::PARAM_INT);
        $q->execute();
        $this->con->close();
        return true;
      } catch(PDOException $e){
          error_log($e->getMessage());
          return false;
      }
    }

  }
?>
