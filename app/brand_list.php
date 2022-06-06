<?php
  require_once "../models/UserManager.php";
  session_start();
  $userManager = UserManager::getInstance();
  $username = $_SESSION['username'];

  session_start();
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
      $itemManager = ItemManager::getInstance();

      $items = $itemManager->getAllSpec();        
      echo "<div class='user-menu-container'> <div class='greeting'>Bienvenido $username</div> <div class='user-menu'> <a class='button menu' href='/app/sale_list.php'>Ventas</a> <a class='button menu' href='/app/inventory_list.php'>Inventario</a> <a class='button menu' href='/app/item_option_list.php'>Artículos</a> <a class='button menu' href='/app/user_list.php'>Usuarios</a> <a class='button menu' href='/app/general_stats.php'>Estadísticas</a> <a class='button menu' href='/app/user_close.php'>Cerrar sesión</a>  </div> </div>";
    ?>
    <div class="container-full">
      <h2 class="main-title">Lista de artículos</h2>
          <div class="button-container">
            <a class="button info" href="/app/item_add.php">Añadir artículo</a>
          </div>
          <?php if(!empty($items)) { ?>
          <div>
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
                <th>Opciones</th>
              </tr>
              
              <?php foreach($items as $item) { ?>
                <tr>
                  <td><?php echo $item->id ?></td>
                  <td><?php echo $itemManager->getProduct($item->id_producto)->nombre ?></td>
                  <td><?php echo $itemManager->getBrand($item->id_marca)->nombre ?></td>
                  <td><?php echo ($item->id_temporada == NULL) ? "Cualquiera" : $itemManager->getSeason($item->id_temporada)->nombre ?></td>
                  <td><?php echo $itemManager->getCategory($item->id_categoria)->nombre ?></td>
                  <td><?php echo $itemManager->getGender($item->id_genero)->nombre ?></td>
                  <td>
                    <div class="color-cube-container">
                      <div class="color-cube" style="background-color: #<?php echo $itemManager->getColorTone($item->id_color_tono)->valor_hexadecimal?>;">
                      </div>
                      <div>
                        <?php echo $itemManager->getColor($itemManager->getColorTone($item->id_color_tono)->id_color)->nombre . " " . $itemManager->getTone($itemManager->getColorTone($item->id_color_tono)->id_tono)->nombre ?>
                      </div>
                    </div>
                  </td>
                  <td><?php echo $itemManager->getSize($itemManager->getSizeStage($item->id_talla_etapa)->id_talla)->nombre . " " . $itemManager->getStage($itemManager->getSizeStage($item->id_talla_etapa)->id_etapa)->nombre ?></td>
                  <td style='margin: 0; padding: 0;'>
                    <div class='item-desc-container'>
                      <p class='item-desc'> <?php echo $item->descripcion ?> </p>
                    </div>
                  </td>
                  <td class='option-menu-container'>
                      <a class="button info option-menu" href="/app/item_details.php?id=<?php echo $item->id ?>">Detalles</a> 
                      <a class="button info option-menu" href="/app/item_edit.php?id=<?php echo $item->id ?>">Editar</a> 
                      <a class="button info option-menu" href="/app/item_delete.php?id=<?php echo $item->id ?>">Borrar</a>
                  </td>
                </tr>
              <?php } ?>
            </table>
          </div>
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
