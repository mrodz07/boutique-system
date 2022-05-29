<?php
  require_once "../models/UserManager.php";

  session_start();
  $uM = UserManager::getInstance();
  if ($uM->checkCredentials($_POST['username'], $_POST['password'])) {
      header('Location: list.php');
  } else {
      header('Location: /');
  }
?>
