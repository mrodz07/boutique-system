<?php
  session_start();
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
    <title>Estadísticas del sistema</title>
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
      require_once "../models/ItemManager.php";
      require_once "../models/UserManager.php";
      $itemManager = ItemManager::getInstance();
      $userManager = UserManager::getInstance();

      $items = $itemManager->getAllSpec();        
      $username = $_SESSION['username'];

      if ($userManager -> isAdmin($username)) {
        echo "<div class='user-menu-container'> <div class='greeting'>Bienvenido $username</div> <div class='user-menu'> <a class='button menu' href='/app/sale_list.php'>Ventas</a>  <a class='button menu' href='/app/inventory_list.php'>Inventario</a> <a class='button menu' href='/app/item_option_list.php'>Artículos</a> <a class='button menu' href='/app/user_list.php'>Usuarios</a> <a class='button menu' href='/app/general_stats.php'>Estadísticas</a> <a class='button menu' href='/app/user_close.php'>Cerrar sesión</a>  </div> </div>";
      } else {
        echo "<div class='user-menu-container'> <div class='greeting'>Bienvenido $username</div> <div class='user-menu'> <a class='button menu' href='/app/sale_list.php'>Ventas</a> <a class='button menu' href='/app/user_edit.php?username=$username'>Contraseña</a><a class='button menu' href='/app/user_close.php'>Cerrar sesión</a> </div> </div>";
      }
    ?>
    <div class="container">
      <h2 class="main-title">Estadísticas del sistema</h2>
      <h3>Artículos en la base de datos</h3>
    <?php 
      foreach ($items as $item) {
          echo "<div class='form-group'>";
            echo "<p>" . $itemManager->getProduct($item->id_producto)->nombre . " " . $itemManager->getBrand($item->id_marca)->nombre . "</p>";
            echo "<p>" . $itemManager->getBrandSpecialCount($item->id_producto, $item->id_marca)->getmarcacount . "</p>";
          echo "</div>";
      }
    ?> 
    </div>
  </body>
</html>

<?php
  unset($_SESSION["error"]);
  unset($_SESSION["message"]);
?>
