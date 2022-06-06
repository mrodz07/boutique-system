<?php
  require_once "../models/UserManager.php";
  session_start();
  $userManager = UserManager::getInstance();

  if (!isset($_SESSION['username'])) {
    $error = "Entra a tu cuenta antes de acceder al sistema";
    // User is not logged in, so send user away.
    $_SESSION['error'] = $error;
    header("Location: /");
    exit;
  }
  
  if (!$userManager->isAdmin($_SESSION['username'])) {
    $error = "No tienes los permisos para acceder a esta página";
    $_SESSION['error'] = $error;
    header("Location: /");
    exit;
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Opciones de artículos</title>
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
      $itemManager = ItemManager::getInstance();

      $items = $itemManager->getAllSpec();        
      $username = $_SESSION['username'];
      echo "<div class='user-menu-container'> <div class='greeting'>Bienvenido $username</div> <div class='user-menu'> <a class='button menu' href='/app/sale_list.php'>Ventas</a> <a class='button menu' href='/app/inventory_list.php'>Inventario</a> <a class='button menu' href='/app/item_option_list.php'>Artículos</a> <a class='button menu' href='/app/user_list.php'>Usuarios</a> <a class='button menu' href='/app/general_stats.php'>Estadísticas</a> <a class='button menu' href='/app/user_close.php'>Cerrar sesión</a>  </div> </div>";
    ?>
    <div class="container">
      <h2 class="main-title">Opciones de artículos</h2>
      <div style="width: 50%; margin: auto;">
          <div class="option-menu-container">
            <a class="option-menu button info" href="/app/item_list.php">Administrar artículos</a>
            <a class="option-menu button info" href="/app/item_type_list.php">Administrar tipo de artículos</a>
            <a class="option-menu button info" href="/app/brand_list.php">Administrar marcas</a>
          </div>
      </div>
    </div>
  </body>
</html>

<?php
  unset($_SESSION["error"]);
  unset($_SESSION["message"]);
?>
