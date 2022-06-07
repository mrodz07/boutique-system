<?php
  session_start();

	require_once "../models/UserManager.php";
	require_once "../models/ItemManager.php";
	require_once "../models/SaleManager.php";
  $userManager = UserManager::getInstance();
  $itemManager = ItemManager::getInstance();
  $saleManager = SaleManager::getInstance();
  $username = $_SESSION['username'];

  if (!isset($username)) {
    $error = "Entra a tu cuenta antes de acceder al sistema";
    // User is not logged in, so send user away.
    $_SESSION['error'] = $error;
    header("Location: /");
    exit;
  }

	$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

	if ($id) {
    if ($saleManager->removeSale($id)) {
      $_SESSION['message'] = "La venta se removió correctamente";
    } else {
      $_SESSION['error'] = "Hubo un error al remover la venta";
    }
	}
	header("Location: /app/sale_list.php");
?>
