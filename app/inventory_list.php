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
    <title>Inventario</title>
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
      require_once "../models/InventoryManager.php";
      require_once "../models/ItemManager.php";
      $inventoryManager = InventoryManager::getInstance();
      $itemManager = ItemManager::getInstance();

      $items = $inventoryManager->getAll();        
      echo "<div class='user-menu-container'> <div class='greeting'>Bienvenido $username</div> <div class='user-menu'> <a class='button menu' href='/app/sale_list.php'>Ventas</a> <a class='button menu' href='/app/inventory_list.php'>Inventario</a> <a class='button menu' href='/app/item_option_list.php'>Artículos</a> <a class='button menu' href='/app/user_list.php'>Usuarios</a> <a class='button menu' href='/app/general_stats.php'>Estadísticas</a> <a class='button menu' href='/app/user_close.php'>Cerrar sesión</a>  </div> </div>";
    ?>
    <div class="container-full">
      <h2 class="main-title">Lista de artículos en inventario</h2>
          <?php if(!empty($items)) { ?>
          <div>
            <table class="table">
              <tr>
                <th>Id</th>
                <th>Artículo</th>
                <th>Estado</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Fecha Ingreso</th>
                <th>Opciones</th>
              </tr>
              
              <?php foreach($items as $item) { 
                $tmp_spec = $itemManager->getSpec($item->id_especificacion);
              ?>
                
                <tr>
                  <td><?php echo $item->id ?></td>
                  <td><?php echo "ID: " . $tmp_spec->id . " " . $itemManager->getProduct($tmp_spec->id_producto)->nombre . " " . $itemManager->getBrand($tmp_spec->id_marca)->nombre . " "?></td>
                  <td><?php echo $itemManager->getState($item->id_estado)->nombre ?></td>
                  <td><?php echo $item->cantidad ?></td>
                  <td><?php echo ($item->id_estado == 1) ? "$" . $item->precio : "No aplica" ?></td>
                  <td><?php echo $item->fecha_ingreso ?></td>
                  <td>
                  <?php if($item->id_estado == 1) { ?>
                      <a class="button info" href="/app/inventory_edit.php?id=<?php echo $tmp_spec->id ?>">Editar</a> 
                  <?php } ?>
                  </td>
                </tr>
              <?php } ?>
            </table>
          </div>
          <?php
            } else {
          ?>
            <div class="msg alert">Hay 0 artículos en el inventario. Agrega artículos para poblar esta sección</div>
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
