<?php
  session_start();
	require_once "../models/UserManager.php";
	require_once "../models/InventoryManager.php";
  $userManager = UserManager::getInstance();
  $inventoryManager = InventoryManager::getInstance();
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
	    'price'  => FILTER_SANITIZE_NUMBER_INT,
	    'quantity'  => FILTER_SANITIZE_NUMBER_INT
	);

	$post = (object)filter_input_array(INPUT_POST, $args);

  if ($inventoryManager->updatePrice($id, $post->price) && $inventoryManager->updateAvailable($id, $post->quantity)) {
    $_SESSION['message'] = "El inventario se actualizó correctamente";
  } else {
    $_SESSION['error'] = "Ocurrió un error al actualizar el inventario";
  }

  header("Location: /app/inventory_list.php");
?>
