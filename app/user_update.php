<?php
  session_start();
	require_once "../models/UserManager.php";
  $uM = UserManager::getInstance();
  $isAdmin = $uM -> isAdmin($_SESSION['username']);

  if (!isset($_SESSION['username'])) {
    $error = "Inicia sesión para entrar al sistema";
    // User is not logged in, so send user away.
    $_SESSION['error'] = $error;
    header("Location: /");
    exit;
  }

  if (!$isAdmin) {
    if ((empty($_POST['op']) || empty($_POST['np']))) {
      $error = "Ingresa todos los datos para continuar";
      $_SESSION['error'] = $error;
      header("Location: /app/user_edit.php?username=". $_SESSION['username']);
      exit;
    }

    if ($uM -> checkCredentials($_SESSION['username'], $_POST['op'])) {
      $uM -> updatePass($_SESSION['username'], $_POST['np']);
      $message = "La contraseña se cambió con exito";
      $_SESSION['message'] = $message;
      header("Location: /app/list.php");
      exit;
    } else {
      $error = "Contraseña anterior incorrecta";
      $_SESSION['error'] = $error;
      header("Location: /app/user_edit.php?username=". $_SESSION['username']);
      exit;
    }
  } else {
    if (!empty($_POST['username']) && !empty($_POST['oldUsername']) && !empty($_POST['np'])) {
      if ($uM -> updateUsername($_POST['oldUsername'], $_POST['username'])) {
        $message = "Nombre y contraseña cambiados con exito";
        $_SESSION['message'] = $message;
        header("Location: /app/user_list.php");
        exit;
      } else {
        $error = "El nombre de usuario no está disponible";
        $_SESSION['error'] = $error;
        header("Location: /app/user_edit.php?username=". $_POST['username']);
        exit;
      }
    }
  }
?>
