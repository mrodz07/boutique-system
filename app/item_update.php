<?php
  session_start();
	require_once "../models/UserManager.php";
	require_once "../models/ItemManager.php";
  $uM = UserManager::getInstance();
  $itemManager = ItemManager::getInstance();
  $isAdmin = $uM -> isAdmin($_SESSION['username']);
  $id = $_REQUEST['id'];

  if (!isset($_SESSION['username'])) {
    $error = "Inicia sesión para entrar al sistema";
    // User is not logged in, so send user away.
    $_SESSION['error'] = $error;
    header("Location: /");
    exit;
  }

	$args = array(
	    'product'  => FILTER_SANITIZE_NUMBER_INT,
	    'brand'  => FILTER_SANITIZE_NUMBER_INT,
      'season' => FILTER_SANITIZE_NUMBER_INT,
	    'category'  => FILTER_SANITIZE_NUMBER_INT,
	    'gender'  => FILTER_SANITIZE_NUMBER_INT,
	    'color'  => FILTER_SANITIZE_NUMBER_INT,
	    'size'  => FILTER_SANITIZE_NUMBER_INT,
	    'description'  => FILTER_SANITIZE_STRING
	);

	$post = (object)filter_input_array(INPUT_POST, $args);

  if($itemManager->updateSpec($id, $post->product, $post->brand, $post->season, $post->category, $post->gender, $post->color, $post->size, $post->description)) {
    $_SESSION['message'] = "El artículo se atualizó correctamente";
  } else {
    $_SESSION['error'] = "Los datos que ingresaste ya se presentan en otro artículo";
  }

  header("Location: /app/item_list.php");
?>
