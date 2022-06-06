<?php
  session_start();
	require_once "../models/UserManager.php";
	require_once "../models/ItemManager.php";
  $userManager = UserManager::getInstance();
  $itemManager = ItemManager::getInstance();
  $username = $_SESSION['username'];
  $isAdmin = $userManager -> isAdmin($username);
  $id = $_REQUEST['id'];

  if (!isset($_SESSION['username'])) {
    $error = "Inicia sesión para entrar al sistema";
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

  if ($itemManager->updateProduct($id, $post->name)) {
    $_SESSION['message'] = "El tipo de producto se actualizó exitosamente";
  } else {
    $_SESSION['error'] = "Los datos que ingresaste ya se presentan en otro tipo de producto";
  }

  header("Location: /app/type_list.php");
?>
