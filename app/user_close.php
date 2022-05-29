<?php
  session_start();
  if (!isset($_SESSION['username']))
  {
    $error = "Entra a tu cuenta antes de acceder al sistema";
    // User is not logged in, so send user away.
    $_SESSION['error'] = $error;
    header("Location: /");
  }

  session_unset(); 
  session_destroy(); 
  header("Location: /");
?>
