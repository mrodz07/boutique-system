<?php
  session_start();
	require_once "../models/UserManager.php";
  $uM = UserManager::getInstance();

  if (!isset($_SESSION['username'])) {
    $error = "Inicia sesión para entrar al sistema";
    // User is not logged in, so send user away.
    $_SESSION['error'] = $error;
    header("Location: /");
    exit;
  }

	if (empty($_POST['op']) || empty($_POST['np'])) {
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
?>
