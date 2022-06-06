<?php
  session_start();
  require_once "../models/UserManager.php";
  require_once "../models/ItemManager.php";

  $userManager = UserManager::getInstance();
  $itemManager = ItemManager::getInstance();
  $id = $_REQUEST['id'];
  $username = $_SESSION['username'];

  if (!isset($username)) {
    $error = "Entra a tu cuenta antes de acceder al sistema";
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
    <title>Detalles de artículo</title>
    <link rel="stylesheet" href="style.css">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
</head>
<body>
    <?php
      $item = $itemManager->getSpec($id);
    ?>
    <div class="container">
      <h2 class="main-title">Detalles del artículo</h2>
      <form>
        <div class="form-group">
          <p>ID</p>
          <input type="text" name="id" value="<?php echo $item->id ?>" class="form-control" id="id" placeholder="id" disabled>
        </div>
        <div class="form-group">
          <label for="product">Tipo de producto</label>
          <input type="text" name="product" value="<?php echo $itemManager->getProduct($item->id_producto)->nombre ?>" class="form-control" id="product" disabled>
        </div>
        <div class="form-group">
          <p>Marca</p>
          <input type="text" name="brand" id="brand" value="<?php echo $itemManager->getBrand($item->id_marca)->nombre ?>" disabled </input>
        </div>
        <div class="form-group">
          <p>Categoría</p>
          <input type="text" name="category" id="category" value="<?php echo $itemManager->getCategory($item->id_categoria)->nombre ?>" disabled </input>
        </div>
        <div class="form-group">
          <p>Temporada</p>
          <input type="text" name="season" id="season" value="<?php echo $itemManager->getSeason($item->id_temporada)->nombre ?>" disabled </input>
        </div>
        <div class="form-group">
          <p>Género</p>
          <input type="text" name="gender" id="gender" value="<?php echo $itemManager->getGender($item->id_genero)->nombre ?>" disabled </input>
        </div>
        <div class="form-group">
          <div class='color-cube-container' style='flex-direction: row;'>Color
            <div class='color-cube' style='background-color: #<?php echo $itemManager->getColorTone($item->id_color_tono)->valor_hexadecimal?>;'></div>
          </div>
          <input type="text" name="color" id="color" value="<?php echo $itemManager->getColor($itemManager->getColorTone($item->id_color_tono)->id_color)->nombre .  " " . $itemManager->getTone($itemManager->getColorTone($item->id_color_tono)->id_tono)->nombre?>" disabled </input>
        </div>
        <div class="form-group">
          <p>Talla</p>
          <input type="text" value="<?php echo $itemManager->getSize($itemManager->getSizeStage($item->id_talla_etapa)->id_talla)->nombre . " " . $itemManager->getStage($itemManager->getSizeStage($item->id_talla_etapa)->id_etapa)->nombre?>" disabled </input>
        </div>
        <div class="form-group">
          <label for="description">Descripción</label>
          <input type="text" name="description" style="overflow: scroll" value="<?php echo $item->descripcion ?>" class="form-control" id="description" disabled>
        </div>
        <div class="form-group">
        <a class="button info" href="..">Regresar<a/>
        <div>
      </form>
    </div>
  </body>
</html>

<?php
  unset($_SESSION["error"]);
  unset($_SESSION["message"]);
?>
