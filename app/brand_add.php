<?php
  session_start();
  require_once "../models/ItemManager.php";
  require_once "../models/UserManager.php";

  $itemManager = ItemManager::getInstance();
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
    <title>Añadir marca</title>
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
      <h2 class="main-title">Añadir marca</h2>
      <form action="/app/brand_save.php" method="POST"> 
        <div class="form-group">
          <label for="name">Nombre</label>
          <input type="text" name="name" value="" class="form-control" id="name" placeholder="Nombre de la marca">
        </div>
        <input type="submit" name="submit" class="button info" value="Guardar marca"/>
      </form>
    </div>
  </body>
</html>

<?php
  unset($_SESSION["error"]);
  unset($_SESSION["message"]);
?>
