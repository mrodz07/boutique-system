<?php
  session_start();

	require_once "../models/UserManager.php";
	require_once "../models/ItemManager.php";
  $userManager = UserManager::getInstance();
  $itemManager = itemManager::getInstance();
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
    if ($itemManager->deleteBrand($id)) {
      $_SESSION['message'] = "La marca se eliminó con éxito";
    } else {
      $_SESSION['error'] = "La marca no pudo borrarse. Comprueba que no hayan artículos con ella";
    }
	}
	header("Location: /app/brand_list.php");
?>
