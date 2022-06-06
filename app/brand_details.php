<?php
  session_start();
  require_once "../models/UserManager.php";
  require_once "../models/ItemManager.php";

  $userManager = UserManager::getInstance();
  $itemManager = ItemManager::getInstance();
  $id = $_REQUEST['id'];
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
    <title>Detalles de marca</title>
    <link rel="stylesheet" href="style.css">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
</head>
<body>
    <?php
      $brand = $itemManager->getBrand($id);
    ?>
    <div class="container">
      <h2 class="main-title">Detalles de la marca</h2>
      <form>
        <div class="form-group">
          <p>ID</p>
          <input type="text" name="id" value="<?php echo $id ?>" class="form-control" id="id" placeholder="id" disabled>
        </div>
        <div class="form-group">
          <label for="name">Nombre</label>
          <input type="text" name="name" style="overflow: scroll" value="<?php echo $brand->nombre ?>" class="form-control" id="name" disabled>
        </div>
        <div class="form-group">
        <a class="button info" href="/app/brand_list.php">Regresar<a/>
        <div>
      </form>
    </div>
  </body>
</html>

<?php
  unset($_SESSION["error"]);
  unset($_SESSION["message"]);
?>
