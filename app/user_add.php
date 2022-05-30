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
    <title>Añadir usuarios</title>
    <link rel="stylesheet" href="style.css">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
  </head>
  <body>
    <?php
      if (isset($_SESSION["error"])) {
        $error = $_SESSION["error"];
        echo "<div class='alert'>$error</div>";
      }
    ?>
    <div class="container">
      <h2 class="main-title">Añadir usuario</h2>
      <form action="/app/user_save.php" method="POST"> 
        <div class="form-group">
          <label for="username">Nombre de usuario</label>
          <input type="text" name="username" value="" class="form-control" id="username" placeholder="UsuarioEjemplo">
        </div>
        <div class="form-group">
          <label for="username">Contraseña</label>
          <input type="password" name="password" value="" class="form-control" id="password" placeholder="Contraseña segura">
        </div>
        <div class="form-group">
          <label for="isAdmin">Administrador</label>
          <input type="radio" name="isAdmin" value="true" class="form-control" id="isAdmin">Sí</input>
          <input type="radio" name="isAdmin" value="false" class="form-control" id="isAdmin">No</input>
        </div>
        <input type="submit" name="submit" class="button info" value="Guardar usuario"/>
      </form>
    </div>
  </body>
</html>

<?php
  unset($_SESSION["error"]);
  unset($_SESSION["message"]);
?>
