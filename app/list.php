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
      require_once "../models/CarManager.php";
      require_once "../models/UserManager.php";
      $carManager = CarManager::getInstance();
      $userManager = UserManager::getInstance();
      $cars = $carManager->getAll();        
      $username = $_SESSION['username'];
      if ($userManager -> isAdmin($username)) {
        echo "<div class='user-menu-container'> <div class='greeting'>Bienvenido $username</div> <div class='user-menu'><a class='button menu' href='/app/user_close.php'>Cerrar sesión</a> <a class='button menu' href='/app/user_edit.php?username=$username'>Modificar contraseña</a> <a class='button menu' href='/app/user_add'>Administrar usuarios</a> <a class='button menu' href='/app/statistics.php'>Ver estadísticas</a> </div> </div>";
      } else {
        echo "<div class='user-menu-container'> <div class='greeting'>Bienvenido $username</div> <div class='user-menu'><a class='button menu' href='/app/user_close.php'>Cerrar sesión</a> <a class='button menu' href='/app/user_edit.php?username=$username'>Modificar contraseña</a></div>";
      }
    ?>
    <div class="container">
      <h2 class="main-title">Car List</h2>
          <div class="button-container">
            <a class="button info" href="<?php echo CarManager::baseurl() ?>/app/add.php">Add car</a>
            <a class="button info" href="<?php echo CarManager::baseurl() ?>/app/add_brand.php">Add brand</a>
          </div>
          <?php if(!empty($cars)) { ?>
          <table class="table">
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Marca</th>
              <th>Aire acondicionado</th>
              <th>Opciones</th>
            </tr>
            
            <?php foreach($cars as $car) { ?>
              <tr>
                <td><?php echo $car->id ?></td>
                <td><?php echo $car->nombre ?></td>
                <td><?php echo $carManager->getBrand($car->id_marca)->nombre ?></td>
                <td><?php echo $car->aire_acondicionado > 0 ? 'Sí' : 'No' ?></td>
                <td>
                    <a class="button info" href="<?php echo CarManager::baseurl() ?>/app/details.php?car=<?php echo $car->id ?>">Details</a> 
                    <a class="button info" href="<?php echo CarManager::baseurl() ?>/app/edit.php?car=<?php echo $car->id ?>">Edit</a> 
                    <a class="button info" href="<?php echo CarManager::baseurl() ?>/app/delete.php?car=<?php echo $car->id ?>">Delete</a>
                </td>
              </tr>
            <?php } ?>
          </table>
          <?php
            } else {
          ?>
            <div class="msg alert">There are 0 registered users</div>
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
