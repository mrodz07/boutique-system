<?php session_start();
  require_once "../models/UserManager.php";
  require_once "../models/ItemManager.php";
  $userManager = UserManager::getInstance();
  $itemManager = ItemManager::getInstance();
  $username = $_SESSION['username'];
  $id = $_REQUEST['id'];

  if (!isset($username)) {
    $error = "Inicia sesión para entrar al sistema";
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
      <title>Editar tipo de artículo</title>
      <link rel="stylesheet" href="style.css">
      <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
  </head>
  <body>
    <?php
      if (isset($_SESSION["error"])) {
        $error = $_SESSION["error"];
        echo "<div class='alert'>$error</div>";
      }

      $typeData = $itemManager->getProduct($id);
    ?>

    <div class="container">
      <h2 class="main-title">Editar tipo de artículo</h2>
      <?php echo "<form action='/app/type_update.php?id=$id' method='POST'>"?>
        <div class="form-group">
          <label for="name">Nombre</label>
          <input type="text" name="name" value="<?php echo $typeData->nombre ?>" class="form-control" id="name" placeholder="Nombre del tipo de artículo">
        </div>
        <input type="submit" name="submit" class="button info" value="Guardar tipo de artículo"/>
      </form>
    </div>
  </body>
</html>

<?php
  unset($_SESSION["error"]);
  unset($_SESSION["message"]);
?>
