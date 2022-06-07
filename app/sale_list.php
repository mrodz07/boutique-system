<?php
  require_once "../models/UserManager.php";
  session_start();
  $userManager = UserManager::getInstance();
  $username = $_SESSION['username'];

  if (!isset($_SESSION['username'])) {
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
    <title>Ventas</title>
    <link rel="stylesheet" href="style.css">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
  </head>
  <body>
    <?php
      if (isset($_SESSION["error"])) {
        $error = $_SESSION["error"];
        echo "<div class='alert'>$error</div>";
      }
      if (isset($_SESSION["message"])) {
        $message = $_SESSION["message"];
        echo "<div class='info'>$message</div>";
      }
    ?>
    <?php
      require_once "../models/SaleManager.php";
      require_once "../models/InventoryManager.php";
      require_once "../models/ItemManager.php";
      $itemManager = ItemManager::getInstance();
      $inventoryManager = InventoryManager::getInstance();
      $salesManager = SaleManager::getInstance();

      $items = $salesManager->getAll();        
      if ($userManager->isAdmin($username)) {
        echo "<div class='user-menu-container'> <div class='greeting'>Bienvenido $username</div> <div class='user-menu'> <a class='button menu' href='/app/sale_list.php'>Ventas</a> <a class='button menu' href='/app/inventory_list.php'>Inventario</a> <a class='button menu' href='/app/item_option_list.php'>Artículos</a> <a class='button menu' href='/app/user_list.php'>Usuarios</a> <a class='button menu' href='/app/general_stats.php'>Estadísticas</a> <a class='button menu' href='/app/user_close.php'>Cerrar sesión</a>  </div> </div>";
      } else {
        echo "<div class='user-menu-container'> <div class='greeting'>Bienvenido $username</div> <div class='user-menu'> <a class='button menu' href='/app/sale_list.php'>Ventas</a> <a class='button menu' href='/app/user_edit.php?username=$username'>Contraseña</a><a class='button menu' href='/app/user_close.php'>Cerrar sesión</a> </div> </div>";
      }
    ?>
    <div class="container-full">
      <h2 class="main-title">Administrar ventas</h2>
        <div class="button-container">
          <a class="button info" href="/app/sale_add.php">Realizar venta</a>
        </div>
        <?php if(!empty($items)) {?>
        <div>
          <table class="table">
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Cantidad</th>
              <th>Precio</th>
              <th>Tipo pago</th>
              <th>Opciones</th>
            </tr>
              <?php foreach ($items as $item) { ?>
              <tr>
                  <?php $tmp_spec = $itemManager->getSpec($inventoryManager->get($item->id_inventario)->id_especificacion); ?>
                  <td><?php echo $item->id ?></td>
                  <td><?php echo "ID: " . $tmp_spec->id . $itemManager->getProduct($tmp_spec->id_producto)->name . " " . $itemManager->getProduct($tmp_spec->id_producto)->nombre . " " . $itemManager->getBrand($tmp_spec->id_marca)->nombre . " "?></td>
                  <td><?php echo $item->cantidad; ?></td>
                  <td><?php echo "$" . $inventoryManager->getPrice($tmp_spec->id)->precio; ?></td>
                  <td><?php echo ($item->id_estado == 1) ? "Efectivo" : "Tarjeta" ?></td>
                  <td>
                    <a class="button info" href="/app/sale_delete.php?id=<?php echo $item->id ?>">Borrar</a>
                  </td>
              </tr>
            <?php } ?>
          </table>
        </div>
        <?php
          } else {
        ?>
          <div class="msg alert">Hay 0 artículos vendidos.</div>
        <?php
          }
        ?>
      </div>
    </div>
  </body>
</html>

<?php
  unset($_SESSION["error"]);
  unset($_SESSION["message"]);
?>
