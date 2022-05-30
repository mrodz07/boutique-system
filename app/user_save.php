<?php
  session_start();
	require_once "../models/UserManager.php";
	$userManager = userManager::getInstance();
  $username = $_SESSION['username'];

	if (empty($_POST['submit'])){
    header("Location: /app/user_list.php");
    exit;
	}

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

  if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['isAdmin'])) {
    $error = "Ingresa todos los datos para continuar";
    $_SESSION['error'] = $error;
    header("Location: /app/user_add.php");
    exit;
  }

	$args = array(
	    'username'  => FILTER_SANITIZE_STRING,
	    'password'  => FILTER_SANITIZE_STRING,
	    'isAdmin'  => FILTER_SANITIZE_STRING,
	);

	$post = (object)filter_input_array(INPUT_POST, $args);

	$userManager->save($post->username, $post->password, $post->isAdmin == "true" ? 1 : 0);
	header("Location: /app/user_list.php");
?>
