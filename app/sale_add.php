<?php
  session_start();
  require_once "../models/ItemManager.php";
  require_once "../models/UserManager.php";
  require_once "../models/SaleManager.php";
  require_once "../models/InventoryManager.php";

  $itemManager = ItemManager::getInstance();
  $inventoryManager = InventoryManager::getInstance();
  $saleManager = SaleManager::getInstance();
  $userManager = UserManager::getInstance();
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
    <title>Añadir venta</title>
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

      $inventories = $inventoryManager->getAllAvailable();
    ?>
    <div class="container">
      <h2 class="main-title">Añadir artículo</h2>
      <form action="/app/sale_save.php" method="POST"> 
        <div class="form-group">
          <p>Tipo de producto</p>
          <select name="payment">
            <option value="1">Efectivo</option>;
            <option value="2">Tarjeta</option>;
          </select>
        </div>
        <div class="form-group">
          <p>Artículo en inventario</p>
          <select name="inventory">
            <?php
              foreach($inventories as $inventory) {
                $tmp_spec = $itemManager->getSpec($inventoryManager->get($inventory->id)->id_especificacion);
                echo "<option value='" . $inventory->id . "'>" . "ID: " . $tmp_spec->id . " " . $itemManager->getProduct($tmp_spec->id_producto)->nombre . " "  . $itemManager->getBrand($tmp_spec->id_marca)->nombre . "</option>";
              }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="description">Cantidad</label>
          <input type="text" name="quantity" value="" class="form-control" id="quantity" placeholder="Cantidades vendidas">
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
