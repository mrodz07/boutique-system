<?php
  session_start();
	require_once "../models/UserManager.php";
	require_once "../models/ItemManager.php";
	require_once "../models/SaleManager.php";
  $itemManager = itemManager::getInstance();
	$userManager = userManager::getInstance();
	$saleManager = saleManager::getInstance();
  $username = $_SESSION['username'];

	if (empty($_POST['submit'])){
    header("Location: /app/sale_list.php");
    exit;
	}

  if (!isset($username)) {
    $error = "Entra a tu cuenta antes de acceder al sistema";
    // User is not logged in, so send user away.
    $_SESSION['error'] = $error;
    header("Location: /");
    exit;
  }

	$args = array(
	    'payment'  => FILTER_SANITIZE_NUMBER_INT,
      'inventory' => FILTER_SANITIZE_NUMBER_INT,
      'quantity' => FILTER_SANITIZE_NUMBER_INT
	);

	$post = (object)filter_input_array(INPUT_POST, $args);

if ($saleManager->createSale($post->payment, $post->inventory, 1, $post->quantity)) {
    $_SESSION['message'] = "La venta se realizó con éxito";
  } else {
    $_SESSION['error'] = "Hubo un error al procesar tu venta";
  }
	header("Location: /app/sale_list.php");
?>
