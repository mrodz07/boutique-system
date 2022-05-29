<?php
  require_once "../models/UserManager.php";

  session_start();
  $username = $_POST['username'];
  $password = $_POST['password'];
  $error = "Usuario o contraseña incorrectos";
  $uM = UserManager::getInstance();

  if ($uM->checkCredentials($username, $password)) {
      $_SESSION['username'] = $username;
      header('Location: list.php');
  } else {
      $_SESSION['error'] = $error;
      header('Location: /');
  }
?>
