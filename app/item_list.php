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
    <title>Listado de artículos</title>
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
      $ItemManager = ItemManager::getInstance();
      $UserManager = UserManager::getInstance();

      $items = $ItemManager->getAllSpec();        
      $username = $_SESSION['username'];
      if ($UserManager -> isAdmin($username)) {
        echo "<div class='user-menu-container'> <div class='greeting'>Bienvenido $username</div> <div class='user-menu'> <a class='button menu' href='/app/item_manage.php'>Administrar artículos</a> <a class='button menu' href='/app/user_list.php'>Administrar usuarios</a> <a class='button menu' href='/app/statistics.php'>Ver estadísticas</a> <a class='button menu' href='/app/user_close.php'>Cerrar sesión</a>  </div> </div>";
      } else {
        echo "<div class='user-menu-container'> <div class='greeting'>Bienvenido $username</div> <div class='user-menu'><a class='button menu' href='/app/user_edit.php?username=$username'>Modificar contraseña</a><a class='button menu' href='/app/user_close.php'>Cerrar sesión</a> </div> </div>";
      }
    ?>
    <div class="container">
      <h2 class="main-title">Lista de artículos</h2>
          <div class="button-container">
            <a class="button info" href="/app/item_add.php">Añadir artículo</a>
          </div>
          <?php if(!empty($items)) { ?>
          <table class="table">
            <tr>
              <th>Id</th>
              <th>Tipo producto</th>
              <th>Marca</th>
              <th>Temporada</th>
              <th>Categoría</th>
              <th>Género</th>
              <th>Color</th>
              <th>Talla</th>
              <th>Descripción</th>
            </tr>
            
            <?php foreach($items as $item) { ?>
              <tr>
                <td><?php echo $item->id ?></td>
                <td><?php echo $itemManager->getProduct($item->id_producto) ?></td>
                <td><?php echo $itemManager->getBrand($item->id_marca) ?></td>
                <td><?php echo $itemManager->getSeason($item->id_temporada) ?></td>
                <td><?php echo $itemManager->getCategory($item->id_categoria) ?></td>
                <td><?php echo $itemManager->getGender($item->id_genero) ?></td>
                <td><?php echo $itemManager->getColor($itemManager->getColorTone($item->color_tono)->id_color) . $itemManager->getTone($itemManager->getColorTone($item->color_tono)->id_tono) ?></td>
                <td><?php echo $itemManager->getSize($itemManager->getSizeStage($item->talla_etapa)->id_talla) . $itemManager->getStage($itemManager->getSizeStage($item->talla_etapa)->id_etapa) ?></td>
                <td><?php echo $item->descripcion ?></td>
                <td>
                    <a class="button info" href="/app/details.php?car=<?php echo $item->id ?>">Detalles</a> 
                    <a class="button info" href="/app/edit.php?car=<?php echo $item->id ?>">Editar</a> 
                    <a class="button info" href="/app/delete.php?car=<?php echo $item->id ?>">Borrar</a>
                </td>
              </tr>
            <?php } ?>
          </table>
          <?php
            } else {
          ?>
            <div class="msg alert">Hay 0 artículos registrados</div>
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
