<?php
  session_start();
  if (isset($_SESSION['username']))
  {
    // User is not logged in, so send user away.
    header("Location: /app/item_list.php");
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Acceso al sistema</title>
    <link rel="stylesheet" href="app/style.css">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
  </head>
  <body>
    <?php
      if (isset($_SESSION["error"])) {
        $error = $_SESSION["error"];
        echo "<div class='alert'>$error</div>";
      }
    ?>
    <h2 class="main-title">Acceso al sistema</h2>
    <div class="container">
      <form action="/app/user_login.php" method="post">
        <div class="form-group">
          <label for="username">Usuario:</label>
          <input id="username" type="text" name="username" />
        </div>
        <div class="form-group">
          <label for="password">Contraseña:</label>
          <input id="password" type="password" name="password" />
        </div>
        <p>
          <input class="button info" type="submit" name="login" value="Login" />
        </p>
      </form>
    </div>
  </body>
</html>

<?php
  unset($_SESSION["error"]);
?>
