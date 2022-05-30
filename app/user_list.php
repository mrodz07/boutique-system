<?php
  session_start();
  require_once "../models/UserManager.php";

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
    <title>Listado de usuarios</title>
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
      $users = $userManager ->getAll();        
      echo "<div class='user-menu-container'> <div class='greeting'>Bienvenido $username</div> <div class='user-menu'> <a class='button menu' href='/app/user_list.php'>Administrar usuarios</a> <a class='button menu' href='/app/statistics.php'>Ver estadísticas</a> <a class='button menu' href='/app/user_close.php'>Cerrar sesión</a>  </div> </div>";
    ?>
    <div class="container">
      <h2 class="main-title">Lista de usuarios</h2>
          <div class="button-container">
            <a class="button info" href="/app/user_add.php">Añadir usuario</a>
          </div>
          <?php if(!empty($users)) { ?>
          <table class="table">
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Administrador</th>
              <th>Opciones</th>
            </tr>
            
            <?php foreach($users as $user) { ?>
              <tr>
                <td><?php echo $user->id ?></td>
                <td><?php echo $user->usuario ?></td>
                <td><?php echo ($user->admin == 1) ? "Sí" : "No" ?></td>
                <td>
                    <a class="button info" href="/app/user_details.php?username=<?php echo $user->id ?>">Detalles</a> 
                    <a class="button info" href="/app/user_edit.php?username=<?php echo $user->id ?>">Editar</a> 
                    <a class="button info" href="/app/user_delete.php?username=<?php echo $user->id ?>">Borrar</a>
                </td>
              </tr>
            <?php } ?>
          </table>
          <?php
            } else {
          ?>
            <div class="msg alert">No hay usuarios registrados</div>
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
