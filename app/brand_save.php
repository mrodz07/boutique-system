<?php
  session_start();
	require_once "../models/UserManager.php";
	require_once "../models/ItemManager.php";
  $itemManager = itemManager::getInstance();
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
  
	$args = array(
	    'name'  => FILTER_SANITIZE_STRING
	);

	$post = (object)filter_input_array(INPUT_POST, $args);

if ($itemManager->saveBrand($post->name)) {
    $_SESSION['message'] = "La marca se agregó correctamente";
  } else {
    $_SESSION['error'] = "La marca que añadiste ya se encuentra en la lista";
  }
	header("Location: /app/brand_list.php");
?>
