<?php
  require_once "../models/UserManager.php";
  session_start();
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
    <title>Listado de tipos de artículo</title>
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

      $brands = $itemManager->getAllProducts();        
      echo "<div class='user-menu-container'> <div class='greeting'>Bienvenido $username</div> <div class='user-menu'> <a class='button menu' href='/app/sale_list.php'>Ventas</a> <a class='button menu' href='/app/inventory_list.php'>Inventario</a> <a class='button menu' href='/app/item_option_list.php'>Artículos</a> <a class='button menu' href='/app/user_list.php'>Usuarios</a> <a class='button menu' href='/app/general_stats.php'>Estadísticas</a> <a class='button menu' href='/app/user_close.php'>Cerrar sesión</a>  </div> </div>";
    ?>
    <div class="container-full">
      <h2 class="main-title">Lista de tipos de artículo</h2>
          <div class="button-container">
            <a class="button info" href="/app/type_add.php">Añadir tipo de artículo</a>
          </div>
          <?php if(!empty($brands)) { ?>
          <div>
            <table class="table">
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Opciones</th>
              </tr>
              
              <?php foreach($brands as $brand) { ?>
                <tr>
                  <td><?php echo $brand->id ?></td>
                  <td><?php echo $brand->nombre ?></td>
                  <td>
                      <a class="button info" href="/app/type_details.php?id=<?php echo $brand->id ?>">Detalles</a> 
                      <a class="button info" href="/app/type_edit.php?id=<?php echo $brand->id ?>">Editar</a> 
                      <a class="button info" href="/app/type_delete.php?id=<?php echo $brand->id ?>">Borrar</a>
                  </td>
                </tr>
              <?php } ?>
            </table>
          </div>
          <?php
            } else {
          ?>
            <div class="msg alert">Hay 0 tipos de artículo registrados</div>
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
