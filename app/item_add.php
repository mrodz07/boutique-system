<?php
  session_start();
  require_once "../models/ItemManager.php";
  require_once "../models/UserManager.php";

  $itemManager = ItemManager::getInstance();
  $userManager = UserManager::getInstance();
  $username = $_SESSION['username'];

  if (!isset($username)) {
    $error = "Entra a tu cuenta antes de acceder al sistema";
    // User is not logged in, so send user away.
    $_SESSION['error'] = $error;
    header("Location: /");
    exit;
  }
  
  if(!$userManager -> isAdmin($username)) {
    $error = "No estás autorizado para entrar a esta página";
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
    <title>Añadir artículo</title>
    <link rel="stylesheet" href="style.css">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
    <script src="item_script.js"></script>
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
    ?>
    <div class="container">
      <h2 class="main-title">Añadir artículo</h2>
      <form action="/app/item_save.php" method="POST"> 
        <div class="form-group">
          <p>Tipo de producto</p>
          <select name="product">
            <?php
              foreach($products as $product) {
                echo "<option value='" . $product->id . "'>" . $product->nombre . "</option>";
              }
            ?>
          </select>
        </div>
        <div class="form-group">
          <p>Marca</p>
          <select name="brand">
            <?php
              foreach($brands as $brand) {
                echo "<option value='" . $brand->id . "'>" . $brand->nombre . "</option>";
              }
            ?>
          </select>
        </div>
        <div class="form-group">
          <p>Categoría</p>
          <select name="category">
            <?php
              foreach($categories as $category) {
                echo "<option value='" . $category->id . "'>" . $category->nombre . "</option>";
              }
            ?>
          </select>
        </div>
        <div class="form-group">
          <p>Género</p>
          <select name="gender">
            <?php
              foreach($genders as $gender) {
                echo "<option value='" . $gender->id . "'>" . $gender->nombre . "</option>";
              }
            ?>
          </select>
        </div>
        <div class="form-group">
          <div class="option-menu-container" style="flex-direction: row;">Color
            <div class="color-cube-container option-menu">
            <?php
              foreach($colorTones as $colorTone)
                echo "<div class='color-cube' style='display: none; background-color: #$colorTone->valor_hexadecimal;'></div>";
            ?>
          </div>
        </div>
          <select name="color" id="color">
            <?php
              foreach($colorTones as $colorTone) {
                echo "<option value='" . $colorTone->id . "'>";
                echo $itemManager->getColor($itemManager->getColorTone($colorTone->id)->id_color)->nombre . " " . $itemManager->getTone($itemManager->getColorTone($colorTone->id)->id_tono)->nombre;
                echo "</option>";
              }
            ?>
          </select>
        </div>
        <div class="form-group">
        <p>Talla</p>
          <select name="size" id="size">
            <?php
              foreach($sizeStages as $sizeStage) {
                if ($itemManager->getSize($sizeStage->id_talla)-> nombre == null)
                  echo "<option value'" . $sizeStage->id . "'>" . $itemManager->getSize($sizeStage->id_talla)->numero . " " . $itemManager->getStage($sizeStage->id_etapa)->nombre . "</option>";
                else
                  echo "<option value'" . $sizeStage->id . "'>" . $itemManager->getSize($sizeStage->id_talla)->nombre . " " . $itemManager->getStage($sizeStage->id_etapa)->nombre . "</option>";
              }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="description">Descripción</label>
          <input type="text" name="description" value="" class="form-control" id="description" placeholder="Características del producto">
        </div>
        <input type="submit" name="submit" class="button info" value="Guardar usuario"/>
      </form>
    </div>
  </body>
</html>

<?php
  unset($_SESSION["error"]);
  unset($_SESSION["message"]);
?>
