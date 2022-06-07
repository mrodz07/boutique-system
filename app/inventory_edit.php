<?php session_start();
  require_once "../models/UserManager.php";
  require_once "../models/InventoryManager.php";
  $userManager = UserManager::getInstance();
  $inventoryManager = InventoryManager::getInstance();
  $username = $_SESSION['username'];
  $id = $_REQUEST['id'];

  if (!isset($username)) {
    $error = "Inicia sesión para entrar al sistema";
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
      <title>Editar artículos en inventario</title>
      <link rel="stylesheet" href="style.css">
      <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
  </head>
  <body>
    <?php
      if (isset($_SESSION["error"])) {
        $error = $_SESSION["error"];
        echo "<div class='alert'>$error</div>";
      }
    ?>

    <div class="container">
      <h2 class="main-title">Editar inventario</h2>
      <?php echo "<form action='/app/inventory_update.php?id=$id' method='POST'>"?>
        <div class="form-group">
          <label for="price">Precio</label>
          <input type="text" name="price" value="<?php echo $inventoryManager->getPrice($id)->precio?>" class="form-control" id="price" placeholder="Precio del producto">
        </div>
        <div class="form-group">
          <label for="price">Cantidad</label>
          <input type="text" name="quantity" value="<?php echo $inventoryManager->getAvailable($id)->cantidad?>" class="form-control" id="price" placeholder="Cantidad de producto en el almacen">
        </div>
        <input type="submit" name="submit" class="button info" value="Guardar precio"/>
      </form>
    </div>
  </body>
</html>

<?php
  unset($_SESSION["error"]);
  unset($_SESSION["message"]);
?>
