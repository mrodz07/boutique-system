<?php
  session_start();

	require_once "../models/UserManager.php";
	require_once "../models/ItemManager.php";
	require_once "../models/InventoryManager.php";
  $userManager = UserManager::getInstance();
  $itemManager = itemManager::getInstance();
  $inventoryManager = inventoryManager::getInstance();
  $username = $_SESSION['username'];

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

	$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

	if ($id) {
		$itemManager->deleteSpec($id);
	}
	header("Location: /app/item_list.php");
?>
