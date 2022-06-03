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
    <title>Detalles de usuario</title>
    <link rel="stylesheet" href="style.css">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
</head>
<body>
    <?php
      require_once "../models/UserManager.php";
      $UserManager = UserManager::getInstance();
      $user = $UserManager->get($username);
    ?>
    <div class="container">
      <h2 class="main-title">User details</h2>
      <form>
        <div class="form-group">
          <p>ID</p>
          <input type="text" name="id" value="<?php echo $user->id ?>" class="form-control" id="id" placeholder="id" disabled>
        </div>
        <div class="form-group">
          <label for="username">Nombre</label>
          <input type="text" name="username" value="<?php echo $username ?>" class="form-control" id="username" placeholder="Username" disabled>
        </div>
        <div class="form-group">
          <label for="isAdmin">Administrador</label>
          <?php if($user -> isAdmin == 1) { ?>
            <input type="radio" name="isAdmin" value="true" class="form-control" id="isAdmin" checked disabled >Sí</input>
            <input type="radio" name="isAdmin" value="false" class="form-control" id="isAdmin" disabled >No</input>
          <?php } else { ?>
            <input type="radio" name="isAdmin" value="true" class="form-control" id="isAdmin" disabled >Sí</input>
            <input type="radio" name="isAdmin" value="false" class="form-control" id="isAdmin" checked disabled >No</input>
          <?php } ?>
        </div>
      </form>
    </div>
</body>
</html>

<?php
  unset($_SESSION["error"]);
  unset($_SESSION["message"]);
?>
