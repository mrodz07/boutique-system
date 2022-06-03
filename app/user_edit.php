<?php session_start();
  require_once "../models/UserManager.php";
  $uManager = UserManager::getInstance();
  $username = $_SESSION['username'];
  $isAdmin = $uManager -> isAdmin($username);
  if(!empty($_REQUEST['username'])) $oldUsername = $_REQUEST['username'];

  if (!isset($username)) {
    $error = "Inicia sesión para entrar al sistema";
    // User is not logged in, so send user away.
    $_SESSION['error'] = $error;
    header("Location: /");
    exit;
  }

  if (!$isAdmin) {
    if ($_REQUEST['username'] != $username) {
      $error = "Cambia la contraseña desde la cuenta del usuario";
      // User is not logged in, so send user away.
      $_SESSION['error'] = $error;
      header("Location: /app/list.php");
      exit;
    }
  }
?>

<?php if(!$isAdmin) { ?>
<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <title>Editar contraseña</title>
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
      <h2 class="main-title">Editar contraseña</h2>
      <?php echo "<form action='/app/user_update.php?username=$username' method='POST'>"?>
          <div class="form-group">
              <label for="username">Contraseña anterior</label>
              <input type="password" name="op" id="op" placeholder="Contraseña anterior">
          </div>
          <div class="form-group">
              <label for="username">Nueva contraseña</label>
              <input type="password" name="np" id="np" placeholder="Nueva contraseña">
          </div>
          <div class="form-group">
            <input type="submit" name="submit" class="button info" value="Actualizar"/>
          </div>
      </form>
    </div>
  </body>
</html>

<?php } else { ?>

<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <title>Editar usuario</title>
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
      <h2 class="main-title">Editar usuario</h2>
      <?php echo "<form action='/app/user_update.php' method='POST'>"?>
          <div class="form-group">
              <label for="username">Nuevo nombre</label>
          <input type="text" name="username" id="username" placeholder="<?php echo $oldUsername;?>">
          </div>
          <div class="form-group">
              <label for="username">Nueva contraseña</label>
              <input type="password" name="np" id="np" placeholder="Nueva contraseña">
          </div>
          <div class="form-group">
		    		<input type="hidden" name="oldUsername" value="<?php echo $oldUsername;?>"/>
            <input type="submit" name="submit" class="button info" value="Actualizar"/>
          </div>
      </form>
    </div>
  </body>
</html>

<?php } ?>

<?php
  unset($_SESSION["error"]);
?>
