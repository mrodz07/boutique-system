<?php session_start();
  require_once "../models/UserManager.php";
  require_once "../models/ItemManager.php";
  $userManager = UserManager::getInstance();
  $itemManager = ItemManager::getInstance();
  $username = $_SESSION['username'];
  $id = $_REQUEST['id'];

  if (!isset($username)) {
    $error = "Inicia sesión para entrar al sistema";
    // User is not logged in, so send user away.
    $_SESSION['error'] = $error;
    header("Location: /");
    exit;
  }
?>

<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <title>Editar artículo</title>
      <link rel="stylesheet" href="style.css">
      <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
  </head>
  <body>
    <?php
      if (isset($_SESSION["error"])) {
        $error = $_SESSION["error"];
        echo "<div class='alert'>$error</div>";
      }

      $products = $itemManager->getAllProducts();
      $brands = $itemManager->getAllBrands();
      $seasons = $itemManager->getAllSeasons();
      $categories = $itemManager->getAllCategories();
      $genders = $itemManager->getAllGenders();
      $colorTones = $itemManager->getAllColorTones();
      $sizeStages = $itemManager->getAllSizeStages();

      $itemData = $itemManager->getSpec($id);
    ?>

    <div class="container">
      <h2 class="main-title">Editar artículo</h2>
      <?php echo "<form action='/app/item_update.php?id=$id' method='POST'>"?>
        <div class="form-group">
          <p>Tipo de producto</p>
          <select name="product">
            <?php
              foreach($products as $product) {
                if ($itemData->id_producto == $product->id) {
                  echo "<option selected value='" . $product->id . "'>" . $product->nombre . "</option>";
                } else {
                  echo "<option value='" . $product->id . "'>" . $product->nombre . "</option>";
                }
              }
            ?>
          </select>
        </div>
        <div class="form-group">
          <p>Marca</p>
          <select name="brand">
            <?php
              foreach($brands as $brand) {
                if ($itemData->id_marca == $brand->id) {
                  echo "<option selected value='" . $brand->id . "'>" . $brand->nombre . "</option>";
                } else {
                  echo "<option value='" . $brand->id . "'>" . $brand->nombre . "</option>";
                }
              }
            ?>
          </select>
        </div>
        <div class="form-group">
          <p>Categoría</p>
          <select name="category">
            <?php
              foreach($categories as $category) {
                if ($itemData->id_categoria == $category->id) {
                  echo "<option selected value='" . $category->id . "'>" . $category->nombre . "</option>";
                } else {    
                  echo "<option value='" . $category->id . "'>" . $category->nombre . "</option>";
                }
              }
            ?>
          </select>
        </div>
        <div class="form-group">
          <p>Temporada</p>
          <select name="season">
            <?php
              foreach($seasons as $season) {
                if ($itemData->id_temporada == $season->id) {
                  echo "<option selected value='" . $season->id . "'>" . $season->nombre . "</option>";
                } else {
                  echo "<option value='" . $season->id . "'>" . $season->nombre . "</option>";
                }
              }
            ?>
          </select>
        </div>
        <div class="form-group">
          <p>Género</p>
          <select name="gender">
            <?php
              foreach($genders as $gender) {
                if ($itemData->id_genero == $gender->id) {
                  echo "<option selected value='" . $gender->id . "'>" . $gender->nombre . "</option>";
                } else {
                  echo "<option value='" . $gender->id . "'>" . $gender->nombre . "</option>";
                }
              }
            ?>
          </select>
        </div>
        <div class="form-group">
          <div class="option-menu-container" style="flex-direction: row;">Color
            <div class="color-cube-container option-menu">
            <?php
              foreach($colorTones as $colorTone) {
                echo "<div selected class='color-cube' style='display: none; background-color: #$colorTone->valor_hexadecimal;'></div>";
              }
            ?>
          </div>
        </div>
          <select name="color" id="color">
            <?php
              foreach($colorTones as $colorTone) {
                if ($itemData->id_color_tono == $colorTone->id) {
                  echo "<option selected value='" . $colorTone->id . "'>";
                  echo $itemManager->getColor($itemManager->getColorTone($colorTone->id)->id_color)->nombre . " " . $itemManager->getTone($itemManager->getColorTone($colorTone->id)->id_tono)->nombre;
                  echo "</option>";
                } else {
                  echo "<option value='" . $colorTone->id . "'>";
                  echo $itemManager->getColor($itemManager->getColorTone($colorTone->id)->id_color)->nombre . " " . $itemManager->getTone($itemManager->getColorTone($colorTone->id)->id_tono)->nombre;
                  echo "</option>";
                }
              }
            ?>
          </select>
        </div>
        <div class="form-group">
        <p>Talla</p>
          <select name="size" id="size">
            <?php
              foreach($sizeStages as $sizeStage) {
                if ($itemData->id_talla_etapa == $sizeStage->id) {
                  if ($itemManager->getSize($sizeStage->id_talla)-> nombre == null)
                    echo "<option selected value='" . $sizeStage->id . "'>" . $itemManager->getSize($sizeStage->id_talla)->numero . " " . $itemManager->getStage($sizeStage->id_etapa)->nombre . "</option>";
                  else
                    echo "<option selected value='" . $sizeStage->id . "'>" . $itemManager->getSize($sizeStage->id_talla)->nombre . " " . $itemManager->getStage($sizeStage->id_etapa)->nombre . "</option>";
                } else {
                  if ($itemManager->getSize($sizeStage->id_talla)-> nombre == null)
                    echo "<option value='" . $sizeStage->id . "'>" . $itemManager->getSize($sizeStage->id_talla)->numero . " " . $itemManager->getStage($sizeStage->id_etapa)->nombre . "</option>";
                  else
                    echo "<option value='" . $sizeStage->id . "'>" . $itemManager->getSize($sizeStage->id_talla)->nombre . " " . $itemManager->getStage($sizeStage->id_etapa)->nombre . "</option>";
                }
              }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="description">Descripción</label>
          <input type="text" name="description" value="<?php echo $itemData->descripcion ?>" class="form-control" id="description" placeholder="Características del producto">
        </div>
        <input type="submit" name="submit" class="button info" value="Guardar artículo"/>
      </form>
    </div>
  </body>
</html>

<?php
  unset($_SESSION["error"]);
  unset($_SESSION["message"]);
?>
